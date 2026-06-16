<x-app-layout>
  <div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-800">Olá, {{ Auth::user()->name }}!</h1>
    <p class="text-gray-500 mt-1">Reserve salas e laboratórios de forma rápida e fácil</p>
  </div>

  <!-- Filters Bar (Mockup) -->
  <div class="flex flex-wrap gap-4 mb-8">
    <div class="flex-1 min-w-[250px] relative">
      <svg class="w-5 h-5 absolute left-3 top-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
      <input type="text" placeholder="Buscar salas ou laboratórios..." class="w-full pl-10 pr-4 py-2 bg-gray-100 border-transparent rounded-lg focus:bg-white focus:ring-2 focus:ring-[#76A068] focus:border-transparent outline-none">
    </div>
    <div class="w-48 bg-gray-100 rounded-lg flex items-center px-4 py-2 text-gray-600">
      <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
      <span class="text-sm">26/05/26</span> <!-- Static for mockup -->
    </div>
    <div class="w-48 bg-gray-100 rounded-lg flex items-center px-4 py-2 text-gray-600">
      <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
      <span class="text-sm">Todos os tipos</span>
    </div>
  </div>

  <!-- Cards Grid -->
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
    
    <!-- Salas -->
    @foreach($salas as $sala)
      @php
        $isAvailable = $sala->status_sala === 'disponivel';
        $borderColor = $isAvailable ? 'border-[#76A068]' : 'border-red-600';
        $badgeBg = $isAvailable ? 'bg-[#76A068]/20 text-[#76A068]' : 'bg-red-100 text-red-600';
        $btnColor = $isAvailable ? 'bg-[#76A068] hover:bg-[#608754] text-gray-900 font-bold' : 'bg-red-700 hover:bg-red-800 text-gray-900 font-bold';
        $btnText = $isAvailable ? 'Agendar' : 'Ver detalhes';
        $btnLink = $isAvailable ? route('agendamentos.create', ['sala_id' => $sala->id]) : '#';
      @endphp
      <div class="bg-gray-100 rounded-xl border-2 {{ $borderColor }} p-4 flex flex-col items-center justify-between aspect-square text-center">
        <div class="mt-2 text-gray-700">
          <svg class="w-12 h-12 mx-auto mb-2" fill="currentColor" viewBox="0 0 24 24"><path d="M21 16V4H3v12H2v2h20v-2h-1zm-2 0H5V6h14v10z"></path><path d="M11 9a2 2 0 112-2 2 2 0 01-2 2zm0-2zm-3.5 5h7a1.5 1.5 0 00-1.5-1.5h-4A1.5 1.5 0 007.5 12z"></path></svg>
          <h3 class="font-bold text-lg text-black">{{ $sala->nome }}</h3>
          <p class="text-xs text-gray-500">Bloco {{ $sala->bloco }} - {{ $sala->piso === 0 ? 'Térreo' : $sala->piso . 'º andar' }}</p>
          <span class="inline-block px-3 py-1 rounded-full text-[10px] font-bold uppercase mt-2 {{ $badgeBg }}">
            {{ $sala->status_sala }}
          </span>
        </div>
        
        <div class="w-full mt-4">
          <p class="text-xs text-gray-500 mb-2">Capacidade: {{ $sala->capacidade }} pessoas</p>
          <a href="{{ $btnLink }}" class="block w-full py-2 rounded-lg font-semibold transition-colors {{ $btnColor }}">
            {{ $btnText }}
          </a>
        </div>
      </div>
    @endforeach

    <!-- Laboratórios -->
    @foreach($laboratorios as $lab)
      @php
        $isAvailable = $lab->status_laboratorio === 'disponivel';
        $borderColor = $isAvailable ? 'border-[#76A068]' : 'border-red-600';
        $badgeBg = $isAvailable ? 'bg-[#76A068]/20 text-[#76A068]' : 'bg-red-100 text-red-600';
        $btnColor = $isAvailable ? 'bg-[#76A068] hover:bg-[#608754] text-gray-900 font-bold' : 'bg-red-700 hover:bg-red-800 text-gray-900 font-bold';
        $btnText = $isAvailable ? 'Agendar' : 'Ver detalhes';
        $btnLink = $isAvailable ? route('agendamentos.create', ['laboratorio_id' => $lab->id]) : '#';
      @endphp
      <div class="bg-gray-100 rounded-xl border-2 {{ $borderColor }} p-4 flex flex-col items-center justify-between aspect-square text-center">
        <div class="mt-2 text-gray-700">
          <svg class="w-12 h-12 mx-auto mb-2" fill="currentColor" viewBox="0 0 24 24"><path d="M20 22H4a1 1 0 01-1-1v-2l5-9V3a1 1 0 011-1h6a1 1 0 011 1v7l5 9v2a1 1 0 01-1 1zm-15-2h14l-4.444-8h-5.11L5 20zm5-16v6h4V4h-4z"></path></svg>
          <h3 class="font-bold text-lg text-black">{{ $lab->nome }}</h3>
          <p class="text-xs text-gray-500">Bloco {{ $lab->bloco }} - {{ $lab->piso === 0 ? 'Térreo' : $lab->piso . 'º andar' }}</p>
          <span class="inline-block px-3 py-1 rounded-full text-[10px] font-bold uppercase mt-2 {{ $badgeBg }}">
            {{ $lab->status_laboratorio }}
          </span>
        </div>
        
        <div class="w-full mt-4">
          <p class="text-xs text-gray-500 mb-2">Capacidade: {{ $lab->capacidade }} pessoas</p>
          <a href="{{ $btnLink }}" class="block w-full py-2 rounded-lg font-semibold transition-colors {{ $btnColor }}">
            {{ $btnText }}
          </a>
        </div>
      </div>
    @endforeach

  </div>
</x-app-layout>
