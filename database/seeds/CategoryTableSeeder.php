<?php

use Illuminate\Database\Seeder;

use App\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Appartamento',
            'Villa',
            'Casa rustica',
            'Casa di campagna',
            'Cascina',
            'Casa al mare',
            'Cottage',
            'Chalet'
        ];

        foreach($categories as $category) {
            $newCategory = new Category();
            $newCategory->name = $category;
            $newCategory->save();
        }
    }
}
