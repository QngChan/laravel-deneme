<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            [
                'title' => 'Man must explore, and this is exploration at its greatest',
                'subtitle' => 'Problems look mighty small from 150 miles up',
                'content' => "Never in all their history have men been able truly to conceive of the world as one: a single sphere, a globe, having the qualities of a globe, a round earth in which all the directions eventually meet.\n\nScience cuts two ways, of course; its products can be used for both good and evil. But there is no turning back from science.\n\nWhat was most significant about the lunar voyage was not that man set foot on the Moon but that they set eye on the Earth.",
                'published_at' => Carbon::parse('2023-09-24'),
            ],
            [
                'title' => "I believe every human has a finite number of heartbeats",
                'subtitle' => "I don't intend to waste any of mine.",
                'content' => "Every day is an opportunity to spend our time with intention. The moments we choose to explore, learn, and help one another are the ones that stay with us.\n\nMake room for curiosity, and do not put off the things that matter.",
                'published_at' => Carbon::parse('2023-09-18'),
            ],
            [
                'title' => 'Science has not yet mastered prophecy',
                'subtitle' => 'We predict too much for the next year and yet far too little for the next ten.',
                'content' => "We can make careful plans, but the future still has a way of surprising us. Science helps us understand the world and ask better questions.\n\nThe best discoveries often begin with curiosity and a willingness to look beyond what we already know.",
                'published_at' => Carbon::parse('2023-08-24'),
            ],
            [
                'title' => 'Failure is not an option',
                'subtitle' => 'Exploration is our duty to future generations.',
                'content' => "Exploration asks us to keep going when the path is uncertain. Each attempt adds to what we know and helps the next generation go further.\n\nA difficult journey can still bring us closer to a better understanding of our place in the universe.",
                'published_at' => Carbon::parse('2023-07-08'),
            ],
        ];

        foreach ($posts as $post) {
            Post::updateOrCreate(
                ['title' => $post['title']],
                [...$post, 'author' => 'Start Bootstrap'],
            );
        }
    }
}
