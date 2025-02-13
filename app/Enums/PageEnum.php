<?php

namespace App\Enums;

enum PageEnum: string
{
    const AUTH  = 'login';
    case HOME   = 'home';
    case COMMON = 'common';
    //Tutorial
    case ADD_SIGNAGE = 'add_signage';
    case Add_CAMPING = 'add_camping';
    case LOGIN_TUTORIAL = 'login_tutorial';
    case INCOME_STATEMENT = 'income_statement';
}
