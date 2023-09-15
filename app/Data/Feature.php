<?php

namespace App\Data;
class Feature
{
    public static function getFeatures() : array
    {
        return [
            'fas fa-leaf' => 'Varietas Sayuran Segar Berkualitas Tinggi',
            'fas fa-truck' => 'Pengiriman Cepat dan Terpercaya',
            'fas fa-dollar-sign' => 'Harga Terjangkau untuk Semua',
            'fas fa-users' => 'Program Keanggotaan Beragam Manfaat',
        ];
    }
}