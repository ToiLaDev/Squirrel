<?php

namespace App\Http\Controllers\Account;


use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        return baseView('account.dashboard');
    }
}
