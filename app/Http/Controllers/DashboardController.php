<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Survey;

class DashboardController extends Controller
{
    public function index(){

        $count = Survey::where('user_id', auth()->id())->count();

        return inertia("Dashboard", [
            'count' => $count,
        ]);
    }
}
