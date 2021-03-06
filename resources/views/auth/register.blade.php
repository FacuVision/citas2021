<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>
        <x-jet-validation-errors class="mb-4" />
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-jet-label for="name1" value="{{ __('Nombre') }}" />
                <x-jet-input disabled id="name1" class="block mt-1 w-full" type="text" name="name1" :value="old('name')" required autofocus autocomplete="name" placeholder="Llenado al validar"/>
                <input type="hidden" name="name" id="name" value="">
            </div>

            <div class="mt-4">
                <x-jet-label for="apellido1" value="{{ __('Apellido') }}" />
                <x-jet-input disabled id="apellido1" class="block mt-1 w-full" type="text"   name="apellido1" :value="old('apellido')" required placeholder="Llenado al validar"/>
                <input type="hidden" name="apellido" id="apellido" value="">
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Contraseña') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirme Contraseña') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="dni1" value="{{ __('DNI') }}" />
                <x-jet-input id="dni1" class="mt-1 w-100" type="text" :value="old('dni')" name="dni1" required />
                <input type="hidden" name="dni" id="dni" value="">
                <input type="button" class="bg-white hover:bg-gray-100
                text-indigo-600 font-semibold py-2 px-4 border border-gray-400 rounded
                shadow" onclick="consultar()" value="Validar">
            </div>

            <div class="mt-4">
                <x-jet-label for="fecha_nac" value="{{ __('Fecha de Nacimiento') }}" />
                <x-jet-input id="fecha_nac" name="fecha_nac" type="date" class="mt-1 block w-full" wire:model.defer="state.fecha_nac" />
            </div>

            <div class="mt-4">
                <x-jet-label for="edad" value="{{ __('Edad') }}" />
                <x-jet-input id="edad" class="block mt-1 w-full" :value="old('edad')"  type="number" name="edad" required autocomplete="edad"/>
            </div>

            <div class="col-span-6 sm:col-span-3">
                <label for="sexo" class="block text-sm font-medium text-gray-700">Sexo</label>
                <select id="sexo" name="sexo" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="m">Hombre</option>
                    <option value="f">Mujer</option>
                </select>
            </div>





            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms"/>

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
<script src="{{ asset('vendor/js/api_dni.js') }}"></script>
