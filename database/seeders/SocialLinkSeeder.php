<?php

namespace Database\Seeders;
use App\Models\SocialLink;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SocialLinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $socials=[
            [
                'name'=>'Facebook',
                'url'=>'https://www.facebook.com/',
                'icon'=>'fab fa-facebook-f',
                'sn'=> 1,
                'status'=>'active'
            ],
            [
                'name'=>'Instagram',
                'url'=>'https://www.instagram.com/',
                'icon'=>'fab fa-instagram',
                'sn'=> 2,
                'status'=>'active'
            ],
            [
                'name'=>'Youtube',
                'url'=>'https://www.youtube.com/',
                'icon'=>'fab fa-youtube',
                'sn'=> 3,
                'status'=>'active'
            ],
        ];
        foreach($socials as $social)
        {
            if (!SocialLink::where('sn', $social['sn'])->exists()) {
                
                SocialLink::create($social);
            }
        }
    }
}
