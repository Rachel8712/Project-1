<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'Americano',
                'description'=> ' Americano: Kopi, Air, Sejati.',
                'price'=> '15000',
                'stock'=> '100',
                'image'=> 'public\storage\pictureproduct\Americano.jpeg',
                'product_category_id'=> '1',
            ],[
                'name' => 'Espresso',
                'description'=> 'Espresso: Jantung Kopi Sejati.',
                'price'=> '12000',
                'stock'=> '150',
                'image'=> '',
                'product_category_id'=> '1',   
            ],[
                'name' => 'Cappucino',
                'description'=> 'Cappucino: Kelembutan dalam Genggaman.',
                'price'=> '12000',
                'stock'=> '150',
                'image'=> '',
                'product_category_id'=> '1',   
            ],[
                'name' => 'Matcha Latte',
                'description'=> 'Manisnya Matcha, Lembutnya Susu.',
                'price'=> '20000',
                'stock'=> '100',
                'image'=> '',
                'product_category_id'=> '2',  
            ],[
                'name' => 'Taro Latte',
                'description'=> 'Keajaiban Ungu dengan Aroma Unik dan Rasa yang Memikat.',
                'price'=> '20000',
                'stock'=> '100',
                'image'=> '',
                'product_category_id'=> '2',
            ],[
                'name' => 'Thai Tea',
                'description'=> 'Sensasi Eksotis Thailand dengan Rasa yang Menggoda.',
                'price'=> '23000',
                'stock'=> '150',
                'image'=> '',
                'product_category_id'=> '2',
            ],[
                'name' => 'Ice Tea Original',
                'description'=> 'Penawar Dahaga Terbaik dengan Rasanya yang Klasik.',
                'price'=> '5000',
                'stock'=> '100',
                'image'=> '',
                'product_category_id'=> '3',
            ],[
                'name' => 'Chamomile Tea',
                'description'=> 'Penenang Jiwa dalam Kedamaian Herbal.',
                'price'=> '7000',
                'stock'=> '100',
                'image'=> '',
                'product_category_id'=> '3',
            ],[
                'name' => 'Earl Grey Tea',
                'description'=> 'Teh dengan Aroma Bergamot dengan Ketenangan yang Berkelas',
                'price'=> '7000',
                'stock'=> '100',
                'image'=> '',
                'product_category_id'=> '3',
            ]
        ]);
    }
}
