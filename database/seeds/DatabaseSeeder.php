<?php

use App\User;
use App\Product;
use App\Category;
use App\Transaction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::Statement('SET FOREIGN_KEY_CHECKS = 0');

        User::truncate();
        Category::truncate();
        Product::truncate();
        Transaction::truncate();

        DB::table('category_product')->truncate();

        User::flushEventListeners();
        Category::flushEventListeners();
        Product::flushEventListeners();
        Transaction::flushEventListeners();

        $userQuantity = 20;
        $categoryQuantity = 10;
        $productQuantity = 50;
        $transactionQuantity = 50;

        factory(User::class, $userQuantity)->create();
        factory(Category::class, $categoryQuantity)->create();
        factory(Product::class, $productQuantity)->create()->each(
            function($product){
                $categories = Category::all()->random(mt_rand(1, 3))->pluck('id');
                $product->categories()->attach($categories);
            });
        factory(Transaction::class, $transactionQuantity)->create();


    }
}
