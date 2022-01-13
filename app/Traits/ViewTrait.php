<?php

namespace App\Traits;

use Illuminate\Support\Facades\View;

trait ViewTrait
{


    protected $moduleViewPath;
    protected $moduleViewPackage;

    protected function baseView($view, $datas = []) {
        if (View::exists('Client::' . $view)) {
            $view = 'Client::' . $view;
        }
        return view($view, $datas);
    }

    protected function assetView($view, $directory, $datas = []) {
        $prefix = '';
        if ($directory != null) {
            $prefix = str_replace('/','.',$directory) . '.';
        }
        if (View::exists('Client::' . $prefix . $view)) {
            $view = 'Client::' . $prefix . $view;
        } else {
            if($prefix != null) {
                //set_asset_path('themes/' . $directory);
            }
            $view = $prefix . $view;
        }
        return view($view, $datas);
    }

    protected function widgetView($view, $datas = [], $suffix = null) {
        $this->initModuleView();
        if (View::exists('Client::modules.' . $this->moduleViewPath . '.widgets.' . ($suffix==null?$view:$view.'_'.$suffix))) {
            $view =  'Client::modules.' . $this->moduleViewPath . '.widgets.' . ($suffix==null?$view:$view.'_'.$suffix);
        } else {
            $view = $this->moduleViewPackage . '::' . $view;
        }
        return view($view, $datas);
    }

    protected function moduleView($view, $datas = [], $suffix = null) {
        $this->initModuleView();
        if (View::exists('Client::modules.' . $this->moduleViewPath . '.' . ($suffix==null?$view:$view.'_'.$suffix))) {
            $view =  'Client::modules.' . $this->moduleViewPath . '.' . ($suffix==null?$view:$view.'_'.$suffix);
        } else {
            $view = $this->moduleViewPackage . '::' . $view;
        }
        return view($view, $datas);
    }

    protected function initModuleView() {
        $reflector = new \ReflectionClass(get_class($this));
        $venderPaths = explode('/', str_replace([base_path('vendor\\'), base_path('vendor/'), '\\'],['', '', '/'],dirname($reflector->getFileName())));
        $this->moduleViewPath = $venderPaths[0].'/'.$venderPaths[1];
        $this->moduleViewPackage = app('vns')->getModuleNameSpace($this->moduleViewPath);
    }
}
