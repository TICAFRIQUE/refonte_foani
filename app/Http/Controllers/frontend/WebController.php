<?php

namespace App\Http\Controllers\frontend;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WebController extends Controller
{
    //

    public function index()
    {
        //recuperer les sliders visibles
        $sliders = Slider::where('visible', true)->orderBy('position', 'asc')->get();
        //recuperer les sliders
        return view('web', compact('sliders'));
    }
}
