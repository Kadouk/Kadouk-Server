<?php

use Illuminate\Database\Seeder;

class ContentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
//        DB::table('contents')->insert([
//            'name' => $faker->name,
//            'desc' => 'desc',
//            'id_catagory' => rand(1, 10),
//            'id_publisher' => rand(1, 20)
//        ]);
        
        factory(App\Content::class, 10)->create()->each(function ($u) {
            $u->image()->save(factory(App\ContentImage::class)->make());
        });
    }
}
