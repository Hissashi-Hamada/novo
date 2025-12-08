{{-- resources/views/layouts/app.blade.php --}}
<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>@yield('title', config('app.name', 'Laravel'))</title>

  <!-- Tailwind CDN (rápido para protótipo). Em produção, recomendo compilar com PostCSS) -->
  <script src="https://cdn.tailwindcss.com"></script>

  @stack('head')
</head>
<body class="bg-gray-100 min-h-screen text-gray-900">

  <header class="bg-white shadow">
    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex items-center justify-between">
      <a href="{{ url('/') }}" class="text-lg font-semibold">{{ config('app.name', 'Minha loja') }}</a>

      <nav class="flex items-center gap-4 text-sm">
        <a href="{{ route('produto.index') }}" class="hover:underline">Produtos</a>
        <a href="{{ route('produto.create') }}" class="px-3 py-1 bg-blue-600 text-white rounded text-xs">Novo</a>
      </nav>
    </div>
  </header>

  <main class="py-8">
    @if(session('success'))
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6">
        <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded">
          {{ session('success') }}
        </div>
      </div>
    @endif

    @yield('content')
  </main>

  <footer class="mt-12 py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-sm text-gray-500">
      &copy; {{ date('Y') }} {{ config('app.name', 'Minha loja') }}
    </div>
  </footer>

  @stack('scripts')
</body>
</html>
