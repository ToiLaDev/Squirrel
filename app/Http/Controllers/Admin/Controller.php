<?php

namespace App\Http\Controllers\Admin;

use App\Services\ToastResponse;
use App\Traits\ApiResponseTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, ApiResponseTrait;

    public $admin;

    public $request;

    public $mainRouteName = 'admin.dashboard';

    public function __construct()
    {
        if (isset($this->permissions)) {
            foreach ($this->permissions as $permission => $only) {
                $this->middleware("can:{$permission}")->only($only);
            }
        }

        $this->middleware(function ($request, $next) {
            $this->admin =Auth::guard('employee')->user();
            view()->share('admin', $this->admin);
            $this->request = $request;
            return $next($request);
        });
    }

    protected function breadcrumb($name, $link = null, $icon = null): self
    {
        $breadcrumbs = [
            ['link' => route('admin.dashboard'), 'name' => 'Dashboard', 'icon' => 'home']
        ];
        if (isset($this->breadcrumbs)) {
            $breadcrumbs = array_merge($breadcrumbs, $this->breadcrumbs);
        }
        $breadcrumb = ['name'=>$name];
        if (!empty($link)) {
            $breadcrumb['link'] = $link;
        }
        if (!empty($icon)) {
            $breadcrumb['icon'] = $icon;
        }
        $breadcrumbs[] = $breadcrumb;
        view()->share('breadcrumbs', $breadcrumbs);
        return $this;
    }

    protected function withButton($route = true, $title = 'Back') {
        view()->share('withButton', ['route' => $route,'title' => $title]);
    }

    protected function withButtonMain($title = 'Back') {
        $this->withButton($this->mainRouteName, $title);
    }

    protected function storeResponse($model = false)
    {

        if ($this->request->wantsJson()) {
            return $this->successToast(ToastResponse::SUCCESS_CREATED, $model?$model->toArray():null);
        } else {
            return redirect()->route($this->mainRouteName)->with('success')->withToast([
                'message' => ToastResponse::SUCCESS_CREATED
            ]);
        }
    }

    protected function updateResponse($model = false)
    {

        if ($this->request->wantsJson()) {
            return $this->successToast(ToastResponse::SUCCESS_UPDATED, $model?$model->toArray():null);
        } else {
            return back()->with('success')->withToast([
                'message' => ToastResponse::SUCCESS_UPDATED
            ]);
        }
    }

    protected function deleteResponse()
    {
        if ($this->request->wantsJson()) {
            return $this->successToast(ToastResponse::SUCCESS_DELETED);
        } else {
            return redirect()->route($this->mainRouteName)->with('success')->withToast([
                'message' => ToastResponse::SUCCESS_DELETED
            ]);
        }
    }
}
