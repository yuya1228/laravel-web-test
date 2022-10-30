<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tag;

class TodoTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags=[
            'name'=>'家事','勉強','運動','食事','移動'
        ];
        foreach($tags as $tag){
    Tag::create(['name'=>$tag]);
}
    }
}
