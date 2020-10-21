<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Tweet;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tweet::factory()->hasComments(7)->create();
    }
}
