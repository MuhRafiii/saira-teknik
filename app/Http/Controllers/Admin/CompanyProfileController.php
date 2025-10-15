<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use App\Models\CompanyProfile;

class CompanyProfileController extends Controller
{
    public function edit()
    {
        $profile = CompanyProfile::first(); // diasumsikan hanya ada satu data
        return view('admin.company-profile', compact('profile'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'description' => 'nullable',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,JPG|max:2048',
            'banner' => 'nullable|image|mimes:jpg,jpeg,png,JPG|max:4096', // validasi banner
            'gmaps' => 'nullable',
        ]);

        $profile = CompanyProfile::first();

        // Handle logo
        if ($request->hasFile('logo')) {
            if ($profile->logo && !str_contains($profile->logo, 'placeholder_dvwraw.png')) {
                $publicId = $this->getCloudinaryPublicId($profile->logo);
                Cloudinary::uploadApi()->destroy($publicId);
            }

            $logoUrl = Cloudinary::uploadApi()->upload(
                $request->file('logo')->getRealPath(),
                ['folder' => 'company-logos']
            )['secure_url'];

            $profile->logo = $logoUrl;
        }

        // Handle banner
        if ($request->hasFile('banner')) {
            if ($profile->banner && !str_contains($profile->banner, 'placeholder_banner.png')) {
                $publicId = $this->getCloudinaryPublicId($profile->banner);
                Cloudinary::uploadApi()->destroy($publicId);
            }

            $bannerUrl = Cloudinary::uploadApi()->upload(
                $request->file('banner')->getRealPath(),
                ['folder' => 'company-banners']
            )['secure_url'];

            $profile->banner = $bannerUrl;
        }

        $profile->update($request->except(['logo', 'banner']));

        return redirect()->back()->with('success', 'Company profile updated successfully!');
    }

    private function getCloudinaryPublicId($url)
    {
        $path = parse_url($url, PHP_URL_PATH); // /demo/image/upload/v1234567890/folder/my_image.jpg
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
