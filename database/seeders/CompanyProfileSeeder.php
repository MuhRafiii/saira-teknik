<?php

namespace Database\Seeders;
use App\Models\CompanyProfile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanyProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CompanyProfile::create([
            'name' => 'Saira Teknik',
            'logo' => 'https://res.cloudinary.com/dxlevzn3n/image/upload/v1757494898/circle-app-images/kqos2jiklkgjdzw8kpz9.jpg',
            'description' => 'Perusahaan teknologi yang fokus pada solusi digital modern. Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus, nam ratione veniam suscipit molestiae necessitatibus doloribus iure quo totam perferendis esse facilis dolorem commodi distinctio soluta eligendi praesentium. Voluptatem omnis eius, deleniti consequuntur dignissimos corporis! Doloremque culpa nisi in delectus officia sunt omnis porro fugiat possimus quo, ut reprehenderit! Ipsam.',
            'phone' => '081234567890',
            'email' => 'saira@example.com',
            'address' => 'Jl. Sudirman No. 45, Jakarta',
            'gmaps' => 'https://maps.app.goo.gl/hJ8KLDYWcpPt5vJN6'
        ]);
    }
}
