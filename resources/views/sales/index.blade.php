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
                        <a class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent" href="{{ route('dashboard.index') }}">Dashboard</a>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </li>
                    <li>Generar Ventas</li>
                </ul>
            </div>
        </div>
        <section class=" relative z-10 after:contents-[''] after:absolute after:z-0 after:h-full xl:after:w-1/3 after:top-0 after:right-0 after:bg-gray-50">
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
                    <div class=" col-span-12 xl:col-span-4 bg-gray-50 w-full max-xl:px-6 max-w-3xl xl:max-w-lg mx-auto lg:pl-8 py-8">
                        <h2 class="font-manrope font-bold text-3xl leading-10 text-black pb-8 border-b border-gray-300">Leer Producto</h2>
                        <div class="mt-8">
                            <div class="flex items-center justify-between pb-6">
                                <p class="total_items font-normal text-lg leading-8 text-black">0 Items</p>
                                <p class="total_amount font-medium text-lg leading-8 text-black">S/0.00</p>
                            </div>
                            <form>
                                <label class="flex items-center mb-1.5 text-gray-400 text-sm font-medium">Código de Barras</label>
                                <div class="flex pb-4 w-full">
                                    <div class="relative w-full ">
                                        <div class=" absolute left-0 top-0 py-2.5 px-4 text-gray-300"></div>
                                        <input type="text" id="barcode_search"
                                            class="block w-full h-11 pr-11 pl-5 py-2.5 text-base font-normal shadow-xs text-gray-900 bg-white border border-gray-300 rounded-lg placeholder-gray-500 focus:outline-gray-400"
                                            placeholder="123456789">
                                    </div>
                                </div>
                                <div class="flex items-center border-b border-gray-200">
                                    <button class="rounded-lg w-full bg-black py-2.5 px-4 text-white text-sm font-semibold text-center mb-8 transition-all duration-500 hover:bg-black/80">
                                        Buscar
                                        <svg class="w-5 inline-block -mt-0.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="#fff">
                                            <path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z"/>
                                        </svg>
                                    </button>
                                </div>
                                <div class="flex items-center justify-between py-8">
                                    <p class="total_items font-medium text-xl leading-8 text-black">0 Items</p>
                                    <p class="total_amount font-semibold text-xl leading-8 text-indigo-600">S/0.00</p>
                                </div>
                                <button id="register-sale" class="w-full text-center bg-indigo-600 rounded-xl py-3 px-6 font-semibold text-lg text-white transition-all duration-500 hover:bg-indigo-700">
                                    Registrar Venta
                                    <svg class="w-5 inline-block -mt-0.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="#fff">
                                        <path d="M444-200h70v-50q50-9 86-39t36-89q0-42-24-77t-96-61q-60-20-83-35t-23-41q0-26 18.5-41t53.5-15q32 0 50 15.5t26 38.5l64-26q-11-35-40.5-61T516-710v-50h-70v50q-50 11-78 44t-28 74q0 47 27.5 76t86.5 50q63 23 87.5 41t24.5 47q0 33-23.5 48.5T486-314q-33 0-58.5-20.5T390-396l-66 26q14 48 43.5 77.5T444-252v52Zm36 120q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Z"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>    
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
        const products = @json($products);
        let cart = [];

        document.getElementById('barcode_search').addEventListener('input', function() {
            const barcode = this.value.replace(/\s+/g, '');
            if (barcode.length > 0) {
                const product = products.find(p => p.barcode === barcode);
                if (product) {
                    addToCart(product);
                    this.value = '';
                }
            }
        });

        function addToCart(product) {
            const existingItem = cart.find(item => item.id === product.id);
            if (existingItem) {
                existingItem.quantity++;
            } else {
                cart.unshift({...product, quantity: 1});
            }
            updateCartDisplay();
        
            const firstCartItem = document.querySelector('#cart-items > div:first-child');
            if (firstCartItem) {
                firstCartItem.classList.add('fade-in-down');
                setTimeout(() => {
                    firstCartItem.classList.remove('fade-in-down');
                }, 500);
            }
        }

        function updateCartDisplay() {
            const cartContainer = document.getElementById('cart-items');
            cartContainer.innerHTML = '';

            cart.forEach(item => {
                const itemElement = document.createElement('div');
                itemElement.className = 'flex flex-col min-[500px]:flex-row min-[500px]:items-center gap-5 py-6 border-b border-gray-200 group';
                itemElement.innerHTML = `
                    <div class="w-full md:max-w-[126px]">
                        <img src="${item.image_url || 'https://via.placeholder.com/126'}" alt="${item.name}" class="mx-auto rounded-xl object-cover">
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-4 w-full">
                        <div class="md:col-span-2">
                            <div class="flex flex-col max-[500px]:items-center gap-3">
                                <h6 class="font-semibold text-base leading-7 text-black">${item.name}</h6>
                                <h6 class="font-normal text-base leading-7 text-gray-500">${item.categories.map(cat => cat.name).join(', ')}</h6>
                                <h6 class="font-medium text-base leading-7 text-gray-600 transition-all duration-300 group-hover:text-indigo-600">S/.${(Number(item.sale_price) || 0).toFixed(2)}</h6>
                            </div>
                        </div>
                        <div class="flex items-center max-[500px]:justify-center h-full max-md:mt-3">
                            <div class="flex items-center h-full">
                                <button onclick="updateQuantity(${item.id}, -1)" class="group rounded-l-xl px-5 py-[18px] border border-gray-200 flex items-center justify-center shadow-sm shadow-transparent transition-all duration-500 hover:bg-gray-50 hover:border-gray-300 hover:shadow-gray-300 focus-within:outline-gray-300">
                                    <svg class="stroke-gray-900 transition-all duration-500 group-hover:stroke-black" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                                        <path d="M16.5 11H5.5" stroke="" stroke-width="1.6" stroke-linecap="round" />
                                    </svg>
                                </button>
                                <input type="text" value="${item.quantity}" class="border-y border-gray-200 outline-none text-gray-900 font-semibold text-lg w-full max-w-[73px] min-w-[60px] placeholder:text-gray-900 py-[15px] text-center bg-transparent">
                                <button onclick="updateQuantity(${item.id}, 1)" class="group rounded-r-xl px-5 py-[18px] border border-gray-200 flex items-center justify-center shadow-sm shadow-transparent transition-all duration-500 hover:bg-gray-50 hover:border-gray-300 hover:shadow-gray-300 focus-within:outline-gray-300 z-10">
                                    <svg class="stroke-gray-900 transition-all duration-500 group-hover:stroke-black" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                                        <path d="M11 5.5V16.5M16.5 11H5.5" stroke="" stroke-width="1.6" stroke-linecap="round" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="flex items-center max-[500px]:justify-center md:justify-end max-md:mt-3 h-full">
                            <p class="font-bold text-lg leading-8 text-gray-600 text-center transition-all duration-300 group-hover:text-indigo-600">S/.${Number((item.sale_price * item.quantity) || 0).toFixed(2)}</p>
                        </div>
                    </div>
                `;
                cartContainer.appendChild(itemElement);
            });

            updateTotalItems();
            updateTotalAmount();
        }

        function updateQuantity(productId, change) {
            const item = cart.find(item => item.id === productId);
            if (item) {
                item.quantity += change;
                if (item.quantity <= 0) {
                    cart = cart.filter(i => i.id !== productId);
                }
                updateCartDisplay();
            }
        }

        function updateTotalItems() {
            const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
            const totalItemsElements = document.getElementsByClassName('total_items');
            Array.from(totalItemsElements).forEach(element => {
                element.textContent = `${totalItems} Items`;
            });
        }

        function updateTotalAmount() {
            const totalAmount = cart.reduce((sum, item) => sum + (item.sale_price * item.quantity), 0);
            const totalAmountElements = document.getElementsByClassName('total_amount');
            Array.from(totalAmountElements).forEach(element => {
                element.textContent = `S/.${totalAmount.toFixed(2)}`;
            });
        }

        document.getElementById('register-sale').addEventListener('click', function(e) {
            e.preventDefault();
            
            if (cart.length === 0) {
                alert('El carrito está vacío. Agregue productos antes de registrar la venta.');
                return;
            }

            const saleData = {
                products: cart.map(item => ({
                    id: item.id,
                    quantity: item.quantity,
                    price: item.sale_price
                })),
                total_amount: calculateTotalAmount()
            };
            
            fetch('{{ route("dashboard.sales.store") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(saleData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    cart = [];
                    updateCartDisplay();
                } else {
                    console.error('Error al procesar la venta:', data.message || 'No se proporcionaron detalles');
                }
            })
            .catch(error => {
                console.error('Error en la solicitud:', error);
            });
        });

        function calculateTotalAmount() {
            return cart.reduce((total, item) => total + (item.sale_price * item.quantity), 0);
        }
    </script>
@endpush