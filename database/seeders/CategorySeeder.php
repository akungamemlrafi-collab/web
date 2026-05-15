<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create([
            'name_id' => 'Cincin Pria',
            'name_en' => 'Men\'s Rings',
            'slug' => 'cincin-pria',
            'icon' => 'ring',
            'description_id' => 'Koleksi cincin pria dengan desain elegan dan mewah',
            'description_en' => 'Elegant men\'s ring collection with luxury design',
        ]);

        Category::create([
            'name_id' => 'Cincin Wanita',
            'name_en' => 'Women\'s Rings',
            'slug' => 'cincin-wanita',
            'icon' => 'diamond',
            'description_id' => 'Cincin wanita premium dengan batu akik pilihan',
            'description_en' => 'Premium women\'s rings with selected agate stones',
        ]);

        Category::create([
            'name_id' => 'Batu Lepas',
            'name_en' => 'Loose Stones',
            'slug' => 'batu-lepas',
            'icon' => 'gem',
            'description_id' => 'Batu akik dan permata lepas berkualitas tinggi',
            'description_en' => 'High-quality loose agate and gemstones',
        ]);

        Category::create([
            'name_id' => 'Aksesoris',
            'name_en' => 'Accessories',
            'slug' => 'aksesoris',
            'icon' => 'beads',
            'description_id' => 'Aksesori perhiasan lengkap untuk melengkapi gaya Anda',
            'description_en' => 'Complete jewelry accessories to complete your style',
        ]);
    }
}
