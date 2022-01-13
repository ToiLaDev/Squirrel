<?php

namespace App\Http\Controllers;


class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $numbers = [];
        for ($i=1;$i<=55;$i++) {
            $numbers[] = $i;
        }
        $reoder = [];
        while (count($numbers) > 0) {
            shuffle($numbers);
            $reoder[] = array_shift($numbers);
        }
        for ($i = 0; $i < 5; $i++) {
            $reoder[] = rand(1,55);
        }
        return baseView('home', ['numbers' => $reoder]);
    }
}
