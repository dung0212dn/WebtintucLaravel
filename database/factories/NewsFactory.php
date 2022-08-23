<?php

namespace Database\Factories;

use App\Models\Categories;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\App;
use App\Models\News;
use App\Models\User;
use Faker\Provider\Lorem;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     *
     *
     */
    protected $model = News::class;
    public function definition()
    {
        // $news = User::where('role', 'admin')->get(['id']);
        // $array = $news->toArray();

        // // dd($array);
        // $arraynew = [];

        // foreach ($array as $item)
        //     array_push($arraynew, $item['id']);
        // dd($arraynew);
        $id_category = Categories::where('active', '1')->get(['id'])->toArray();
        $arrIdCategory = [];
        foreach ($id_category as $item)
            array_push($arrIdCategory, $item['id']);

        $id_user = User::get(['id'])->toArray();
        $arrIdUser = [];
        foreach ($id_user as $item)
            array_push($arrIdUser, $item['id']);

        $picNum = ['anh1.jpg','anh2.jpg','anh3.jpg','anh4.jpg','anh5.jpg','anh6.jpg','anh7.jpg','anh8.jpg',
        'anh9.jpg','anh10.jpg','anh11.jpg','anh12.jpg','anh13.jpg','anh14.jpg','anh15.jpg'];


        return [
            'title' => $this->faker->text(80),
            'content'=> $this->faker->paragraph(100),
            'sumary'=> $this->faker->paragraph(3),
            'picIntro' => $this->faker->randomElement($picNum),
            'active' => $this->faker->randomElement(['1', '0']),
            'created_at' =>$this->faker->date('d-m-Y H:i:s','now'),
            'category_id' => $this->faker->randomElement($arrIdCategory),
            'author_id' => $this->faker->randomElement($arrIdUser)
        ];
    }
}
