<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,JPG|max:2048',
        ]);

        $imageUrl = $request->hasFile('image')
            ? Cloudinary::uploadApi()->upload($request->file('image')->getRealPath(), ['folder' => 'categories'])['secure_url']
            : null;

        Category::create([
            'name' => $request->name,
            'image' => $imageUrl
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully!');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:categories,name,' . $id,
            'image' => 'nullable|image|mimes:jpg,jpeg,png,JPG|max:2048',
        ]);

        $imageUrl = $category->image;
        if ($request->hasFile('image')) {
            if ($category->image && !str_contains($category->image, 'placeholder_dvwraw.png')) {
                $publicId = $this->getCloudinaryPublicId($category->image);
                Cloudinary::uploadApi()->destroy($publicId);
            }

            $imageUrl = Cloudinary::uploadApi()->upload($request->file('image')->getRealPath(), ['folder' => 'categories'])['secure_url'];
        }

        $category->update([
            'name' => $request->name,
            'image' => $imageUrl
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully!');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        if ($category->image && !str_contains($category->image, 'placeholder_dvwraw.png')) {
            $publicId = $this->getCloudinaryPublicId($category->image);
            Cloudinary::uploadApi()->destroy($publicId);
        }

        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully!');
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
