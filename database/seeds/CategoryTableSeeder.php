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
            'Appartamento', //1
            'Villa', //2
            'Casa rustica', //3
            'Casa di campagna', //4
            'Cascina', //5
            'Casa al mare', //6
            'Cottage', //7
            'Chalet', //8
            'Baita', //9
            'Stanza privata', //10
            'Castello' //11
        ];

        foreach($categories as $category) {
            $newCategory = new Category();
            $newCategory->name = $category;
            $newCategory->save();
        }
    }
}
