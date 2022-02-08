<?php

use \Illuminate\Support\Facades\Crypt;
use \Illuminate\Contracts\View\View as ViewImpl;
use \Illuminate\Support\Facades\View;
use \App\Services\ActivityHelper;
use \App\Facades\Widget;
use \Illuminate\Support\Facades\Date;

if (!function_exists('baseView')) {
    function baseView($view, $datas = []): ViewImpl
    {
        $views = [
            "Client::$view",
            $view
        ];

        return View::first($views, $datas);
    }
}

if (!function_exists('moduleView')) {
    function moduleView($view, $datas = [], $suffix = null): ViewImpl
    {
        $modulesNamespace = explode('\Controllers', debug_backtrace()[1]['class']);
        $module = config("modules.{$modulesNamespace[0]}");
        $path = str_replace('/', '.', $module['package']);

        $views = [
            "Client::modules.{$path}.".($suffix==null?$view:$view.'_'.$suffix),
            "{$module['name']}::{$view}",
            $view
        ];

        return View::first($views, $datas);
    }
}

if (!function_exists('widgetView')) {
    function widgetView($view, $datas = [], $suffix = null): ViewImpl
    {
        $modulesNamespace = explode('\Widgets', debug_backtrace()[1]['class']);
        $module = config("modules.{$modulesNamespace[0]}");
        $path = str_replace('/', '.', $module['package']);

        $views = [
            "Client::modules.{$path}.widgets.".($suffix==null?$view:$view.'_'.$suffix),
            "{$module['name']}::widgets.{$view}",
            $view
        ];

        return View::first($views, $datas);
    }
}

if (!function_exists('activity')) {
    function activity(): ActivityHelper
    {
        return new ActivityHelper;
    }
}

if (!function_exists('cryptEncode')) {
    function cryptEncode($data): string
    {
        return Crypt::encryptString($data);
    }
}

if (!function_exists('cryptDecode')) {
    function cryptDecode($data): string
    {
        return Crypt::decryptString($data);
    }
}

if (!function_exists('scripts')) {
    function scripts($stack = 'default', $script = null)
    {
        if (empty($script)) {
            \Asset::getScripts($stack)->each(function ($item, $key) {
                echo "<script src=\"{$item}\"></script>\r\n";
            });
        } else {
            \Asset::addScript($stack, $script);
        }
    }
}

if (!function_exists('styles')) {
    function styles($stack = 'default', $style = null)
    {
        if (empty($style)) {
            \Asset::getStyles($stack)->each(function ($item, $key) {
                echo "<link rel=\"stylesheet\" href=\"{$item}\" />\r\n";
            });
        } else {
            \Asset::addStyle($stack, $style);
        }
    }
}

if (!function_exists('scriptBlade')) {
    function scriptBlade($value): string
    {
        return "<?php scripts({$value}); ?>";
    }
}

if (!function_exists('styleBlade')) {
    function styleBlade($value): string
    {
        return "<?php styles({$value}); ?>";
    }
}

if (!function_exists('widget')) {
    function widget($name, $data = null)
    {
        if (Widget::has($name)) {
            Widget::display($name, $data);
        }
    }
}

if (!function_exists('widgetBlade')) {
    function widgetBlade($value): string
    {
        return "<?php widget({$value}); ?>";
    }
}

if (!function_exists('isActiveBlade')) {
    function isActiveBlade($value): string
    {
        return "<?php isActive({$value}); ?>";
    }
}

if (!function_exists('isActive')) {
    function isActive($route, $class = 'active')
    {
        echo \Route::currentRouteName() == $route ? $class :'';
    }
}

if (!function_exists('datetimeBlade')) {
    function datetimeBlade($value): string
    {
        return "<?php echo datetime_format({$value}); ?>";
    }
}

if (!function_exists('datetime_format')) {
    function datetime_format($datetime = null, $format = 'Y-m-d H:i:s', $tz = null)
    {
        if ($tz === null) $tz = config('app.timezone');
        if ($datetime === null) {
            $datetime = Date::now();
        } elseif (is_string($datetime)) {
            $datetime = Date::parse($datetime);
        }
        return $datetime->tz($tz)->format(__($format));
    }
}

if (!function_exists('name2Title')) {
    function name2Title($name): string
    {
        $title = str_replace(['-', '_'], ' ', $name);
        return \Str::title($title);
    }
}

if (!function_exists('encodeNumber')) {
    function encodeNumber($id, $type = 'lower')
    {
        $charset = [
            'lower' => env('BASE_LOWER', 'abcdefghijklmnpqrstuvwxyz0123456789'),
            'upper' => env('BASE_UPPER', 'ABCDEFGHIJKLMNPQRSTUVWXYZ0123456789'),
            'full' => env('BASE_FULL', 'abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ0123456789')
        ];
        //use a bijective function to hash the id number in using a base the size of the character set
        $base    = strlen($charset[$type]);
        $id     += $base;
        $encoded = '';

        //convert id number to calculated base and append to string from front in reverse order
        //to suit calculations using powers of base e.g [62^3,62^2,62^1,62^0]
        while ($id > 0)
        {
            $encoded = $charset[$type][$id % $base].$encoded;
            $id = (int) ($id / $base);
        }

        return $encoded;
    }
}
if (!function_exists('decodeNumber')) {
    function decodeNumber($encoded, $type = 'lower')
    {
        $charset = [
            'lower' => env('BASE_LOWER', 'abcdefghijklmnpqrstuvwxyz0123456789'),
            'upper' => env('BASE_UPPER', 'ABCDEFGHIJKLMNPQRSTUVWXYZ0123456789'),
            'full' => env('BASE_FULL', 'abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ0123456789')
        ];
        // split hash into an array of characters, calculate the power and base
        $decoded = 0;
        $code = str_split($encoded);
        $base = strlen($charset[$type]);
        $highest_power = count($code) - 1;

        //traverse through array to reverse calculation from hash to id using the paramerterized charset
        foreach ($code as $value) {
            $decoded += (int)(strpos($charset[$type], $value)) * (pow($base, $highest_power));
            $highest_power--;
        }

        return (int)($decoded - $base);
    }
}
if (!function_exists('is_true')) {
    function is_true($val, $return_null=false)
    {
        $boolval = ( is_string($val) ? filter_var($val, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) : (bool) $val );
        return ( $boolval===null && !$return_null ? false : $boolval );
    }
}
if (!function_exists('kilo_format')) {
    function kilo_format($number, $symbol = 'K', $decimal_separator = ',')
    {
        if ($number < 1000) {
            return number_format($number, 0, $decimal_separator);
        } else {
            return number_format($number/1000, 0, $decimal_separator).$symbol;
        }
    }
}