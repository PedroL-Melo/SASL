<x-app-layout>
  <div class="mb-6">
    <a href="{{ route('agendamentos.index') }}" class="text-gray-500 hover:text-gray-800 text-sm flex items-center gap-1">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
      Voltar para Agendamentos
    </a>
  </div>

  <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 max-w-2xl">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Solicitar Novo Agendamento</h2>

    <form action="{{ route('agendamentos.store') }}" method="POST" class="space-y-4" x-data="{ sala: '{{ old('sala_id', request('sala_id')) }}', lab: '{{ old('laboratorio_id', request('laboratorio_id')) }}' }">
      @csrf
      
      <div class="grid grid-cols-2 gap-4">
        <div>
          <label for="sala_id" class="block text-sm font-medium text-gray-700 mb-1">Sala</label>
          <select name="sala_id" id="sala_id" x-model="sala" @change="if(sala) lab = ''" class="w-full rounded-lg border-gray-300 focus:border-[#76A068] focus:ring-[#76A068] shadow-sm">
            <option value="">Selecione uma sala...</option>
            @foreach($salas as $sala)
              <option value="{{ $sala->id }}" {{ (old('sala_id') == $sala->id || request('sala_id') == $sala->id) ? 'selected' : '' }}>
                {{ $sala->nome }} (Capacidade: {{ $sala->capacidade }})
              </option>
            @endforeach
          </select>
          @error('sala_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
        <div>
          <label for="laboratorio_id" class="block text-sm font-medium text-gray-700 mb-1">Laboratório</label>
          <select name="laboratorio_id" id="laboratorio_id" x-model="lab" @change="if(lab) sala = ''" class="w-full rounded-lg border-gray-300 focus:border-[#76A068] focus:ring-[#76A068] shadow-sm">
            <option value="">Selecione um laboratório...</option>
            @foreach($laboratorios as $lab)
              <option value="{{ $lab->id }}" {{ (old('laboratorio_id') == $lab->id || request('laboratorio_id') == $lab->id) ? 'selected' : '' }}>
                {{ $lab->nome }} (Capacidade: {{ $lab->capacidade }})
              </option>
            @endforeach
          </select>
          @error('laboratorio_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
      </div>
      <p class="text-xs text-gray-500 mt-1">Selecione apenas uma Sala OU um Laboratório.</p>

      <div class="grid grid-cols-2 gap-4 mt-4">
        <div>
          <label for="data_hora_inicio" class="block text-sm font-medium text-gray-700 mb-1">Data/Hora de Início</label>
          <input type="datetime-local" name="data_hora_inicio" id="data_hora_inicio" value="{{ old('data_hora_inicio') }}" required class="w-full rounded-lg border-gray-300 focus:border-[#76A068] focus:ring-[#76A068] shadow-sm">
          @error('data_hora_inicio') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
        <div>
          <label for="data_hora_fim" class="block text-sm font-medium text-gray-700 mb-1">Data/Hora de Fim</label>
          <input type="datetime-local" name="data_hora_fim" id="data_hora_fim" value="{{ old('data_hora_fim') }}" required class="w-full rounded-lg border-gray-300 focus:border-[#76A068] focus:ring-[#76A068] shadow-sm">
          @error('data_hora_fim') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
      </div>

      <div class="pt-4 flex justify-end">
        <button type="submit" class="bg-[#76A068] hover:bg-[#608754] text-gray-900 font-bold px-6 py-2 rounded-lg transition-colors">
          Salvar Agendamento
        </button>
      </div>
    </form>
  </div>
</x-app-layout>
