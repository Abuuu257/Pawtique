<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Premium Leather Collar',
                'subtitle' => 'Accessories',
                'price' => 45.00,
                'rating' => 4.8,
                'reviews' => 124,
                'description' => 'Give your furry friend the ultimate touch of luxury with our handcrafted premium leather collar. Designed for both durability and comfort, the soft inner lining prevents chafing while the solid brass hardware ensures maximum security during walks.',
                'images' => [
                    'https://images.unsplash.com/photo-1576201836106-db1758fd1c97?auto=format&fit=crop&q=80&w=600',
                    'https://images.unsplash.com/photo-1587300003388-59208cc962cb?auto=format&fit=crop&q=80&w=600',
                    'https://images.unsplash.com/photo-1548199973-03cce0bbc87b?auto=format&fit=crop&q=80&w=600',
                ],
            ],
            [
                'name' => 'Essential Spa Kit',
                'subtitle' => 'Grooming',
                'price' => 65.00,
                'rating' => 4.6,
                'reviews' => 84,
                'description' => 'The ultimate spa kit to keep your dog looking and smelling fresh. Includes organic oat shampoo, a soft-bristle brush, ear wipes, and a conditioning spray.',
                'images' => [
                    'https://images.unsplash.com/photo-1516734212186-a967f81ad0d7?auto=format&fit=crop&q=80&w=600',
                    'https://images.unsplash.com/photo-1596492784531-6e6eb5ea9993?auto=format&fit=crop&q=80&w=600',
                    'https://images.unsplash.com/photo-1626082927389-6cd097cdc6ec?auto=format&fit=crop&q=80&w=600',
                ],
            ],
            [
                'name' => 'Organic Beef Bites',
                'subtitle' => 'Treats',
                'price' => 24.00,
                'rating' => 4.9,
                'reviews' => 312,
                'description' => 'Reward your dog with these irresistible, 100% natural organic beef bites. Sourced from grass-fed cattle with absolutely no artificial preservatives, fillers, or grains. Perfect for training or a healthy midday snack.',
                'images' => [
                    'https://images.unsplash.com/photo-1589924691995-400dc9ecc119?auto=format&fit=crop&q=80&w=600',
                    'https://images.unsplash.com/photo-1518717758536-85ae29035b6d?auto=format&fit=crop&q=80&w=600',
                    'https://images.unsplash.com/photo-1601758228041-f3b2795255f1?auto=format&fit=crop&q=80&w=600',
                ],
            ],
            [
                'name' => 'Plush Cloud Bed',
                'subtitle' => 'Home & Living',
                'price' => 110.00,
                'rating' => 4.7,
                'reviews' => 210,
                'description' => 'A bed so comfortable you will want to sleep in it! Features orthopedic memory foam that relieves joint pain and provides maximum support for older pets and heavy sleepers. Faux-fur cover is machine-washable.',
                'images' => [
                    'https://images.unsplash.com/photo-1605333552097-f8cc02010ea6?auto=format&fit=crop&q=80&w=600',
                    'https://images.unsplash.com/photo-1541781774459-bb2af2f05b55?auto=format&fit=crop&q=80&w=600',
                    'https://images.unsplash.com/photo-1564349683136-77e08dba1ef7?auto=format&fit=crop&q=80&w=600',
                ],
            ],
        ];

        foreach ($products as $productData) {
            Product::create($productData);
        }
    }
}
