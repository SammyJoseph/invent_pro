@extends('layouts.dashboard')

@section('title', 'Generar Ventas')

@push('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
    <!-- Main Content Wrapper -->
    <main class="main-content w-full px-[var(--margin-x)] pb-8">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-4 py-5 lg:py-6">
                <h2 class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl">
                    Ventas
                </h2>
                <div class="hidden h-full py-1 sm:flex">
                    <div class="h-full w-px bg-slate-300 dark:bg-navy-600"></div>
                </div>
                <ul class="hidden flex-wrap items-center space-x-2 sm:flex">
                    <li class="flex items-center space-x-2">
                        <a class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent"
                            href="{{ route('dashboard.index') }}">Dashboard</a>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </li>
                    <li>Generar Ventas</li>
                </ul>
            </div>
        </div>
        <section
            class=" relative z-10 after:contents-[''] after:absolute after:z-0 after:h-full xl:after:w-1/3 after:top-0 after:right-0 after:bg-gray-50">
            <div class="w-full max-w-7xl px-4 md:px-5 lg-6 relative z-10">
                <div class="grid grid-cols-12">
                    {{-- Columna 1 --}}
                    <div class="col-span-12 xl:col-span-8 lg:pr-8 pt-8 pb-8 w-full max-xl:max-w-3xl max-xl:mx-auto">
                        <div class="flex items-center justify-between pb-8 border-b border-gray-300">
                            <h2 class="font-manrope font-bold text-3xl leading-10 text-black">Resumen de venta</h2>
                            <h2 class="total_items font-manrope font-bold text-xl leading-8 text-gray-600">0 Items</h2>
                        </div>
                        <div class="grid grid-cols-12 mt-8 max-md:hidden pb-6 border-b border-gray-200">
                            <div class="col-span-12 md:col-span-7">
                                <p class="font-normal text-lg leading-8 text-gray-400">Detalles de Producto</p>
                            </div>
                            <div class="col-span-12 md:col-span-5">
                                <div class="grid grid-cols-5">
                                    <div class="col-span-3">
                                        <p class="font-normal text-lg leading-8 text-gray-400 text-center">Cantidad</p>
                                    </div>
                                    <div class="col-span-2">
                                        <p class="font-normal text-lg leading-8 text-gray-400 text-right">Monto</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="cart-items" class="space-y-4">
                            <!-- Productos del carrito -->
                        </div>
                    </div>
                    {{-- Colunmna 2 --}}
                    <div
                        class=" col-span-12 xl:col-span-4 bg-gray-50 w-full max-xl:px-6 max-w-3xl xl:max-w-lg mx-auto lg:pl-8 py-8">
                        <h2 class="font-manrope font-bold text-3xl leading-10 text-black pb-8 border-b border-gray-300">Leer
                            Producto</h2>
                        <div class="mt-8">
                            <div class="flex items-center justify-between pb-6">
                                <p class="total_items font-normal text-lg leading-8 text-black">0 Items</p>
                                <p class="total_amount font-medium text-lg leading-8 text-black">S/0.00</p>
                            </div>
                            <form>
                                <label class="flex items-center mb-1.5 text-gray-400 text-sm font-medium">Código de
                                    Barras</label>
                                <div class="flex pb-4 w-full">
                                    <div class="relative w-full ">
                                        <div class=" absolute left-0 top-0 py-2.5 px-4 text-gray-300"></div>
                                        <input type="text" id="barcode_search"
                                            class="block w-full h-11 pr-11 pl-5 py-2.5 text-base font-normal shadow-xs text-gray-900 bg-white border border-gray-300 rounded-lg placeholder-gray-500 focus:outline-gray-400"
                                            placeholder="123456789">
                                    </div>
                                </div>
                                <div class="flex items-center border-b border-gray-200">
                                    <button
                                        class="rounded-lg w-full bg-black py-2.5 px-4 text-white text-sm font-semibold text-center mb-8 transition-all duration-500 hover:bg-black/80">
                                        Buscar
                                        <svg class="w-5 inline-block -mt-0.5" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 -960 960 960" fill="#fff">
                                            <path
                                                d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z" />
                                        </svg>
                                    </button>
                                </div>
                                <div class="flex items-center justify-between py-8">
                                    <p class="total_items font-medium text-xl leading-8 text-black">0 Items</p>
                                    <p class="total_amount font-semibold text-xl leading-8 text-indigo-600">S/0.00</p>
                                </div>
                                <button id="register-sale"
                                    class="w-full text-center bg-indigo-600 rounded-xl py-3 px-6 font-semibold text-lg text-white transition-all duration-500 hover:bg-indigo-700">
                                    <span id="button-text">Registrar Venta</span>
                                    <span id="button-loader" class="hidden">
                                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                        Cargando...
                                    </span>
                                    <svg class="w-5 inline-block -mt-0.5" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 -960 960 960" fill="#fff">
                                        <path
                                            d="M444-200h70v-50q50-9 86-39t36-89q0-42-24-77t-96-61q-60-20-83-35t-23-41q0-26 18.5-41t53.5-15q32 0 50 15.5t26 38.5l64-26q-11-35-40.5-61T516-710v-50h-70v50q-50 11-78 44t-28 74q0 47 27.5 76t86.5 50q63 23 87.5 41t24.5 47q0 33-23.5 48.5T486-314q-33 0-58.5-20.5T390-396l-66 26q14 48 43.5 77.5T444-252v52Zm36 120q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Z" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <div id="animatedAlert"
        class="absolute bottom-0 opacity-0 pointer-events-none scale-90 transition-all duration-500 ease-in-out flex left-1/2 transform -translate-x-1/2 items-center p-4 mb-4 text-green-800 border-t-4 border-green-300 bg-green-50 dark:text-green-400 dark:bg-gray-800 dark:border-green-800"
        role="alert">
        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
            viewBox="0 0 20 20">
            <path
                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
        </svg>
        <div class="ms-3 text-sm font-medium">
            Venta registrada con éxito. <a href="#" class="font-semibold underline hover:no-underline">Ver todas</a>.
        </div>
    </div>
@endsection

@push('styles')
    <style>
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translate3d(0, -20px, 0);
            }

            to {
                opacity: 1;
                transform: translate3d(0, 0, 0);
            }
        }

        .fade-in-down {
            animation: fadeInDown 0.5s ease-out;
        }
    </style>
@endpush

@push('scripts')
    <script>
        window.productsData = @json($products);
        window.salesStoreUrl = "{{ route('dashboard.sales.store') }}";
    </script>
    <script src="{{ asset('js/sales-cart.js') }}"></script>
@endpush
