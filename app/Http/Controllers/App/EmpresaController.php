<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Empresa;
use App\Models\User;
use App\Models\Produto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Illuminate\Database\QueryException;

class EmpresaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $empresas = Empresa::with('endereco','produtoEmpresa')->get();
        return view('app.empresas', compact('empresas'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $request->validate([
            'razao_social' => 'required|string',
            'fantasia' => 'required|string',
            'cnpj' => 'required',
            'cep' => 'required|numeric',
            'rua' => 'required', 'string',
            'numero' => 'required',
            'bairro' => 'required|string',
            'cidade' => 'required|string',
            'email' => 'required|email',
            'telefone1' => 'required', 'string',
            'logo' =>  'image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $empresa = new Empresa();

            $empresa->created_at_user_id = $request->input('user_id');
            $empresa->updated_at_user_id = $request->input('user_id');
            $empresa->razao_social = $request->input('razao_social');
            $empresa->fantasia = $request->input('fantasia');
            $empresa->cnpj = $request->input('cnpj');
            if ($request->file('logo')) {
                $empresa->url_logo = $request->file('logo')->store('logo');
            }

            $empresa->save();

            $empresa->endereco()->create([
                'cep' => $request->input('cep'),
                'logradouro' => $request->input("rua"),
                'numero' => $request->input('numero'),
                'complemento' => $request->input('complemento'),
                'bairro' => $request->input('bairro'),
                'cidade' => $request->input('cidade'),
                'uf' => $request->input('uf')
            ]);

            $empresa->contato()->create([
                'email' => $request->input('email'),
                'telefone1' => $request->input('telefone1'),
                'telefone2' => $request->input('telefone2'),
                'telefone3' => $request->input('telefone3')
            ]);

        return $empresa->toJson();
    }


    public function show($id)
    {
        $empresa = Empresa::find($id);

        if ($empresa ) {
            $empresa->endereco;
            $empresa->produtoEmpresa;
            $empresa->contato;
            $total_item_empresa = count($empresa->produtoEmpresa);

            $ativo = produto::with('empresa')->where('empresa_id','=', $id)->where('status_id', '=', 1)->count();
            $inativo = produto::with('empresa')->where('empresa_id','=', $id)->where('status_id', '=', 2)->count();

            $created_user = User::find( $empresa->created_at_user_id);
            $updated_user = User::find( $empresa->updated_at_user_id);

            return view('app.empresa_detalhe', compact('empresa','total_item_empresa','ativo','inativo','created_user','updated_user'));
        }
        return redirect()->route('empresas');
    }

    public function showItensEmpresa($id)
    {
        $itens_empresa = Produto::with('empresa','categoria','status','localizacaoProduto','condicao','images')->where('empresa_id','=', $id)->get();

        if ($itens_empresa ) {

            return view('app.itens_empresa', compact('itens_empresa'));
            // return $itens_empresa->toJson();
        }
        return redirect()->route('empresas');
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'razao_social' => 'required|string',
            'fantasia' => 'required|string',
            'cnpj' => 'required',
            'cep' => 'required|numeric',
            'rua' => 'required', 'string',
            'numero' => 'required',
            'bairro' => 'required|string',
            'cidade' => 'required|string',
            'email' => 'required|email',
            'telefone1' => 'required', 'string',
            'logo' =>  'image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $empresa = Empresa::find($id);

        if ($empresa)
        {

            if ($request->file('logo')) {
                if ($empresa->url_logo && Storage::exists($empresa->url_logo)) {
                    Storage::delete($empresa->url_logo);
                }
                $path = Storage::putFile('logo', $request->file('logo'));
                $empresa->url_logo = $path;
            }

            $empresa->created_at_user_id = $request->input('user_id');
            $empresa->updated_at_user_id = $request->input('user_id');
            $empresa->razao_social = $request->input('razao_social');
            $empresa->fantasia = $request->input('fantasia');
            $empresa->cnpj = $request->input('cnpj');

            $empresa->save();

            $empresa->endereco()->update([
                'cep' => $request->input('cep'),
                'logradouro' => $request->input('rua'),
                'numero' => $request->input('numero'),
                'complemento' => $request->input('complemento'),
                'bairro' => $request->input('bairro'),
                'cidade' => $request->input('cidade'),
                'uf' => $request->input('uf')
            ]);

            $empresa->contato()->update([
                'email' => $request->input('email'),
                'telefone1' => $request->input('telefone1'),
                'telefone2' => $request->input('telefone2'),
                'telefone3' => $request->input('telefone3')
            ]);
            return $empresa->toJson();
            // return redirect()->route('empresa_detalhe', $id);
        }
        return redirect()->route('empresa_detalhe', $id);
    }


    public function destroy($id)
    {
        $empresa = Empresa::find($id);
        if ($empresa)
        {
            try {

                if ($empresa->url_logo && Storage::exists($empresa->url_logo)) {
                    $img_logo = $empresa->url_logo;
                    Storage::delete($img_logo);
                }

            $empresa->delete();

            return redirect()->route('empresas');
            } catch (QueryException $e) {
                return redirect()->back()->with('error','Não foi Possível excluir  ' . $empresa->razao_social . '. Código do erro: '. $e->getCode() );
            }

        }
        return redirect()->route('empresas');
    }
}
