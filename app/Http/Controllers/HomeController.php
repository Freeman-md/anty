<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index() {
        return Inertia::render('Index');
    }

    public function fixMyDevice() {
        return Inertia::render('FixMyDevice');
    }

    public function fixDevice(Request $request) {
        $fields = $request->all();

        $order = Order::create([
            'order_number' => "#". Str::random(8)
        ]);

        $order->problem()->create([
            'device' => $fields['device'],
            'brand'  => $fields['brand'],
            'fault'  => $fields['issue']
        ]);

        return Inertia::render('FixMyDevice', [
            'orderNumber' => $order->order_number,
        ]);
    }

    public function services() {
        
    }

    public function trackDevice() {
        return Inertia::render('TrackDevice');
    }

    public function findDevice(Request $request) {
        $fields = $request->validate([
            'orderNumber' => 'required|string|starts_with:#|min:8|exists:orders,order_number'
        ]);

        $bids = Order::where('order_number', $fields['orderNumber'])->first()->problem->bids()->latest()->get();

        return Inertia::render('TrackDevice', [
            'orderNumber' => $fields['orderNumber'],
            'found' => true,
            'bids' => $bids
        ]);
    }

    public function help() {
        
    }
}