<?php

namespace App\Controller;
use App\View\HeaderView;
class Header extends Controller
{
    public static function Page(): void{


        HeaderView::createView();
    }
}