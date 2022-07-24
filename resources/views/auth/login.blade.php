<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
        <a href="/"><x-jet-authentication-card-logo /></a>
            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;JC Events</p>
        </x-slot>
        <div class="social">
                <a href="/login/facebook"><img src="/img/btn_facebook.png" width="210" height="140" alt=""></a>
        </div><BR> 
        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Senha') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Lembre-me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('register') }}">
                    {{ __('Cadastrar') }}
                </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Esqueceu sua senha?') }}
                    </a>
                @endif

                <a x-jet-button class="ml-4" href="/">
                    Voltar
                </a>
                
                <x-jet-button class="ml-4">
                    {{ __('Entrar') }}
                </x-jet-button>
                
            </div>
              
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
