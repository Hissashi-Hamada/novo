@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h2>Editar Produto: {{ $produto->nome }}</h2>

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('produto.update', $produto->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
      <label class="form-label">Nome</label>
      <input name="nome" value="{{ old('nome', $produto->nome) }}" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Valor</label>
      <input name="valor" type="number" step="0.01" value="{{ old('valor', $produto->valor) }}" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Quantidade</label>
      <input name="quantidade" type="number" value="{{ old('quantidade', $produto->quantidade) }}" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Status</label>
      <select name="status" class="form-select">
        <option value="ativo" {{ old('status', $produto->status) == 'ativo' ? 'selected': '' }}>Ativo</option>
        <option value="inativo" {{ old('status', $produto->status) == 'inativo' ? 'selected': '' }}>Inativo</option>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Descrição</label>
      <textarea name="descricao" class="form-control">{{ old('descricao', $produto->descricao) }}</textarea>
    </div>

    <button class="btn btn-primary">Atualizar</button>
    <a href="{{ route('produto.index') }}" class="btn btn-secondary">Cancelar</a>
  </form>
</div>
@endsection
