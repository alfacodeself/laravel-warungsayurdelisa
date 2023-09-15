<?php

namespace App\Data;
class Carrousel
{
    public static function getCarrousels() : array
    {
        return [
            asset('assets/landingpage/img/banner1.jpg'),
            asset('assets/landingpage/img/banner2.png'),
            asset('assets/landingpage/img/banner3.png'),
        ];
    }
}