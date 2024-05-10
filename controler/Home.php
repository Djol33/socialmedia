<?php
namespace  App\Controller;
use App\View\HomeView;

class Home extends  Controller{

    public static function Page(): void
    {
        HomeView::createView();
    }
}
