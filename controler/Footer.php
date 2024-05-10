<?php

namespace App\Controller;
use App\View\FooterView;
class Footer extends Controller
{
    public static function Page()
    {
        FooterView::createView();
    }
}