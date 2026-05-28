<?php

namespace App\Controllers;

use App\Models\MenuModel;

class Home extends BaseController
{
    public function index()
    {
        $menuModel = new MenuModel();
        
        $data = [
            'title' => 'RM. Ibu Iroh | Pemesanan & Profil',
            'menus' => $menuModel->getMenuAndalan()
        ];

        return view('landing_page', $data);
    }
}