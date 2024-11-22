<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with(['image', 'categories'])->get()->map(function ($product) {
            $product->image_url = $product->image ? Storage::url($product->image->url) : null;
            $product->category_names = $product->categories->pluck('name')->implode(', ');
            return $product;
        });
    
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'net_content' => 'required|numeric|min:0',
            'unit_of_measure' => 'required|string|max:255',
            'category' => 'required|exists:categories,id',
            'purchase_price' => 'required|numeric|min:0',
            'sale_price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'barcode' => 'required|string|unique:products',
            'image_info' => 'required|json'
        ]);
    
        $imageInfo = json_decode($request->image_info, true);
    
        $product = Product::create([
            'name' => $request->name,
            'net_content' => $request->net_content,
            'unit_of_measure' => $request->unit_of_measure,
            'purchase_price' => $request->purchase_price,
            'sale_price' => $request->sale_price,
            'stock' => $request->stock,
            'barcode' => $request->barcode,
        ]);
    
        $product->categories()->attach($request->category);
    
        if ($imageInfo) {
            $tmpPath = $imageInfo['path'];
            $fileName = pathinfo($imageInfo['fileName'], PATHINFO_FILENAME);
            $extension = pathinfo($imageInfo['fileName'], PATHINFO_EXTENSION);
            $newFileName = md5($fileName . time()) . '.' . $extension;
            $newPath = 'products/' . $newFileName;
    
            Storage::move($tmpPath, $newPath);
    
            // Crear la entrada de imagen en la base de datos
            $product->image()->create([
                'url' => $newPath
            ]);
    
            Storage::deleteDirectory(dirname($tmpPath));
        }
    
        return redirect()->route('dashboard.products.index')->with('success', 'Producto creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();

        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'net_content' => 'required|numeric|min:0',
            'unit_of_measure' => 'required|string|max:255',
            'category' => 'required|exists:categories,id',
            'purchase_price' => 'required|numeric|min:0',
            'sale_price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'barcode' => 'required|string|unique:products,barcode,' . $product->id,
            'image_info' => 'nullable|json'
        ]);
    
        $product->update([
            'name' => $request->name,
            'net_content' => $request->net_content,
            'unit_of_measure' => $request->unit_of_measure,
            'purchase_price' => $request->purchase_price,
            'sale_price' => $request->sale_price,
            'stock' => $request->stock,
            'barcode' => $request->barcode,
        ]);
    
        $product->categories()->sync([$request->category]);
    
        if ($request->filled('image_info')) {
            $imageInfo = json_decode($request->image_info, true);
    
            if ($product->image) {
                Storage::delete($product->image->url);
                $product->image->delete();
            }
    
            $tmpPath = $imageInfo['path'];
            $fileName = pathinfo($imageInfo['fileName'], PATHINFO_FILENAME);
            $extension = pathinfo($imageInfo['fileName'], PATHINFO_EXTENSION);
            $newFileName = md5($fileName . time()) . '.' . $extension;
            $newPath = 'products/' . $newFileName;
    
            Storage::move($tmpPath, $newPath);
    
            $product->image()->create([
                'url' => $newPath
            ]);
    
            Storage::deleteDirectory(dirname($tmpPath));
        }
    
        return redirect()->route('dashboard.products.edit', $product)->with('success', 'Producto actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
    
        if ($product->image) {
            Storage::delete($product->image->url);
        }

        $product->delete();
        return redirect()->route('dashboard.products.index')->with('success', 'Producto eliminado');
    }

    /* Upload files */
    public function upload(Request $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            $folder = uniqid() . '-' . now()->timestamp;
            $path = $file->storeAs('products/tmp/' . $folder, $fileName);
    
            return [
                'folder' => $folder,
                'fileName' => $fileName,
                'path' => $path
            ];
        }
    
        return '';
    }
}
