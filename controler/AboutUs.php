<?php

namespace App\Controller;
use App\View\AboutUsView;

class AboutUs extends  Controller
{
    public static function Page()
    {
        AboutUsView::createView();
    }
}