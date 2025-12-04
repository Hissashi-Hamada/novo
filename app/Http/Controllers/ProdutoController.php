<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProdutoController extends Controller
{
    public function index()
    {
        $posts = Produto::all();
        return View('produto.index');
    }
        
    public function create()
    {
        return view('produto.index');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string',
            'descricao' => 'nullable|string',
            'valor' => 'required|numeric',
            'quantidade' => 'required|integer',
            'status' => 'required|boolean'
        ]);

        return Produto::create($data);
    }

    public function show($id)
    {
        
    }

    public function update(Request $request, $id)
    {
        $produto = Produto::findOrFail($id);

        $data = $request->validate([
            'nome' => 'sometimes|string',
            'descricao' => 'sometimes|string',
            'valor' => 'sometimes|numeric',
            'quantidade' => 'sometimes|integer',
            'status' => 'sometimes|boolean'
        ]);

        return redirect()->route('produto.index')->with('success', 'Produto atualizado com sucesso');
        
    }

    public function destroy($id)
    {
        $produto = Produto::findOrFail($id);
        $produto->delete();

        return response()->json(['mensagem' => 'Produto removido com sucesso']);
    }
}
