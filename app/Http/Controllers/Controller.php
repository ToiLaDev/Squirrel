<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $admin;
    public $my;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::guard('employee')->check()) {
                $this->admin =Auth::guard('employee')->user();
                view()->share('admin', $this->admin);
            }
            if (Auth::guard('web')->check()) {
                $this->my =Auth::guard('web')->user();
                view()->share('my', $this->my);
            }
            return $next($request);
        });
    }
}
