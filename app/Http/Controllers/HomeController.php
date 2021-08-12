<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index() {
        return Inertia::render('Index');
    }

    public function fixMyDevice() {
        return Inertia::render('FixMyDevice');
    }

    public function fixDevice() {

    }

    public function services() {
        
    }

    public function trackDevice() {
        return Inertia::render('TrackDevice');
    }

    public function findDevice() {
        
    }

    public function help() {
        
    }
}