<?php

namespace App\Enums;

enum SectionEnum: string
{
    const BG = 'bg_image';


    //Home
    case HOME_BANNER = 'home_banner';
    case HOME_MARQUEE = 'home_marquee';
    case HOME_CARD = 'home_card';
    case HOME_ABOUT = 'home_about';
    case HOME_TESTIMONIALS = 'home_testimonials';
    case HOME_HERO = 'home_hero';


    //Footer
    case FOOTER = 'footer';
    case SOLUTION = "solution";

    //Tutorial
    case OWNER = 'owner';
    case USER = 'user';
    case AllUSER = 'all_user';
    


    
    
}
