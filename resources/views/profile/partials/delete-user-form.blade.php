<section class="space-y-6">
  <header>
    <!-- Título da seção de exclusão de conta -->
    <h2 class="text-lg font-medium text-gray-900 ">
      {{ __('Apagar Conta') }}
    </h2>

    <!-- Descrição do aviso de exclusão -->
    <p class="mt-1 text-sm text-gray-600 ">
      {{ __('Depois que sua conta for apagada, todos os seus recursos e dados serão excluídos permanentemente. Antes de apagar sua conta, faça o download de quaisquer dados ou informações que você deseja reter.') }}
    </p>
  </header>

  <!-- Botão que abre o modal de confirmação -->
  <x-danger-button
    x-data=""
    x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
  >{{ __('Apagar Conta') }}</x-danger-button>

  <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
    <!-- Formulário de exclusão de conta -->
    <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
      @csrf
      @method('delete')

      <h2 class="text-lg font-medium text-gray-900 ">
        {{ __('Tem certeza de que deseja apagar sua conta?') }}
      </h2>

      <p class="mt-1 text-sm text-gray-600 ">
        {{ __('Depois que sua conta for apagada, todos os seus recursos e dados serão excluídos permanentemente. Por favor, digite sua senha para confirmar que você gostaria de apagar sua conta permanentemente.') }}
      </p>

      <div class="mt-6">
        <!-- Campo de senha para confirmação -->
        <x-input-label for="password" value="{{ __('Senha') }}" class="sr-only" />

        <x-text-input
          id="password"
          name="password"
          type="password"
          class="mt-1 block w-3/4"
          placeholder="{{ __('Senha') }}"
        />

        <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
      </div>

      <div class="mt-6 flex justify-end">
        <!-- Botão cancelar -->
        <x-secondary-button x-on:click="$dispatch('close')">
          {{ __('Cancelar') }}
        </x-secondary-button>

        <!-- Botão confirmar exclusão -->
        <x-danger-button class="ms-3">
          {{ __('Apagar Conta') }}
        </x-danger-button>
      </div>
    </form>
  </x-modal>
</section>
