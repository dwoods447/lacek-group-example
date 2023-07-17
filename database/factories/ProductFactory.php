<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $products = [
            'New Balance Men\'s 481 V3 Trail Running Shoe',
            'Contour Men’s Sweatpants with Pockets Zipper, Cruise Sweatpants for Men, Joggers for Men Slim Fit, Mens Joggers for Workout',
            'Fox Outdoor Products Vietnam Jungle Boot',
            'Amazon Essentials Men\'s Packable Lightweight Water-Resistant Puffer Jacket (Available in Big & Tall)',
            'Hanes Men\'s Hooded Sweatshirt, EcoSmart Cotton-Blend Plush Fleece Pullover Hoodie',
            'Nivea Men Maximum Hydration Body Wash, Aloe Vera Body Wash for Dry Skin, 30 Fl Oz Pump Bottle',
            'SpaLife All Natural Bath and Body Luxury Spa Men\'s Sandalwood Gift Set',
        ];

        $productname = $this->faker->unique()->randomElement($products);
        $index  = array_search($productname, $products);
        $images = [
        "https://m.media-amazon.com/images/I/91bIOuQQXIL._AC_UX695_.jpg",
        "https://m.media-amazon.com/images/I/6163cTF2DjL._AC_UX679_.jpg",
        "https://m.media-amazon.com/images/I/61ZToGLK1+L._AC_UX679_.jpg",
        "https://m.media-amazon.com/images/I/81UiEq+TM6L._AC_UY879_.jpg",
        "https://m.media-amazon.com/images/I/71wRzrKJiOL._AC_UX679_.jpg",
        "https://m.media-amazon.com/images/I/51c2Mvm0MES._SX300_SY300_QL70_FMwebp_.jpg",
        "https://m.media-amazon.com/images/I/81SwQy-JDpL._SX679_.jpg"
        ];
        
        return [
            //
            'name' => $productname,
            'price'  => $this->faker->randomFloat(1, 20, 30),
            'description' => $this->faker->paragraph,
            'image_url' => $images[$index]
        ];
    }
}
