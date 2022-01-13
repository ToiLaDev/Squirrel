<?php namespace App\Http\Controllers\Admin;

use App\Services\SettingService;
use Illuminate\Http\Request;

class SettingController extends Controller
{

    public $permissions = [
        'system.site' => ['site', 'site_update']
    ];

    public $breadcrumbs = [
        ['link' => "javascript:void(0)", 'name' => 'System']
    ];

    public $settingService;

    public function __construct(SettingService $settingService)
    {
        parent::__construct();
        $this->settingService = $settingService;
    }

    public function site(Request $request)
    {
        $this->breadcrumb('Site Settings');

        return view('Admin::system.setting.site');
    }

    public function site_update(Request $request)
    {
        $this->settingService->setFromRequest($request, 'site', [
            'name',
            'title',
            'description',
            'email',
            'phone',
            'company_name',
            'company_address'
        ]);

        return $this->updateResponse();
    }

    public function service(Request $request)
    {
        $this->breadcrumb('Service Settings');

        return view('Admin::system.setting.service');
    }

    public function service_update(Request $request)
    {
//        $datas = $request->only([
//            'google', 'facebook', 'twitter', 'linkedin', 'github', 'bitbucket'
//        ]);
//
//        foreach ($datas as $key => $val) {
//            $setting = Setting::firstOrNew(['key' => $key, 'type' => 'services']);
//            $setting->value = $val;
//            $setting->save();
//        }

        return back();
    }
}
