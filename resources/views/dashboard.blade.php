<x-app-layout>
  {{-- Cabeçalho de boas-vindas --}}
  <div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-800">Olá, {{ Auth::user()->name }}!</h1>
    <p class="text-gray-500 mt-1">Reserve salas e laboratórios de forma rápida e fácil</p>
  </div>

  {{-- Barra de filtros --}}
  <div class="flex flex-wrap gap-4 mb-8">
    {{-- Campo de busca --}}
    <div class="flex-1 min-w-[250px] relative">
      <svg class="w-5 h-5 absolute left-3 top-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
      <input type="text" placeholder="Buscar salas ou laboratórios..." class="w-full pl-10 pr-4 py-2.5 bg-white border border-gray-200 rounded-lg focus:bg-white focus:ring-2 focus:ring-[#76A068] focus:border-transparent outline-none text-sm">
    </div>
    {{-- Filtro de data --}}
    <div class="bg-white border border-gray-200 rounded-lg flex items-center px-4 py-2.5 text-gray-600 gap-2">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
      <span class="text-sm">{{ now()->format('d/m/y') }}</span>
    </div>
    {{-- Filtro de tipo --}}
    <div class="bg-white border border-gray-200 rounded-lg flex items-center px-4 py-2.5 text-gray-600 gap-2">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
      <span class="text-sm">Todos os tipos</span>
    </div>
  </div>

  {{-- Grid de Cards --}}
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
    
    {{-- === SALAS === --}}
    @foreach($salas as $sala)
      @php
        $isAvailable = $sala->status_sala === 'disponivel';
        $accentBorder = $isAvailable ? 'border-l-[#76A068]' : 'border-l-red-600';
        $badgeClasses = $isAvailable ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-600';
        $badgeText    = $isAvailable ? 'Disponível' : ucfirst($sala->status_sala);
        $btnClasses   = $isAvailable
            ? 'bg-[#76A068] hover:bg-[#608754] text-white'
            : 'bg-red-700 hover:bg-red-800 text-white';
        $btnText = $isAvailable ? 'Agendar' : 'Ver detalhes';
        $btnLink = $isAvailable ? route('agendamentos.create', ['sala_id' => $sala->id]) : '#';
      @endphp
      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 border-l-[6px] {{ $accentBorder }} p-6 flex flex-col items-center justify-between text-center aspect-square">
        {{-- Conteúdo superior: ícone + informações --}}
        <div class="flex flex-col items-center gap-1 w-full">
          {{-- Ícone de monitor/sala --}}
          <svg class="w-10 h-10 text-gray-700 mb-1" fill="currentColor" viewBox="0 0 24 24"><path d="M21 16V4H3v12H2v2h20v-2h-1zm-2 0H5V6h14v10z"></path><path d="M11 9a2 2 0 112-2 2 2 0 01-2 2zm0-2zm-3.5 5h7a1.5 1.5 0 00-1.5-1.5h-4A1.5 1.5 0 007.5 12z"></path></svg>
          {{-- Nome e localização --}}
          <h3 class="font-bold text-base text-gray-900">{{ $sala->nome }}</h3>
          <p class="text-xs text-gray-500">Bloco {{ $sala->bloco }} - {{ $sala->piso === 0 ? 'Térreo' : $sala->piso . 'º andar' }}</p>
          {{-- Badge de status --}}
          <span class="inline-block px-3 py-0.5 rounded-full text-[10px] font-bold uppercase mt-1 {{ $badgeClasses }}">
            {{ $badgeText }}
          </span>
        </div>

        {{-- Conteúdo inferior: capacidade + botão --}}
        <div class="w-full mt-3 pt-3 border-t border-gray-100">
          <p class="text-[11px] text-gray-400 mb-2">Capacidade: {{ $sala->capacidade }} pessoas</p>
          <a href="{{ $btnLink }}" class="block w-full py-2 rounded-lg text-sm font-semibold transition-colors {{ $btnClasses }}">
            {{ $btnText }}
          </a>
        </div>
      </div>
    @endforeach

    {{-- === LABORATÓRIOS === --}}
    @foreach($laboratorios as $lab)
      @php
        $isAvailable = $lab->status_laboratorio === 'disponivel';
        $accentBorder = $isAvailable ? 'border-l-[#76A068]' : 'border-l-red-600';
        $badgeClasses = $isAvailable ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-600';
        $badgeText    = $isAvailable ? 'Disponível' : ucfirst($lab->status_laboratorio);
        $btnClasses   = $isAvailable
            ? 'bg-[#76A068] hover:bg-[#608754] text-white'
            : 'bg-red-700 hover:bg-red-800 text-white';
        $btnText = $isAvailable ? 'Agendar' : 'Ver detalhes';
        $btnLink = $isAvailable ? route('agendamentos.create', ['laboratorio_id' => $lab->id]) : '#';
      @endphp
      <div class="bg-white rounded-xl shadow-sm border border-gray-100 border-l-4 {{ $accentBorder }} p-5 flex flex-col items-center justify-between text-center aspect-square">
        {{-- Conteúdo superior: ícone + informações --}}
        <div class="flex flex-col items-center gap-1 w-full">
          {{-- Ícone de laboratório (frasco/béquer) --}}
          <svg class="w-10 h-10 text-gray-700 mb-1" fill="currentColor" viewBox="0 0 24 24"><path d="M20 22H4a1 1 0 01-1-1v-2l5-9V3a1 1 0 011-1h6a1 1 0 011 1v7l5 9v2a1 1 0 01-1 1zm-15-2h14l-4.444-8h-5.11L5 20zm5-16v6h4V4h-4z"></path></svg>
          {{-- Nome e localização --}}
          <h3 class="font-bold text-base text-gray-900">{{ $lab->nome }}</h3>
          <p class="text-xs text-gray-500">Bloco {{ $lab->bloco }} - {{ $lab->piso === 0 ? 'Térreo' : $lab->piso . 'º andar' }}</p>
          {{-- Badge de status --}}
          <span class="inline-block px-3 py-0.5 rounded-full text-[10px] font-bold uppercase mt-1 {{ $badgeClasses }}">
            {{ $badgeText }}
          </span>
        </div>

        {{-- Conteúdo inferior: capacidade + botão --}}
        <div class="w-full mt-3 pt-3 border-t border-gray-100">
          <p class="text-[11px] text-gray-400 mb-2">Capacidade: {{ $lab->capacidade }} pessoas</p>
          <a href="{{ $btnLink }}" class="block w-full py-2 rounded-lg text-sm font-semibold transition-colors {{ $btnClasses }}">
            {{ $btnText }}
          </a>
        </div>
      </div>
    @endforeach

  </div>

  {{-- Rodapé --}}
  <div class="mt-10 text-center text-xs text-gray-400">
    {{ date('Y') }} Sistema de Agendamento – Todos os direitos reservados
  </div>
</x-app-layout>
