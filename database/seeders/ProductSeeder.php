<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Men's Rings
        Product::create([
            'category_id' => 1,
            'name_id' => 'Cincin Batu Akik Hitam Premium',
            'name_en' => 'Premium Black Agate Ring',
            'slug' => 'cincin-batu-akik-hitam-premium',
            'description_id' => 'Cincin pria berkualitas premium dengan batu akik hitam asli dari Yogyakarta',
            'description_en' => 'Premium quality men\'s ring with authentic black agate stone from Yogyakarta',
            'price_idr' => 850000,
            'price_usd' => 56.67,
            'stock' => 15,
            'sku' => 'RING-PRIA-001',
            'is_featured' => true,
        ]);

        Product::create([
            'category_id' => 1,
            'name_id' => 'Cincin Emas Putih Pria',
            'name_en' => 'White Gold Men\'s Ring',
            'slug' => 'cincin-emas-putih-pria',
            'description_id' => 'Cincin pria dari emas putih 18K dengan desain minimalis modern',
            'description_en' => 'Men\'s ring in 18K white gold with modern minimalist design',
            'price_idr' => 2500000,
            'price_usd' => 166.67,
            'stock' => 8,
            'sku' => 'RING-PRIA-002',
            'is_featured' => true,
        ]);

        // Women's Rings
        Product::create([
            'category_id' => 2,
            'name_id' => 'Cincin Berlian Kristal Wanita',
            'name_en' => 'Crystal Diamond Ring for Women',
            'slug' => 'cincin-berlian-kristal-wanita',
            'description_id' => 'Cincin wanita mewah dengan kristal berlian asli',
            'description_en' => 'Luxury women\'s ring with authentic diamond crystal',
            'price_idr' => 3500000,
            'price_usd' => 233.33,
            'stock' => 12,
            'sku' => 'RING-WANITA-001',
            'is_featured' => true,
        ]);

        Product::create([
            'category_id' => 2,
            'name_id' => 'Cincin Batu Permata Merah Delima',
            'name_en' => 'Garnet Gemstone Ring',
            'slug' => 'cincin-batu-permata-merah-delima',
            'description_id' => 'Cincin wanita dengan batu permata merah delima pilihan',
            'description_en' => 'Women\'s ring with selected red garnet gemstone',
            'price_idr' => 1500000,
            'price_usd' => 100,
            'stock' => 20,
            'sku' => 'RING-WANITA-002',
            'is_featured' => false,
        ]);

        // Loose Stones
        Product::create([
            'category_id' => 3,
            'name_id' => 'Batu Akik Merah Asli 5 Carat',
            'name_en' => 'Authentic Red Agate 5 Carat',
            'slug' => 'batu-akik-merah-asli-5-carat',
            'description_id' => 'Batu akik merah asli dari Lampung, 5 carat berkualitas tinggi',
            'description_en' => 'Authentic red agate stone from Lampung, 5 carat high quality',
            'price_idr' => 750000,
            'price_usd' => 50,
            'stock' => 25,
            'sku' => 'STONE-AGATE-001',
            'is_featured' => true,
        ]);

        Product::create([
            'category_id' => 3,
            'name_id' => 'Batu Giok Hijau Asli 3 Carat',
            'name_en' => 'Authentic Green Jade 3 Carat',
            'slug' => 'batu-giok-hijau-asli-3-carat',
            'description_id' => 'Batu giok hijau premium dari Bandung dengan sertifikat keaslian',
            'description_en' => 'Premium green jade stone from Bandung with authenticity certificate',
            'price_idr' => 1200000,
            'price_usd' => 80,
            'stock' => 10,
            'sku' => 'STONE-JADE-001',
            'is_featured' => false,
        ]);

        // Accessories
        Product::create([
            'category_id' => 4,
            'name_id' => 'Kalung Batu Akik Warna-Warni',
            'name_en' => 'Colorful Agate Stone Necklace',
            'slug' => 'kalung-batu-akik-warna-warni',
            'description_id' => 'Kalung dengan batu akik warna-warni asli, desain tradisional',
            'description_en' => 'Necklace with authentic colorful agate stones, traditional design',
            'price_idr' => 450000,
            'price_usd' => 30,
            'stock' => 30,
            'sku' => 'ACC-NECKLACE-001',
            'is_featured' => true,
        ]);

        Product::create([
            'category_id' => 4,
            'name_id' => 'Gelang Tangan Permata Campuran',
            'name_en' => 'Mixed Gemstone Bracelet',
            'slug' => 'gelang-tangan-permata-campuran',
            'description_id' => 'Gelang tangan dengan kombinasi berbagai permata pilihan',
            'description_en' => 'Hand bracelet with combination of selected gemstones',
            'price_idr' => 650000,
            'price_usd' => 43.33,
            'stock' => 18,
            'sku' => 'ACC-BRACELET-001',
            'is_featured' => false,
        ]);
    }
}
