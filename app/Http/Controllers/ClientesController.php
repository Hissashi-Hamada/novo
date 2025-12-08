<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientesController extends Controller
{

    public function index()
    {
        return view('cliente.index');
    }

    public function create()
    {
        return view('cliente.create');
    }

    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|email|unique:users,email',
    //         'password' => 'required|string|min:6',
        
    //         // Campos opcionais
    //         'cpf' => 'nullable|string|max:11|unique:users,cpf',
    //         'data_nascimento' => 'nullable|date',
    //         'telefone' => 'nullable|string|max:20',
    //     ]);
    
    //     $validated['password'] = bcrypt($validated['password']);
    
    //     User::create($validated);
    
    //     return redirect()->route('cliente/login')->with('success', 'Conta criada com sucesso.');
    // }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
