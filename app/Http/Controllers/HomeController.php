<?php

namespace App\Http\Controllers;

use App\Models\Bid;
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
        $fields = $request->validate([
            'device' => 'required',
            'brand' => 'required',
            'issue' => 'required'
        ]);

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

    public function acceptBid(Request $request) {
        $fields = $request->validate([
            'bid_id' => 'required'
        ]);

        $bid = Bid::find($fields['bid_id']);
        $bid->update([
            'status' => 'Accepted'
        ]);

        $bids = $bid->problem->bids()->latest()->get();
        $orderNumber = $bid->problem->order->order_number;

        return Inertia::render('TrackDevice', [
            'orderNumber' => $orderNumber,
            'found' => true,
            'bids' => $bids
        ]);
    }

    public function rejectBid(Request $request) {
        $fields = $request->validate([
            'bid_id' => 'required'
        ]);

        $bid = Bid::find($fields['bid_id']);
        $bid->update([
            'status' => 'Rejected'
        ]);

        $bids = $bid->problem->bids()->latest()->get();
        $orderNumber = $bid->problem->order->order_number;

        return Inertia::render('TrackDevice', [
            'orderNumber' => $orderNumber,
            'found' => true,
            'bids' => $bids
        ]);
    }

    public function services() {
        
    }

    public function help() {
        
    }
}