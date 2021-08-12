<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request)
    {
        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $request->user(),
            ],
            'images' => [
                'artboard' => asset('/images/artboard.png'),
                'brokenPhone' => asset('images/broken-iphone.png'),
                'google' => asset('images/google.png'),
                'mobile' => asset('images/mobile.png'),
                'laptop' => asset('images/laptop.png'),
                'desktop' => asset('images/desktop.png'),
                'loading' => asset('images/loading.svg'),
                'checkmark' => asset('images/checkmark.png')
            ]
        ]);
    }
}
