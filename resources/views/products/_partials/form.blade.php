@csrf
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
            <div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="text-red-500 text-xs">
                                    <svg class="w-3 inline-block" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor">
                                        <path d="M480-120q-33 0-56.5-23.5T400-200q0-33 23.5-56.5T480-280q33 0 56.5 23.5T560-200q0 33-23.5 56.5T480-120Zm-80-240v-480h160v480H400Z"/>
                                    </svg>
                                    {{ $error }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <label class="block">
                <span>Nombre</span>
                <input name="name"
                    class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                    placeholder="Escribe el nombre del producto" type="text" value="{{ old('name', $product->name ?? '') }}" />
            </label>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div class="grid grid-cols-2 gap-4"> 
                    <label class="block">
                        <span>Categoría</span>
                        <select id="category" class="mt-1.5 w-full" name="category">
                            <option value="">Seleccionar</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" 
                                    {{ (is_array(old('categories')) && in_array($category->id, old('categories'))) || 
                                    (isset($product) && $product->categories->contains($category->id)) ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </label>
                    <label class="block">
                        <span>Precio Compra</span>
                        <input name="purchase_price"
                            class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                            placeholder="0.00" type="number" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" value="{{ old('purchase_price', $product->purchase_price ?? '') }}" />
                    </label>
                </div>
                <div class="grid grid-cols-2 gap-4">                                
                    <label class="block">
                        <span>Precio Venta</span>
                        <input name="sale_price"
                            class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                            placeholder="0.00" type="number" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" value="{{ old('sale_price', $product->sale_price ?? '') }}" />
                    </label>
                    <label class="block">
                        <span>Stock</span>
                        <input name="stock"
                            class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                            placeholder="100" type="text" value="{{ old('stock', $product->stock ?? '') }}" />
                    </label>
                </div>
            </div>
            <div>
                <span>Imagen</span>
                @if(isset($product) && $product->image)
                    <div class="mt-2 mb-5">
                        <img src="{{ Storage::url($product->image->url) }}" alt="Imagen actual" class="max-w-xs h-auto">
                        <p class="text-xs italic text-gray-500 mt-1">Imagen actual. Sube una nueva para reemplazarla.</p>
                    </div>
                @endif
                <div class="filepond fp-bordered fp-grid mt-1.5 [--fp-grid:2]">
                    <input name="image" type="file" id="images" accept="image/*" />
                    <input type="hidden" name="image_info" id="image_info">
                </div>
            </div>
            <div class="pt-4">
                <button
                    class="btn space-x-2 bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                    <span>{{ $submitButtonText }}</span>
                    <svg class="w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="#ffffff"><path d="M840-680v480q0 33-23.5 56.5T760-120H200q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h480l160 160ZM480-240q50 0 85-35t35-85q0-50-35-85t-85-35q-50 0-85 35t-35 85q0 50 35 85t85 35ZM240-560h360v-160H240v160Z"/></svg>
                </button>
            </div>
        </div>
    </div>
</div>