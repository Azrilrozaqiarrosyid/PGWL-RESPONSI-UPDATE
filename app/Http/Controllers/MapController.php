<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MapController extends Controller
{
    public function index()
    {
        $data = [
            "title" => "CIVICTRACS",
        ];

        //cek if user login
        if (auth()->check()) {
            return view('index', $data);
        } else {
            return view('index-public', $data);
        }

    }

    public function table()
    {
        $data = [
            "title" => "CIVICTRACS",
        ];
        return view('table', $data);
    }
}
