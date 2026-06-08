<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductCatalogSeeder extends Seeder
{
    public function run()
    {
        $catalog = [
            'Home Care Products' => [
                'Fabric Care' => [
                    'RAJ YOG Liquid Detergent 5X Ultra Clean',
                    'RAJ YOG Ultra White 50X Laundry Soap Bar',
                ],
                'Fabric Conditioner' => [
                    'RAJ YOG Fabric Stain Remover',
                    'RAJ YOG Fabric Neutralizer / PH Neutralizer',
                ],
                'Floor Cleaner' => [
                    'RAJ YOG Floor Cleaner',
                ],
                'Toilet Cleaner' => [
                    'Toilet Cleaner',
                ],
                'Dishwash Gel' => [
                    'RAJ YOG Dish Wash Liquid Gel 50X',
                    'RAJ YOG Dish Wash Bar/Soap Gel 50X',
                ],
            ],
            'Personal Care Products' => [
                'Hair Care' => [
                    'Shampoos',
                    'Hair & Sclap Vitalizers',
                    'Hair Conditioner',
                    'Solid Shampoo',
                ],
                'Skin Care' => [
                    'Moisturising Lotion',
                    'Moisturising Cream',
                    'Skin Revital',
                ],
                'Body Wash' => [
                    'Handmade Soap',
                    'Herbal Soap',
                ],
                'Handwash' => [
                    'Handwash',
                ],
            ],
            'Institutional Products' => [
                'Commercial Cleaning Solutions' => [
                    'Commercial Cleaning Solutions',
                ],
                'Bulk Hygiene Products' => [
                    'Bulk Hygiene Products',
                ],
            ],
        ];

        $categoryOrder = 1;
        $productOrder = 1;

        foreach ($catalog as $categoryName => $subcategories) {
            $category = ProductCategory::updateOrCreate(
                ['name' => $categoryName],
                [
                    'slug' => Str::slug($categoryName),
                    'description' => $categoryName,
                    'status' => 1,
                    'sort_order' => $categoryOrder++,
                ]
            );

            foreach ($subcategories as $subcategory => $products) {
                foreach ($products as $productName) {
                    $product = Product::firstOrNew(['name' => $productName]);

                    $product->fill([
                        'category_id' => $category->id,
                        'subcategory' => $subcategory,
                        'short_description' => $product->short_description ?: $subcategory,
                        'status' => 1,
                        'is_featured' => $product->is_featured ?? 0,
                        'sort_order' => $product->sort_order ?: $productOrder,
                    ]);

                    if (! $product->exists || ! $product->slug) {
                        $product->slug = $this->makeUniqueSlug($productName);
                    }

                    $product->save();
                    $productOrder++;
                }
            }
        }
    }

    private function makeUniqueSlug(string $name): string
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $count = 1;

        while (Product::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }
}
