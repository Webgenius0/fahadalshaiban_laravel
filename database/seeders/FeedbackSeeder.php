<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Feedback;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $feedback=[
        [
            'title'=>'Fahad Al Shaiban',
            'description'=>"Since advertising here, our foot traffic has doubled. The location is prime, and the billboard's visibility is amazing!",
        ],

        [
            'title'=>'Seakh Ali Ebne Abdullah',
            'description'=>"Our sales increased by 30% after using this billboard space for just a month. Highly recommended for anyone looking to grow their business.",
        ],
        [
            'title'=>'Seakh Taher Al Abdullah',
            'description'=>"We've had an overwhelming response to our ads. The visibility is unmatched, and our brand is now a household name.",
        ],
        [
            'title'=>'Sagor Hossain',
            'description'=>"Since advertising here, our foot traffic has doubled. The location is prime, and the billboard's visibility is amazing!",
        ],
    ];

    foreach($feedback as $feed)
    {
        Feedback::create($feed);
    }
    }
}
