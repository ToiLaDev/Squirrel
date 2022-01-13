<?php

namespace App\Http\Controllers;


use App\Models\Cast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class CastController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return void
     */
    public function index(Request $request)
    {
        $parameters = $request->route()->parameters;
        if(isset($parameters['page'])) {
            $page = (int)str_replace(config('app.cast_page_prefix'), '', $parameters['page']);
            unset($parameters['page']);
        } else {
            $page = 1;
        }

        if(isset($parameters['time'])) {
            $parameters['created_at'] = Date::createFromFormat('YmdHis', $parameters['time'])->toDateTimeString();
            unset($parameters['time']);
        }

        if(isset($parameters['hash_id'])) {
            $parameters['id'] = decodeNumber($parameters['hash_id']);
            unset($parameters['hash_id']);
        }

        $cast = Cast::where(function ($query) use ($parameters) {
                foreach ($parameters as $key => $val) {
                    $query->where($key, $val);
                }
            })
            ->firstOrFail();

        $casts = config('app.casts');

        if (isset($casts[$cast->castable_type])) {
            return app($casts[$cast->castable_type])->callAction('displayView', [$cast->castable, $page]);
        } else {
            return abort(404);
        }
    }
}
