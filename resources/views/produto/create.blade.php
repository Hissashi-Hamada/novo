@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h2>Novo Produto</h2>

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('produto.store') }}" method="POST">
    @csrf
    <div class="mb-3">
      <label class="form-label">Nome</label>
      <input name="nome" value="{{ old('nome') }}" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Valor</label>
      <input name="valor" type="number" step="0.01" value="{{ old('valor') }}" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Quantidade</label>
      <input name="quantidade" type="number" value="{{ old('quantidade', 0) }}" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Status</label>
      <select name="status" class="form-select">
        <option value="ativo" {{ old('status') == 'ativo' ? 'selected': '' }}>Ativo</option>
        <option value="inativo" {{ old('status') == 'inativo' ? 'selected': '' }}>Inativo</option>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Descrição</label>
      <textarea name="descricao" class="form-control">{{ old('descricao') }}</textarea>
    </div>

    <button class="btn btn-primary">Salvar</button>
    <a href="{{ route('produto.index') }}" class="btn btn-secondary">Cancelar</a>
  </form>
</div>
@endsection
