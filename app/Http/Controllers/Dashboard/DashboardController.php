<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Dashboard\Controller;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $this->dashboardTemplate('index',__('Dashboard'));
    }
}
