<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Http\Controllers\enum;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProdutoController extends Controller
{
    public function index()
{
    $produtos = Produto::all();
    return view('produto.index', compact('produtos'));
}
        
    public function create()
    {
        return view('produto.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string',
            'descricao' => 'nullable|string',
            'valor' => 'required|numeric',
            'quantidade' => 'required|integer',
            'status' => 'required|string|in:ativo,inativo'
        ]);

        return redirect()->route('produto.index')
        ->with('success', 'Produto criado com sucesso');

    }

    public function show($id) 
        {
            $produto = Produto::findOrFail($id);
            return view('produto.show', compact('produto'));
        }

    function update(Request $request, $id)
{
    $produto = Produto::findOrFail($id);

    $data = $request->validate([
        'nome' => 'sometimes|string',
        'descricao' => 'sometimes|string',
        'valor' => 'sometimes|numeric',
        'quantidade' => 'sometimes|integer',
        'status' => 'sometimes|boolean'
    ]);

    $produto->update($data);

    return redirect()->route('produto.index')->with('success', 'Produto atualizado com sucesso');
}

    public function destroy($id)
    {
        $produto = Produto::findOrFail($id);
        $produto->delete();

        return response()->json(['mensagem' => 'Produto removido com sucesso']);
    }

}