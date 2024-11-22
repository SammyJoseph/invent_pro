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
                class="bg-white form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                placeholder="Choose date..." type="text" />
            <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-5 transition-colors duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </span>
        </label>
    </div>
    <div class="grid grid-cols-1 gap-4 px-[var(--margin-x)] sm:grid-cols-3 sm:gap-5 lg:gap-6 mt-4">
        {{-- Categoría A --}}
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
                            <th class="px-3 py-2 font-semibold text-slate-800 dark:text-navy-100">Unidades Vendidas</th>
                            <th class="px-3 py-2 font-semibold text-slate-800 dark:text-navy-100">Ganancia Total</th>
                            <th class="px-3 py-2 font-semibold text-slate-800 dark:text-navy-100">Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categoryA->take(10) as $product)
                            <tr class="border-b border-slate-100 dark:border-navy-500">
                                <td class="px-3 py-2"><img class="rounded-full w-10 h-10 object-cover" src="{{ $product->image->url === 'products/' ? asset('images/no-image.png') : Storage::url($product->image->url) }}" alt=""></td>
                                <td class="px-3 py-2 font-medium"><a class="hover:underline" href="{{ route('dashboard.products.edit', $product) }}">{{ $product->name }}</a></td>
                                <td class="px-3 py-2 relative" x-data="{ showTooltip: false }">
                                    <span @mouseenter="showTooltip = true" @mouseleave="showTooltip = false">
                                        {{ $product->total_sold }}
                                    </span>
                                    <div x-show="showTooltip" 
                                         class="absolute z-10 p-2 bg-white border rounded shadow-lg left-0 mt-1 overflow-y-auto text-sm"
                                         style="display: none; min-width: max-content; max-width: 90vw;">
                                        @php
                                            $saleDates = explode(',', $product->sale_dates);
                                        @endphp
                                        @foreach($saleDates as $date)
                                            <div class="whitespace-nowrap py-1">
                                                <svg class="w-4 inline-block -mt-0.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M200-80q-33 0-56.5-23.5T120-160v-560q0-33 23.5-56.5T200-800h40v-80h80v80h320v-80h80v80h40q33 0 56.5 23.5T840-720v560q0 33-23.5 56.5T760-80H200Zm0-80h560v-400H200v400Zm0-480h560v-80H200v80Zm0 0v-80 80Zm280 240q-17 0-28.5-11.5T440-440q0-17 11.5-28.5T480-480q17 0 28.5 11.5T520-440q0 17-11.5 28.5T480-400Zm-160 0q-17 0-28.5-11.5T280-440q0-17 11.5-28.5T320-480q17 0 28.5 11.5T360-440q0 17-11.5 28.5T320-400Zm320 0q-17 0-28.5-11.5T600-440q0-17 11.5-28.5T640-480q17 0 28.5 11.5T680-440q0 17-11.5 28.5T640-400ZM480-240q-17 0-28.5-11.5T440-280q0-17 11.5-28.5T480-320q17 0 28.5 11.5T520-280q0 17-11.5 28.5T480-240Zm-160 0q-17 0-28.5-11.5T280-280q0-17 11.5-28.5T320-320q17 0 28.5 11.5T360-280q0 17-11.5 28.5T320-240Zm320 0q-17 0-28.5-11.5T600-280q0-17 11.5-28.5T640-320q17 0 28.5 11.5T680-280q0 17-11.5 28.5T640-240Z"/></svg>
                                                {{ \Carbon\Carbon::parse(trim($date))->format('d-m-Y') }}
                                                <span class="text-gray-400">
                                                    <svg class="w-4 inline-block -mt-0.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m612-292 56-56-148-148v-184h-80v216l172 172ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-400Zm0 320q133 0 226.5-93.5T800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 133 93.5 226.5T480-160Z"/></svg>
                                                    {{ \Carbon\Carbon::parse(trim($date))->format('H:i:s') }}
                                                </span>
                                            </div>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="px-3 py-2">{{ number_format($product->total_profit, 2) }}</td>
                                <td class="px-3 py-2">{{ $product->stock }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Categoría B --}}
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
                            <th class="px-3 py-2 font-semibold text-slate-800 dark:text-navy-100">Unidades Vendidas</th>
                            <th class="px-3 py-2 font-semibold text-slate-800 dark:text-navy-100">Ganancia Total</th>
                            <th class="px-3 py-2 font-semibold text-slate-800 dark:text-navy-100">Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categoryB->take(10) as $product)
                            <tr class="border-b border-slate-100 dark:border-navy-500">
                                <td class="px-3 py-2"><img class="rounded-full w-10 h-10 object-cover" src="{{ $product->image->url === 'products/' ? asset('images/no-image.png') : Storage::url($product->image->url) }}" alt=""></td>
                                <td class="px-3 py-2 font-medium"><a class="hover:underline" href="{{ route('dashboard.products.edit', $product) }}">{{ $product->name }}</a></td>
                                <td class="px-3 py-2 relative" x-data="{ showTooltip: false }">
                                    <span @mouseenter="showTooltip = true" @mouseleave="showTooltip = false">
                                        {{ $product->total_sold }}
                                    </span>
                                    <div x-show="showTooltip" 
                                         class="absolute z-10 p-2 bg-white border rounded shadow-lg left-0 mt-1 overflow-y-auto text-sm"
                                         style="display: none; min-width: max-content; max-width: 90vw;">
                                        @php
                                            $saleDates = explode(',', $product->sale_dates);
                                        @endphp
                                        @foreach($saleDates as $date)
                                            <div class="whitespace-nowrap py-1">
                                                <svg class="w-4 inline-block -mt-0.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M200-80q-33 0-56.5-23.5T120-160v-560q0-33 23.5-56.5T200-800h40v-80h80v80h320v-80h80v80h40q33 0 56.5 23.5T840-720v560q0 33-23.5 56.5T760-80H200Zm0-80h560v-400H200v400Zm0-480h560v-80H200v80Zm0 0v-80 80Zm280 240q-17 0-28.5-11.5T440-440q0-17 11.5-28.5T480-480q17 0 28.5 11.5T520-440q0 17-11.5 28.5T480-400Zm-160 0q-17 0-28.5-11.5T280-440q0-17 11.5-28.5T320-480q17 0 28.5 11.5T360-440q0 17-11.5 28.5T320-400Zm320 0q-17 0-28.5-11.5T600-440q0-17 11.5-28.5T640-480q17 0 28.5 11.5T680-440q0 17-11.5 28.5T640-400ZM480-240q-17 0-28.5-11.5T440-280q0-17 11.5-28.5T480-320q17 0 28.5 11.5T520-280q0 17-11.5 28.5T480-240Zm-160 0q-17 0-28.5-11.5T280-280q0-17 11.5-28.5T320-320q17 0 28.5 11.5T360-280q0 17-11.5 28.5T320-240Zm320 0q-17 0-28.5-11.5T600-280q0-17 11.5-28.5T640-320q17 0 28.5 11.5T680-280q0 17-11.5 28.5T640-240Z"/></svg>
                                                {{ \Carbon\Carbon::parse(trim($date))->format('d-m-Y') }}
                                                <span class="text-gray-400">
                                                    <svg class="w-4 inline-block -mt-0.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m612-292 56-56-148-148v-184h-80v216l172 172ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-400Zm0 320q133 0 226.5-93.5T800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 133 93.5 226.5T480-160Z"/></svg>
                                                    {{ \Carbon\Carbon::parse(trim($date))->format('H:i:s') }}
                                                </span>
                                            </div>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="px-3 py-2">{{ number_format($product->total_profit, 2) }}</td>
                                <td class="px-3 py-2">{{ $product->stock }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Categoría C --}}
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
                            <th class="px-3 py-2 font-semibold text-slate-800 dark:text-navy-100">Unidades Vendidas</th>
                            <th class="px-3 py-2 font-semibold text-slate-800 dark:text-navy-100">Ganancia Total</th>
                            <th class="px-3 py-2 font-semibold text-slate-800 dark:text-navy-100">Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categoryC->take(10) as $product)
                            <tr class="border-b border-slate-100 dark:border-navy-500">
                                <td class="px-3 py-2"><img class="rounded-full w-10 h-10 object-cover" src="{{ $product->image->url === 'products/' ? asset('images/no-image.png') : Storage::url($product->image->url) }}" alt=""></td>
                                <td class="px-3 py-2 font-medium"><a class="hover:underline" href="{{ route('dashboard.products.edit', $product) }}">{{ $product->name }}</a></td>
                                <td class="px-3 py-2 relative" x-data="{ showTooltip: false }">
                                    <span @mouseenter="showTooltip = true" @mouseleave="showTooltip = false">
                                        {{ $product->total_sold }}
                                    </span>
                                    <div x-show="showTooltip" 
                                         class="absolute z-10 p-2 bg-white border rounded shadow-lg left-0 mt-1 overflow-y-auto text-sm"
                                         style="display: none; min-width: max-content; max-width: 90vw;">
                                        @php
                                            $saleDates = explode(',', $product->sale_dates);
                                        @endphp
                                        @foreach($saleDates as $date)
                                            <div class="whitespace-nowrap py-1">
                                                <svg class="w-4 inline-block -mt-0.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M200-80q-33 0-56.5-23.5T120-160v-560q0-33 23.5-56.5T200-800h40v-80h80v80h320v-80h80v80h40q33 0 56.5 23.5T840-720v560q0 33-23.5 56.5T760-80H200Zm0-80h560v-400H200v400Zm0-480h560v-80H200v80Zm0 0v-80 80Zm280 240q-17 0-28.5-11.5T440-440q0-17 11.5-28.5T480-480q17 0 28.5 11.5T520-440q0 17-11.5 28.5T480-400Zm-160 0q-17 0-28.5-11.5T280-440q0-17 11.5-28.5T320-480q17 0 28.5 11.5T360-440q0 17-11.5 28.5T320-400Zm320 0q-17 0-28.5-11.5T600-440q0-17 11.5-28.5T640-480q17 0 28.5 11.5T680-440q0 17-11.5 28.5T640-400ZM480-240q-17 0-28.5-11.5T440-280q0-17 11.5-28.5T480-320q17 0 28.5 11.5T520-280q0 17-11.5 28.5T480-240Zm-160 0q-17 0-28.5-11.5T280-280q0-17 11.5-28.5T320-320q17 0 28.5 11.5T360-280q0 17-11.5 28.5T320-240Zm320 0q-17 0-28.5-11.5T600-280q0-17 11.5-28.5T640-320q17 0 28.5 11.5T680-280q0 17-11.5 28.5T640-240Z"/></svg>
                                                {{ \Carbon\Carbon::parse(trim($date))->format('d-m-Y') }}
                                                <span class="text-gray-400">
                                                    <svg class="w-4 inline-block -mt-0.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m612-292 56-56-148-148v-184h-80v216l172 172ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-400Zm0 320q133 0 226.5-93.5T800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 133 93.5 226.5T480-160Z"/></svg>
                                                    {{ \Carbon\Carbon::parse(trim($date))->format('H:i:s') }}
                                                </span>
                                            </div>
                                        @endforeach
                                    </div>
                                </td>
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
