@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h2>Produto: {{ $produto->nome }}</h2>

  <div class="mb-3"><strong>Valor:</strong> R$ {{ number_format($produto->valor,2,',','.') }}</div>
  <div class="mb-3"><strong>Quantidade:</strong> {{ $produto->quantidade }}</div>
  <div class="mb-3"><strong>Status:</strong> {{ ucfirst($produto->status) }}</div>
  <div class="mb-3"><strong>Descrição:</strong>
    <div class="border p-3">{{ $produto->descricao }}</div>
  </div>

  <a href="{{ route('produto.edit', $produto->id) }}" class="btn btn-info">Editar</a>

  <form action="{{ route('produto.destroy', $produto->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Confirma exclusão?')">
    @csrf
    @method('DELETE')
    <button class="btn btn-danger">Excluir</button>
  </form>

  <a href="{{ route('produto.index') }}" class="btn btn-secondary">Voltar</a>
</div>
@endsection
