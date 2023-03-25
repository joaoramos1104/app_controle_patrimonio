<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Produto;
use App\Models\Empresa;
use App\Models\Categoria;
use App\Models\User;

use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth');
        $this->middleware('padraouser');
    }


    public function index()
    {
        return view('app.home');
    }

    public function indexJson()
    {
        $empresas = Empresa::all();

        $valor_categorias = DB::table('categorias')
        ->join('produtos', 'produtos.categoria_id', '=', 'categorias.id')
        ->select('categorias.descricao', DB::raw("TRUNCATE(SUM(produtos.valor), 2) as total"))
        ->groupBy('categorias.descricao')
        ->get();

        $total_valor_empresas = DB::table('empresas')
        ->join('produtos', 'produtos.empresa_id', '=', 'empresas.id')
        ->select('empresas.fantasia', DB::raw("TRUNCATE(SUM(produtos.valor), 2) as total, TRUNCATE(SUM(produtos.valor_depr), 2) as depreciado"))
        ->groupBy('empresas.fantasia')
        ->get();

        $categorias = Categoria::with('produtos')->get();
        $total_itens = produto::with('produtos')->count();
        $total_categorias = Categoria::with('categorias')->count();
        $total_empresas = Empresa::with('empresas')->count();
        $itens_inativos = produto::with('produtos')->where('status_id', '=', 2)->count();

        $itens = Produto::with('empresa','categoria','images','localizacaoProduto','status')->get();

        return response()->json([
            'empresas' => $empresas,
            'categorias' => $categorias,
            'itens' => $itens,
            'count_total_itens'=> $total_itens,
            'count_itens_inativos' => $itens_inativos,
            'count_categorias' => $total_categorias,
            'total_valor_empresas' => $total_valor_empresas,
            'valor_categorias' => $valor_categorias,
            'count_empresas' => $total_empresas,
        ]);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
