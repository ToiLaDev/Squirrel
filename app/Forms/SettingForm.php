<?php

namespace App\Forms;

class SettingForm
{

    public function site() {
        $controls = [
            'company_name' => [
                'required' => true,
                'value' => config('site.company_name')
            ],
            'company_address' => [
                'required' => true,
                'value' => config('site.company_address')
            ],
            'email' => [
                'type' => 'email',
                'required' => true,
                'value' => config('site.email')
            ],
            'forseo' => 'For SEO',
            'name' => [
                'required' => true,
                'title' => 'Site Name',
                'value' => config('site.name')
            ],
            'title' => [
                'required' => true,
                'title' => 'Site Title',
                'value' => config('site.title')
            ],
            'description' => [
                'type' => 'textarea',
                'required' => true,
                'title' => 'Site Description',
                'wrap' => 'col-12',
                'value' => config('site.description')
            ],
        ];

        return view('use.form', [
            'wrap' => 'col-md-6 col-12',
            'method' => 'put',
            'controls' => $controls
        ]);
    }
}