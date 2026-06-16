<x-app-layout>
    <div x-data="{ openCancelModal: false, cancelFormAction: '' }">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Minhas Reservas</h2>
            <a href="{{ route('agendamentos.create') }}" class="bg-[#76A068] hover:bg-[#608754] text-gray-900 font-bold px-4 py-2 rounded-lg font-medium transition-colors">
                + Novo Agendamento
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100 text-gray-600">
                        <th class="p-4 font-semibold">Solicitante</th>
                        <th class="p-4 font-semibold">Espaço</th>
                        <th class="p-4 font-semibold">Início</th>
                        <th class="p-4 font-semibold">Fim</th>
                        <th class="p-4 font-semibold">Status</th>
                        <th class="p-4 font-semibold text-right">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($agendamentos as $agendamento)
                        @if(Auth::user()->status_usuario === 'professor' || $agendamento->user_id === Auth::id())
                        <tr class="border-b border-gray-50 hover:bg-gray-50 transition-colors">
                            <td class="p-4 text-gray-800 font-medium">{{ $agendamento->user->name ?? 'Desconhecido' }}</td>
                            <td class="p-4 text-gray-600">
                                @if($agendamento->sala_id)
                                    {{ $agendamento->sala->nome ?? 'Sala removida' }}
                                @elseif($agendamento->laboratorio_id)
                                    {{ $agendamento->laboratorio->nome ?? 'Laboratório removido' }}
                                @else
                                    -
                                @endif
                            </td>
                            <td class="p-4 text-gray-600">{{ \Carbon\Carbon::parse($agendamento->data_hora_inicio)->format('d/m/Y H:i') }}</td>
                            <td class="p-4 text-gray-600">{{ \Carbon\Carbon::parse($agendamento->data_hora_fim)->format('d/m/Y H:i') }}</td>
                            <td class="p-4">
                                @if($agendamento->status_agendamento === 'pendente')
                                    <span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-bold uppercase">Pendente</span>
                                @elseif($agendamento->status_agendamento === 'aprovado')
                                    <span class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold uppercase">Aprovado</span>
                                @elseif($agendamento->status_agendamento === 'concluida')
                                    <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-bold uppercase">Concluída</span>
                                @elseif($agendamento->status_agendamento === 'rejeitado' || $agendamento->status_agendamento === 'cancelado')
                                    <span class="px-2 py-1 bg-red-100 text-red-700 rounded-full text-xs font-bold uppercase">{{ $agendamento->status_agendamento }}</span>
                                @else
                                    <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded-full text-xs font-bold uppercase">{{ $agendamento->status_agendamento }}</span>
                                @endif
                            </td>
                            <td class="p-4 text-right space-x-3">
                                @if(Auth::user()->status_usuario === 'professor' || $agendamento->status_agendamento === 'pendente')
                                    <a href="{{ route('agendamentos.edit', $agendamento) }}" class="text-blue-600 hover:text-blue-800 font-medium text-sm">Editar</a>
                                @endif
                                
                                @if((Auth::user()->status_usuario === 'professor' || $agendamento->user_id === Auth::id()) && !in_array($agendamento->status_agendamento, ['cancelado', 'concluida']))
                                    <button type="button" @click="openCancelModal = true; cancelFormAction = '{{ route('agendamentos.destroy', $agendamento) }}'" class="text-red-600 hover:text-red-800 font-medium text-sm">
                                        Cancelar
                                    </button>
                                @endif
                            </td>
                        </tr>
                        @endif
                    @empty
                        <tr>
                            <td colspan="6" class="p-8 text-center text-gray-500">Nenhum agendamento encontrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Modal de Cancelamento Centralizado -->
        <div x-show="openCancelModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40" style="display: none;">
            <div @click.away="openCancelModal = false" class="bg-white rounded-xl shadow-lg p-6 max-w-sm w-full mx-4 transform transition-all">
                <div class="text-center">
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                        <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </div>
                    <h3 class="text-lg leading-6 font-bold text-gray-900 mb-2">Cancelar Reserva</h3>
                    <p class="text-sm text-gray-500 mb-6">
                        Tem certeza que deseja cancelar esta reserva? Esta ação mudará o status do agendamento e liberará o espaço.
                    </p>
                    <div class="flex justify-center gap-3">
                        <button type="button" @click="openCancelModal = false" class="px-4 py-2 bg-gray-100 text-gray-700 hover:bg-gray-200 rounded-lg font-medium transition-colors">
                            Voltar
                        </button>
                        <form :action="cancelFormAction" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white hover:bg-red-700 rounded-lg font-medium transition-colors">
                                Sim, Cancelar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
