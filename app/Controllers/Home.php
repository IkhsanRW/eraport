<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Dashboard',
            'title_content' => 'Dashboard'
        ];
        return view('admin/dashboard', $data);
    }
}
