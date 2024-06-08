<?php

namespace App\Http\Controllers;

use App\Models\Points;
use App\Models\Polylines;
use App\Models\Polygons;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->points = new Points();
        $this->polyline = new Polylines();
        $this->polygon = new Polygons();
    }

    public function index()
    {
        $data = [
            "title" => "Dashboard",
            "total_points" => $this->points->count(),
            "total_polylines" => $this->polyline->count(),
            "total_polygons" => $this->polygon->count(),
        ];
        return view('dashboard', $data);
    }
}

