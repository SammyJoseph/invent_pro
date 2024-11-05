<div class="mt-16">
    <div class="grid grid-cols-1 gap-4 px-[var(--margin-x)] sm:grid-cols-3 sm:gap-5 lg:gap-6 mt-4">
        <label class="relative flex">
            <input x-data x-init="flatpickr($el, {
                mode: 'range',
                dateFormat: 'd-m-Y',
                defaultDate: ['{{ $startDate }}', '{{ $endDate }}'],
                onChange: function(selectedDates, dateStr, instance) {
                    if (selectedDates.length === 2) {
                        @this.set('dateRange', dateStr);
                    }
                }
            })" wire:model="dateRange"
                class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                placeholder="Choose date..." type="text" />
            <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-5 transition-colors duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </span>
        </label>
    </div>
    <div class="grid grid-cols-1 gap-4 px-[var(--margin-x)] sm:grid-cols-3 sm:gap-5 lg:gap-6 mt-4">
        <div class="card p-4">
            <h4 class="mb-4 text-lg font-medium text-green-600 dark:text-navy-100">
                Categoría A
            </h4>
            <div class="min-w-full overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b border-slate-200 dark:border-navy-500">
                            <th class="px-3 py-2 font-semibold text-slate-800 dark:text-navy-100">Imagen</th>
                            <th class="px-3 py-2 font-semibold text-slate-800 dark:text-navy-100">Producto</th>
                            <th class="px-3 py-2 font-semibold text-slate-800 dark:text-navy-100">Unid. Vendidas</th>
                            <th class="px-3 py-2 font-semibold text-slate-800 dark:text-navy-100">Ganancia Total</th>
                            <th class="px-3 py-2 font-semibold text-slate-800 dark:text-navy-100">Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categoryA->take(10) as $product)
                            <tr class="border-b border-slate-100 dark:border-navy-500">
                                <td class="px-3 py-2"><img class="rounded-full w-10 h-10" src="{{ $product->image->url === 'products/' ? asset('images/no-image.png') : Storage::url($product->image->url) }}" alt=""></td>
                                <td class="px-3 py-2 font-medium"><a class="hover:underline" href="{{ route('dashboard.products.edit', $product) }}">{{ $product->name }}</a></td>
                                <td class="px-3 py-2">{{ $product->total_sold }}</td>
                                <td class="px-3 py-2">{{ number_format($product->total_profit, 2) }}</td>
                                <td class="px-3 py-2">{{ $product->stock }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card p-4">
            <h4 class="mb-4 text-lg font-medium text-orange-500 dark:text-navy-100">
                Categoría B
            </h4>
            <div class="min-w-full overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b border-slate-200 dark:border-navy-500">
                            <th class="px-3 py-2 font-semibold text-slate-800 dark:text-navy-100">Imagen</th>
                            <th class="px-3 py-2 font-semibold text-slate-800 dark:text-navy-100">Producto</th>
                            <th class="px-3 py-2 font-semibold text-slate-800 dark:text-navy-100">Unid. Vendidas</th>
                            <th class="px-3 py-2 font-semibold text-slate-800 dark:text-navy-100">Ganancia Total</th>
                            <th class="px-3 py-2 font-semibold text-slate-800 dark:text-navy-100">Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categoryB->take(10) as $product)
                            <tr class="border-b border-slate-100 dark:border-navy-500">
                                <td class="px-3 py-2"><img class="rounded-full w-10 h-10" src="{{ $product->image->url === 'products/' ? asset('images/no-image.png') : Storage::url($product->image->url) }}" alt=""></td>
                                <td class="px-3 py-2 font-medium"><a class="hover:underline" href="{{ route('dashboard.products.edit', $product) }}">{{ $product->name }}</a></td>
                                <td class="px-3 py-2">{{ $product->total_sold }}</td>
                                <td class="px-3 py-2">{{ number_format($product->total_profit, 2) }}</td>
                                <td class="px-3 py-2">{{ $product->stock }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card p-4">
            <h4 class="mb-4 text-lg font-medium text-red-600 dark:text-navy-100">
                Categoría C
            </h4>
            <div class="min-w-full overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b border-slate-200 dark:border-navy-500">
                            <th class="px-3 py-2 font-semibold text-slate-800 dark:text-navy-100">Imagen</th>
                            <th class="px-3 py-2 font-semibold text-slate-800 dark:text-navy-100">Producto</th>
                            <th class="px-3 py-2 font-semibold text-slate-800 dark:text-navy-100">Unid. Vendidas</th>
                            <th class="px-3 py-2 font-semibold text-slate-800 dark:text-navy-100">Ganancia Total</th>
                            <th class="px-3 py-2 font-semibold text-slate-800 dark:text-navy-100">Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categoryC->take(10) as $product)
                            <tr class="border-b border-slate-100 dark:border-navy-500">
                                <td class="px-3 py-2"><img class="rounded-full w-10 h-10" src="{{ $product->image->url === 'products/' ? asset('images/no-image.png') : Storage::url($product->image->url) }}" alt=""></td>
                                <td class="px-3 py-2 font-medium"><a class="hover:underline" href="{{ route('dashboard.products.edit', $product) }}">{{ $product->name }}</a></td>
                                <td class="px-3 py-2">{{ $product->total_sold }}</td>
                                <td class="px-3 py-2">{{ number_format($product->total_profit, 2) }}</td>
                                <td class="px-3 py-2">{{ $product->stock }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
