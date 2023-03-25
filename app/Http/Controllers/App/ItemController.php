<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Condicao;
use App\Models\Empresa;
use App\Models\Localizacao;
use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Status;
use App\Models\Photo;
use App\Models\User;

use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $itens = Produto::with('empresa','categoria','images','localizacaoProduto','status')->get();
        return view('app.itens', compact('itens'));
    }

    public function showItensInativos()
    {
        $itens_inativos = Produto::with('empresa','categoria','images','localizacaoProduto','status')->where('status_id', '=', 2)->get();
        return view('app.itens_inativos', compact('itens_inativos'));
    }


    public function showFullItens()
    {
        $itens = Produto::with('empresa','categoria','images','localizacaoProduto','status')->get();
        return view('app.full_itens', compact('itens'));
    }

    public function create()
    {
        $empresas = Empresa::all();
        $categorias = Categoria::all();
        $condicoes = Condicao::all();
        $status = Status::all();
        return view('app.cadastro_itens', compact('categorias','empresas', 'condicoes','status'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'item_descricao' => 'required',
            'item_modelo' => 'required',
            'item_categoria' => 'required',
            'item_empresa' => 'required',
            'item_condicao' => 'required',
            'item_etiqueta' => 'required',
            'qtd' => 'required|numeric|min:0|not_in:0',
            'phot_url.*' =>  'image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $item = new Produto();

            $item->descricao = $request->input('item_descricao');
            $item->modelo = $request->input('item_modelo');
            $item->categoria_id = $request->input('item_categoria');
            $item->empresa_id = $request->input('item_empresa');
            $item->placa = $request->input('item_placa');
            $item->cor = $request->input('item_cor');
            $item->qtd = $request->input('qtd');
            $item->tamanho = $request->input('item_tamanho');
            $item->serial_number =$request->input('item_serial');

            $valor = str_replace(".", "", $request->input('item_valor'));
            $valor = strtr($valor, ",", ".");
            if ($valor == "") {
                $valor = null;
            }
            $item->valor = $valor;

            $valor_depr = str_replace(".", "",$request->input('item_valor_depr'));
            $valor_depr = strtr($valor_depr, ",", ".");
            if ($valor_depr == "") {
                $valor_depr = null;
            }
            $item->valor_depr = $valor_depr;

            $tx_depreciacao = str_replace(".", "",$request->input('tx_depreciacao'));
            $tx_depreciacao = strtr($tx_depreciacao, ",", ".");
            if ($tx_depreciacao == "") {
                $tx_depreciacao = null;
            }
            $item->tx_depreciacao = $tx_depreciacao;


            $item->condicao_id = $request->input('item_condicao');
            $item->num_ativo = $request->input('item_etiqueta');
            $item->status_id = $request->input('item_status');
            $item->observacao = $request->input('item_obs');
            $item->created_at_user_id = $request->input('user_id');
            $item->updated_at_user_id = $request->input('user_id');
            $item->save();

            $item->localizacaoProduto()->create([
                'bloco' => $request->input('item_bloco'),
                'andar' => $request->input('item_andar'),
                'setor' =>$request->input('item_setor')
            ]);

            if ($request->hasFile('phot_url')){
                $image = $this->images($request, 'phot_url');
                $item->images()->createMany($image);
            }
            // return redirect()->route('itens');
            return $item->toJson();
    }

    private function images(Request $request, $imageColum){
        $images = $request->file('phot_url');
        $uploadImages = [];

        foreach ($images as $img){
            $uploadImages[] = [$imageColum => $img->store('url_photo')];
        }
        return $uploadImages;
    }


    public function show($id)
    {
        $show_item = Produto::find($id);

        if ($show_item ) {

            $empresas = Empresa::all();
            $categorias = Categoria::all();
            $condicoes = Condicao::all();
            $status = Status::all();

            $show_item->empresa;
            $show_item->categoria;
            $show_item->images;
            $show_item->localizacaoProduto;
            $show_item->status;
            $show_item->condicao;
            $created_user = User::find( $show_item->created_at_user_id);
            $updated_user = User::find( $show_item->updated_at_user_id);

            return view('app.item_detalhe', compact('show_item', 'empresas', 'categorias', 'condicoes', 'status','created_user','updated_user'));
        }
        return redirect()->route('itens');

    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'item_descricao' => 'required',
            'item_modelo' => 'required',
            'item_categoria' => 'required',
            'item_empresa' => 'required',
            'item_condicao' => 'required',
            'item_etiqueta' => 'required',
            'qtd' => 'required|numeric|min:0|not_in:0',
            'phot_url.*' =>  'image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $item = Produto::find($id);
        if ($item) {

            $item->descricao = $request->input('item_descricao');
            $item->modelo = $request->input('item_modelo');
            $item->categoria_id = $request->input('item_categoria');
            $item->empresa_id = $request->input('item_empresa');
            $item->placa = $request->input('item_placa');
            $item->cor = $request->input('item_cor');
            $item->qtd = $request->input('qtd');
            $item->tamanho = $request->input('item_tamanho');
            $item->serial_number = $request->input('item_serial');

            $valor = str_replace(".", "", $request->input('item_valor'));
            $valor = strtr($valor, ",", ".");
            $item->valor = $valor;


            $valor_depr = str_replace(".", "",$request->input('item_valor_depr'));
            $valor_depr = strtr($valor_depr, ",", ".");
            $item->valor_depr = $valor_depr;


            $tx_depreciacao = str_replace(".", "",$request->input('tx_depreciacao'));
            $tx_depreciacao = strtr($tx_depreciacao, ",", ".");
            $item->tx_depreciacao = $tx_depreciacao;


            $item->condicao_id = $request->input('item_condicao');
            $item->num_ativo = $request->input('item_etiqueta');
            $item->status_id = $request->input('item_status');
            $item->observacao = $request->input('item_obs');
            $item->updated_at_user_id = $request->input('user_id');
            $item->save();

            $item->localizacaoProduto()->update([
            'bloco' => $request->input('item_bloco'),
            'andar' => $request->input('item_andar'),
            'setor' => $request->input('item_setor')
        ]);

            if ($request->hasFile('phot_url')){
                $image = $this->photo($request, 'phot_url');
                $item->images()->createMany($image);
            }
            return $item->toJson();

        }
        return redirect()->route('item_detalhe', $id);

    }

    private function photo(Request $request, $imageCol){
        $images = $request->file('phot_url');
        $uploadImages = [];

        foreach ($images as $img){
            $uploadImages[] = [$imageCol => $img->store('url_photo')];
        }
        return $uploadImages;
    }


    public function destroy($id)
    {

        $item = Produto::with('images')->find($id);
        if ($item)
        {
            foreach ($item->images as $img)
            {
                Storage::delete($img->phot_url);
            }
            $item->delete();
            return redirect()->route('itens');
        }
        return redirect()->route('delete_item/{$id}');

    }


    public function destroyPhoto ($id)
    {
        $photo = Photo::find($id);
        if ($photo)
        {
            $url_photo = $photo->phot_url;
            Storage::delete([$url_photo]);
            $photo->delete();
            return redirect()->back()->with('success','Foto removida com sucesso.');
        }
        return redirect()->route('delete_item/{$id}');
    }
}
