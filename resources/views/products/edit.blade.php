@extends('layouts.dashboard')

@section('title', 'Editar Producto')

@push('head')
        <script src="{{ asset('dashboard_ui/js/libs/forms.js') }}" defer></script>
        <script src="{{ asset('dashboard_ui/js/pages/forms-layout-2.js') }}" defer></script>
@endpush

@section('content')
    <main class="main-content w-full px-[var(--margin-x)] pb-8">
        <div class="flex items-center space-x-4 py-5 lg:py-6">
            <h2 class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl">
                Producto
            </h2>
            <div class="hidden h-full py-1 sm:flex">
                <div class="h-full w-px bg-slate-300 dark:bg-navy-600"></div>
            </div>
            <ul class="hidden flex-wrap items-center space-x-2 sm:flex">
                <li class="flex items-center space-x-2">
                    <a class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent" href="{{ route('dashboard.products.index') }}">Lista de Productos</a>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </li>
                <li>Editar Producto <span class="italic">{{ $product->name }}</span></li>
            </ul>
        </div>

        <form class="grid grid-cols-12 gap-4 sm:gap-5 lg:gap-6" method="POST" action="{{ route('dashboard.products.update', $product) }}" enctype="multipart/form-data">
            @method('PUT')
            @include('products._partials.form', ['submitButtonText' => 'Actualizar'])
        </form>
    </main>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            FilePond.setOptions({
                server: {
                    url: '{{ route('dashboard.products.upload') }}',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    process: {
                        onload: (response) => {
                            const imageInfo = JSON.parse(response);
                            document.getElementById('image_info').value = JSON.stringify(imageInfo);
                            return imageInfo.folder;
                        }
                    }
                },
            });
        });
    </script>
@endpush