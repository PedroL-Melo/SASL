<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'SASL') }}</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <!-- AlpineJS for Dropdowns etc -->
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="font-sans antialiased bg-[#FAF8F5] text-gray-900 flex h-screen">
  
  <!-- Sidebar -->
  <aside class="w-64 bg-[#EBEBEB] h-full flex flex-col justify-between border-r border-gray-300">
    <div>
      <!-- Logo Area -->
      <div class="h-20 flex items-center px-6">
        <div class="flex items-center gap-3">
          <div class="bg-green-600 rounded p-1 text-white">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
          </div>
          <div>
            <h1 class="font-bold text-lg leading-tight">Agendamento</h1>
            <p class="text-xs text-gray-600">Salas e laboratórios</p>
          </div>
        </div>
      </div>

      <!-- Navigation Links -->
      <nav class="mt-4 px-4 space-y-2">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-[#76A068] text-gray-900 font-bold' : 'text-gray-700 hover:bg-gray-200' }}">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
          Início
        </a>

        <a href="{{ route('agendamentos.create') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('agendamentos.create') ? 'bg-[#76A068] text-gray-900 font-bold' : 'text-gray-700 hover:bg-gray-200' }}">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path></svg>
          Agendar
        </a>

        <a href="{{ route('agendamentos.index') }}" class="flex items-center justify-between px-4 py-3 rounded-lg {{ request()->routeIs('agendamentos.index') ? 'bg-[#76A068] text-gray-900 font-bold' : 'text-gray-700 hover:bg-gray-200' }}">
          <div class="flex items-center gap-3">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
            Minhas reservas
          </div>
          @if(Auth::user()->status_usuario === 'professor')
            @php $pendentes = \App\Models\Agendamento::where('status_agendamento', 'pendente')->count(); @endphp
            @if($pendentes > 0)
              <span class="bg-red-600 text-white text-xs font-bold px-2 py-0.5 rounded-full">{{ $pendentes }}</span>
            @endif
          @endif
        </a>

        @if(Auth::user()->status_usuario === 'professor')
          <a href="{{ route('salas.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('salas.*') || request()->routeIs('laboratorios.*') ? 'bg-[#76A068] text-gray-900 font-bold' : 'text-gray-700 hover:bg-gray-200' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
            Salas e laboratórios
          </a>
        @endif
      </nav>
    </div>

    <div class="p-4 space-y-2 mb-4">
      <a href="#" class="flex items-center gap-3 px-4 py-2 text-gray-700 hover:text-gray-900">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        Ajuda
      </a>
      
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="w-full flex items-center gap-3 px-4 py-2 text-gray-700 hover:text-gray-900 text-left">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
          Sair
        </button>
      </form>
    </div>
  </aside>

  <!-- Main Content -->
  <div class="flex-1 flex flex-col h-full">
    
    <!-- Top Header -->
    <header class="h-20 flex justify-end items-center px-10 gap-6 border-b border-gray-200">
      <button class="text-gray-600 hover:text-gray-900">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
      </button>

      <!-- Profile Dropdown -->
      <div x-data="{ open: false }" class="relative">
        <button @click="open = !open" class="flex items-center gap-2 text-gray-800 font-medium hover:text-gray-900">
          <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center overflow-hidden">
            <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
          </div>
          <span>{{ Auth::user()->name }} ({{ ucfirst(Auth::user()->status_usuario) }})</span>
        </button>

        <div x-show="open" @click.away="open = false" style="display: none;" class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg py-1 z-50">
          <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Perfil</a>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Sair</button>
          </form>
        </div>
      </div>

      <a href="{{ route('profile.edit') }}" class="text-gray-600 hover:text-gray-900">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
      </a>
    </header>

    <!-- Main Workspace -->
    <main class="flex-1 overflow-y-auto p-10">
      @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-lg shadow">
          {{ session('success') }}
        </div>
      @endif
      @if(session('error'))
        <div class="mb-6 p-4 bg-red-100 text-red-800 rounded-lg shadow">
          {{ session('error') }}
        </div>
      @endif

      {{ $slot }}
    </main>
  </div>
</body>
</html>
