@extends('layouts.dashboard')

@section('title', 'Crear Producto')

@push('head')
        <script src="{{ asset('dashboard_ui/js/libs/forms.js') }}" defer></script>
        <script src="{{ asset('dashboard_ui/js/pages/forms-layout-2.js') }}" defer></script>
@endpush

@section('content')
    <main class="main-content w-full px-[var(--margin-x)] pb-8">
        <div class="flex items-center space-x-4 py-5 lg:py-6">
            <h2 class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl">
                Crear Producto
            </h2>
            <div class="hidden h-full py-1 sm:flex">
                <div class="h-full w-px bg-slate-300 dark:bg-navy-600"></div>
            </div>
            <ul class="hidden flex-wrap items-center space-x-2 sm:flex">
                <li class="flex items-center space-x-2">
                    <a class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent" href="#">Forms</a>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </li>
                <li>Form Layout 2</li>
            </ul>
        </div>

        <form class="grid grid-cols-12 gap-4 sm:gap-5 lg:gap-6" method="POST" action="{{ route('dashboard.products.store') }}" enctype="multipart/form-data">
            @csrf
            {{-- <div class="col-span-12 grid lg:col-span-4 lg:place-items-center">
                <div>
                    <ol class="steps is-vertical line-space [--size:2.75rem] [--line:.5rem]">
                        <li class="step space-x-4 pb-12 before:bg-slate-200 dark:before:bg-navy-500">
                            <div class="step-header mask is-hexagon bg-primary text-white dark:bg-accent">
                                <i class="fa-solid fa-layer-group text-base"></i>
                            </div>
                            <div class="text-left">
                                <p class="text-xs text-slate-400 dark:text-navy-300">
                                    Step 1
                                </p>
                                <h3 class="text-base font-medium text-primary dark:text-accent-light">
                                    General
                                </h3>
                            </div>
                        </li>
                        <li class="step space-x-4 pb-12 before:bg-slate-200 dark:before:bg-navy-500">
                            <div class="step-header mask is-hexagon bg-slate-200 text-slate-500 dark:bg-navy-500 dark:text-navy-100">
                                <i class="fa-solid fa-list text-base"></i>
                            </div>
                            <div class="text-left">
                                <p class="text-xs text-slate-400 dark:text-navy-300">
                                    Step 2
                                </p>
                                <h3 class="text-base font-medium">Description</h3>
                            </div>
                        </li>
                        <li class="step space-x-4 pb-12 before:bg-slate-200 dark:before:bg-navy-500">
                            <div class="step-header mask is-hexagon bg-slate-200 text-slate-500 dark:bg-navy-500 dark:text-navy-100">
                                <i class="fa-solid fa-truck-fast text-base"></i>
                            </div>
                            <div class="text-left">
                                <p class="text-xs text-slate-400 dark:text-navy-300">
                                    Step 3
                                </p>
                                <h3 class="text-base font-medium">Shipping</h3>
                            </div>
                        </li>
                        <li class="step space-x-4 before:bg-slate-200 dark:before:bg-navy-500">
                            <div class="step-header mask is-hexagon bg-slate-200 text-slate-500 dark:bg-navy-500 dark:text-navy-100">
                                <i class="fa-solid fa-check text-base"></i>
                            </div>
                            <div class="text-left">
                                <p class="text-xs text-slate-400 dark:text-navy-300">
                                    Step 4
                                </p>
                                <h3 class="text-base font-medium">Confirm</h3>
                            </div>
                        </li>
                    </ol>
                </div>
            </div> --}}
            <div class="col-span-12 grid lg:col-span-8">
                <div class="card">
                    <div class="border-b border-slate-200 p-4 dark:border-navy-500 sm:px-5">
                        <div class="flex items-center space-x-2">
                            <div class="flex h-7 w-7 items-center justify-center rounded-lg bg-primary/10 p-1 text-primary dark:bg-accent-light/10 dark:text-accent-light">
                                <i class="fa-solid fa-layer-group"></i>
                            </div>
                            <h4 class="text-lg font-medium text-slate-700 dark:text-navy-100">
                                General
                            </h4>
                        </div>
                    </div>
                    <div class="space-y-4 p-4 sm:p-5">
                        <label class="block">
                            <span>Nombre</span>

                            <input name="name"
                                class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                placeholder="Escribe el nombre del producto" type="text" />
                        </label>
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <label class="block">
                                <span>Categoría</span>
                                <select id="category" class="mt-1.5 w-full" name="category">
                                    <option value="">Seleccionar</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </label>

                            <div class="grid grid-cols-2 gap-4">                                
                                <label class="block">
                                    <span>Precio</span>
                                    <input name="price"
                                        class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                        placeholder="0.00" type="number" />
                                </label>

                                <label class="block">
                                    <span>Stock</span>
                                    <input name="stock"
                                        class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                        placeholder="100" type="text" />
                                </label>
                            </div>
                        </div>
                        <div>
                            <span>Imagen</span>
                            <div class="filepond fp-bordered fp-grid mt-1.5 [--fp-grid:2]">
                                {{-- <input type="file" id="images" multiple /> --}}
                                <input name="image" type="file" id="images" accept="image/*" />
                            </div>
                        </div>
                        <div class="pt-4">
                            <button
                                class="btn space-x-2 bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                <span>Guardar</span>
                                <svg class="w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="#ffffff"><path d="M840-680v480q0 33-23.5 56.5T760-120H200q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h480l160 160ZM480-240q50 0 85-35t35-85q0-50-35-85t-85-35q-50 0-85 35t-35 85q0 50 35 85t85 35ZM240-560h360v-160H240v160Z"/></svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </main>
@endsection

@push('scripts')
@endpush