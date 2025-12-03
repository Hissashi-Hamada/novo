<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index()
    {
        return Produto::all();
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
        return Produto::findOrFail($id);
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

        $produto->update($data);

        return $produto;
    }

    public function destroy($id)
    {
        $produto = Produto::findOrFail($id);
        $produto->delete();

        return response()->json(['mensagem' => 'Produto removido com sucesso']);
    }
}
