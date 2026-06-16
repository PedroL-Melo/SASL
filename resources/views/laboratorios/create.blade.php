<x-app-layout>
  <div class="mb-6">
    <a href="{{ route('laboratorios.index') }}" class="text-gray-500 hover:text-gray-800 text-sm flex items-center gap-1">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
      Voltar para Laboratórios
    </a>
  </div>

  <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 max-w-2xl">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Cadastrar Novo Laboratório</h2>

    <form action="{{ route('laboratorios.store') }}" method="POST" class="space-y-4">
      @csrf
      
      <div>
        <label for="nome" class="block text-sm font-medium text-gray-700 mb-1">Nome do Laboratório</label>
        <input type="text" name="nome" id="nome" value="{{ old('nome') }}" required class="w-full rounded-lg border-gray-300 focus:border-[#76A068] focus:ring-[#76A068] shadow-sm">
        @error('nome') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
      </div>

      <div class="grid grid-cols-2 gap-4">
        <div>
          <label for="capacidade" class="block text-sm font-medium text-gray-700 mb-1">Capacidade (pessoas)</label>
          <input type="number" name="capacidade" id="capacidade" value="{{ old('capacidade') }}" required min="1" class="w-full rounded-lg border-gray-300 focus:border-[#76A068] focus:ring-[#76A068] shadow-sm">
          @error('capacidade') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
        <div>
          <label for="status_laboratorio" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
          <select name="status_laboratorio" id="status_laboratorio" required class="w-full rounded-lg border-gray-300 focus:border-[#76A068] focus:ring-[#76A068] shadow-sm">
            <option value="disponivel" {{ old('status_laboratorio') == 'disponivel' ? 'selected' : '' }}>Disponível</option>
            <option value="manutencao" {{ old('status_laboratorio') == 'manutencao' ? 'selected' : '' }}>Em Manutenção</option>
            <option value="inativo" {{ old('status_laboratorio') == 'inativo' ? 'selected' : '' }}>Inativo</option>
          </select>
          @error('status_laboratorio') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
      </div>

      <div class="grid grid-cols-2 gap-4">
        <div>
          <label for="bloco" class="block text-sm font-medium text-gray-700 mb-1">Bloco</label>
          <input type="text" name="bloco" id="bloco" value="{{ old('bloco') }}" required class="w-full rounded-lg border-gray-300 focus:border-[#76A068] focus:ring-[#76A068] shadow-sm placeholder-gray-400" placeholder="Ex: A, B, C">
          @error('bloco') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
        <div>
          <label for="piso" class="block text-sm font-medium text-gray-700 mb-1">Piso (0 = Térreo)</label>
          <input type="number" name="piso" id="piso" value="{{ old('piso') }}" required min="0" class="w-full rounded-lg border-gray-300 focus:border-[#76A068] focus:ring-[#76A068] shadow-sm">
          @error('piso') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
      </div>

      <div class="pt-4 flex justify-end">
        <button type="submit" class="bg-[#76A068] hover:bg-[#608754] text-gray-900 font-bold px-6 py-2 rounded-lg font-medium transition-colors">
          Salvar Laboratório
        </button>
      </div>
    </form>
  </div>
</x-app-layout>
