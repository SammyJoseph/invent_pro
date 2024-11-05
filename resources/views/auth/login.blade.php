<x-guest-layout>
    <div class="bg-gray-50">
        <div class="max-w-6xl mx-auto grid lg:grid-cols-2 items-center py-8 lg:py-0">
            {{-- Columna 1 - Formulario --}}
            <section class="dark:bg-gray-900">
                <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
                    {{-- Logo --}}
                    <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                        <img class="max-w-32" src="{{ asset('images/logo.png') }}" alt="logo">                        
                    </a>
                    <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                            <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                                Inicia sesión en tu cuenta
                            </h1>
                            <form method="POST" action="{{ route('login') }}" class="space-y-4 md:space-y-6" id="login-form">
                                @csrf
                                <div>
                                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                    <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="ejemplo@gmail.com" :value="old('email')" required autofocus autocomplete="username">
                                </div>
                                <div>
                                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contraseña</label>
                                    <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required autocomplete="current-password">
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-start">
                                        <div class="flex items-center h-5">
                                            <input id="remember_me" name="remember" aria-describedby="remember" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800">
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label for="remember_me" class="text-gray-500 dark:text-gray-300">Recordar mi sesión</label>
                                        </div>
                                    </div>
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">¿Olvidaste tu contraseña?</a>
                                    @endif
                                </div>
                                <x-validation-errors class="mb-4" />

                                {{-- <button type="submit" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Iniciar sesión</button> --}}
                                <button type="submit" id="submit-btn" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    <span id="btn-text">Iniciar sesión</span>
                                    <span id="btn-loader" class="hidden">
                                        <svg class="animate-spin -ml-1 mr-1 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                        Cargando...
                                    </span>
                                </button>
                                {{-- <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                                    ¿No estás registrado aún? <a href="{{ route('register') }}" class="font-medium text-blue-600 hover:underline dark:text-blue-500 underline">Crea tu cuenta aquí</a>
                                </p> --}}
                            </form>
                        </div>
                    </div>
                </div>
            </section>
            {{-- Columna 2 - Gráfico --}}
            <div class="hidden lg:block">
                <img src="{{ asset('images/login_illustration.svg') }}" alt="">
            </div>
        </div>
    </div>

    @push('js')
        <script>
            // Mensaje "cargando..." en el botón de inicio de sesión
            document.addEventListener('DOMContentLoaded', function() {
                const loginForm = document.getElementById('login-form');
                const btnText = document.getElementById('btn-text');
                const btnLoader = document.getElementById('btn-loader');
                const submitBtn = document.getElementById('submit-btn');
    
                loginForm.addEventListener('submit', function() {
                    btnText.classList.add('hidden');
                    btnLoader.classList.remove('hidden');
                    submitBtn.disabled = true;
                });
            });
        </script>
    @endpush
</x-guest-layout>
