<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,JPG|max:2048',
        ]);

        $imageUrl = $request->hasFile('image')
            ? Cloudinary::uploadApi()->upload($request->file('image')->getRealPath(), ['folder' => 'products'])['secure_url']
            : null;

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'image' => $imageUrl
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imageUrl = $product->image;
        if ($request->hasFile('image')) {
            if ($product->image && !str_contains($product->image, 'placeholder_dvwraw.png')) {
                $publicId = $this->getCloudinaryPublicId($product->image);
                Cloudinary::uploadApi()->destroy($publicId);
            }

            $imageUrl = Cloudinary::uploadApi()->upload($request->file('image')->getRealPath(), ['folder' => 'products'])['secure_url'];
        }

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'image' => $imageUrl
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image && !str_contains($product->image, 'placeholder_dvwraw.png')) {
            $publicId = $this->getCloudinaryPublicId($product->image);
            Cloudinary::uploadApi()->destroy($publicId);
        }

        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully!');
    }

    private function getCloudinaryPublicId($url)
    {
        $path = parse_url($url, PHP_URL_PATH); // /demo/image/upload/v1234567890/categories/my_image.jpg
        $parts = explode('/', $path);

        // Cari index bagian "v1234567890"
        $versionIndex = collect($parts)->search(fn($part) => str_starts_with($part, 'v'));

        // Ambil path setelah versi
        $fileParts = array_slice($parts, $versionIndex + 1);
        $filePath = implode('/', $fileParts);

        // Hapus ekstensi file
        return preg_replace('/\.[^.]+$/', '', $filePath);
    }
}
