<?php

namespace Database\Factories;

use App\Models\Comments;
use App\Models\News;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Comments::class;
    public function definition()
    {
        $id_user = User::get(['id'])->toArray();
        $arrIdUser = [];
        foreach ($id_user as $item)
            array_push($arrIdUser, $item['id']);

        $id_news = News::get(['id'])->toArray();
        $arrIdNews = [];
        foreach ($id_news as $item)
            array_push($arrIdNews, $item['id']);


        return [
            'content' => $this->faker->paragraph(4),
            'author_id' => $this->faker->randomElement($arrIdUser),
            'news_id' => $this->faker->randomElement($arrIdNews),
            'created_at' => $this->faker->dateTime('now'),
        ];
    }
}
