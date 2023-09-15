<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Home | Faza Blog'
        ];

        // echo view('layout/header', $data);
        return view('pages/home', $data);
        // echo view('layout/footer');
    }

    public function about()
    {
        $data = [
            'title' => 'About | Faza Blog'
        ];
        
        // echo view('layout/header', $data);
        return view('pages/about', $data);
        // echo view('layout/footer');
    }

    public function contact()
    {
        $data = [
            'title' => 'Contact | Faza Blog',
            'alamat' => [
                [
                    'tipe' => 'Rumah',
                    'alamat' => 'Jl. abc No. 123',
                    'kota' => 'Purworejo'
                ],
                [
                    'tipe' => 'Kantor',
                    'alamat' => 'Jl. setiabudi No. 456',
                    'kota' => 'Purworejo'
                ]
            ]
                ];
        
        // echo view('layout/header', $data);
        return view('pages/contact', $data);
        // echo view('layout/footer');
    }

    
}
