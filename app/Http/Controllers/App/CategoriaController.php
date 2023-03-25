<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categoria;
use Illuminate\Database\QueryException;


class CategoriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categorias = Categoria::with('produtos','produtos.categoria','produtos.status')->get();
        return view('app.categorias', compact('categorias'));
        // return json_encode($categorias);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {

        $this->validate($request,[
            'descricao' => 'required',
            'user_id' => 'required'
        ]);

        if ($request->input('descricao')) {
            $categoria = new Categoria();
            $categoria->descricao = strtoupper($request->input('descricao'));
            $categoria->created_at_user_id = $request->input('user_id');
            $categoria->updated_at_user_id = $request->input('user_id');
            $categoria->save();

            return $categoria->toJson();
        }
        return redirect()->route('categorias');

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
        $this->validate($request,[
            'descricao' => 'required',
            'user_id' => 'required'
        ]);

        $categoria = Categoria::find($id);
        if ($categoria)
        {
            $categoria->descricao = strtoupper($request->input('descricao'));
            $categoria->updated_at_user_id = $request->input('user_id');
            $categoria->save();
            // return $categoria->toJson();
            return redirect()->route('categorias');
        }
        return redirect()->route('categorias');
    }


    public function destroy($id)
    {
        $categoria = Categoria::find($id);
        if ($categoria)
        {
            try {
                $categoria->delete();
                return redirect()->route('categorias');
            } catch (QueryException $e) {
                return redirect()->back()->with('error','Não foi possível excluir a Categoria  ' . $categoria->descricao. '. Verifique se existe itens relacionados!');
            }
        }
        return redirect()->route('categorias');
    }
}
