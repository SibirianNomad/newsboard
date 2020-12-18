<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories=[];
        $namesCategory=['недвижимость','транспорт','личные вещи','хобби и отдых','услуги','бытовая техника'];
        for($i=0;$i<count($namesCategory);$i++){
            $categories[]=[
                'name'  => $namesCategory[$i],
            ];
        }
        Category::insert($categories);
    }
}
