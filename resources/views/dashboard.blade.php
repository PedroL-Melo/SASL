<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Salas e Laboratórios
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-medium text-gray-900">Lista de Ambientes</h3>
                        <button class="px-4 py-2 bg-green-700 text-white text-sm font-medium rounded-md hover:bg-green-800 transition">
                            + Novo Agendamento
                        </button>
                    </div>
                    
                    <div class="flex flex-col items-center justify-center py-16 text-center text-gray-500 bg-gray-50 border-2 border-dashed border-gray-300 rounded-lg">
                        <svg class="w-16 h-16 mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        <p class="text-lg font-medium text-gray-700">Nenhum ambiente encontrado</p>
                        <p class="text-sm mt-1">A lista de salas e laboratórios aparecerá aqui no futuro.</p>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>
