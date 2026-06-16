<x-app-layout>
  <div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Gerenciar Laboratórios</h2>
    <a href="{{ route('laboratorios.create') }}" class="bg-[#76A068] hover:bg-[#608754] text-gray-900 font-bold px-4 py-2 rounded-lg font-medium transition-colors">
      + Novo Laboratório
    </a>
  </div>

  <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="w-full text-left border-collapse">
      <thead>
        <tr class="bg-gray-50 border-b border-gray-100 text-gray-600">
          <th class="p-4 font-semibold">Nome</th>
          <th class="p-4 font-semibold">Bloco / Piso</th>
          <th class="p-4 font-semibold">Capacidade</th>
          <th class="p-4 font-semibold">Status</th>
          <th class="p-4 font-semibold text-right">Ações</th>
        </tr>
      </thead>
      <tbody>
        @forelse($laboratorios as $lab)
          <tr class="border-b border-gray-50 hover:bg-gray-50 transition-colors">
            <td class="p-4 text-gray-800 font-medium">{{ $lab->nome }}</td>
            <td class="p-4 text-gray-600">Bloco {{ $lab->bloco }} - {{ $lab->piso === 0 ? 'Térreo' : $lab->piso . 'º andar' }}</td>
            <td class="p-4 text-gray-600">{{ $lab->capacidade }} pessoas</td>
            <td class="p-4">
              @if($lab->status_laboratorio === 'disponivel')
                <span class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold uppercase">Disponível</span>
              @elseif($lab->status_laboratorio === 'manutencao')
                <span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-bold uppercase">Manutenção</span>
              @else
                <span class="px-2 py-1 bg-red-100 text-red-700 rounded-full text-xs font-bold uppercase">Inativo</span>
              @endif
            </td>
            <td class="p-4 text-right space-x-2">
              <a href="{{ route('laboratorios.edit', $lab) }}" class="text-blue-600 hover:text-blue-800 font-medium text-sm">Editar</a>
              <form action="{{ route('laboratorios.destroy', $lab) }}" method="POST" class="inline" onsubmit="return confirm('Tem certeza que deseja apagar este laboratório?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 hover:text-red-800 font-medium text-sm">Excluir</button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="5" class="p-8 text-center text-gray-500">Nenhum laboratório cadastrado.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</x-app-layout>
