<?php


namespace App\Services;

use Illuminate\Support\Arr;

class Squirrel
{
    protected $app;
    protected $currentRouteName;
    protected $adminMenu = [
        'dashboard' => [
            'title'     => 'Dashboard',
            'route'     => 'admin.dashboard',
            'icon'      => 'home'
        ],
        'overview'   => [
            'title'     => 'Overview',
        ],
        'content'   => [
            'title'     => 'Content',
            'children'  => [
                'media'      => [
                    'title'     => 'Media library',
                    'route'     => 'admin.media.manager',
                    'icon'      => 'image',
                    'permission'=> 'employee.view'
                ],
            ]
        ],
        'system'   => [
            'title'     => 'System',
            'children'  => [
                'employee'      => [
                    'title'     => 'Employees',
                    'route'     => 'admin.employees.index',
                    'icon'      => 'users',
                    'permission'=> 'employee.view'
                ],
                'role'      => [
                    'title'     => 'Roles',
                    'route'     => 'admin.roles.index',
                    'icon'      => 'shield',
                    'permission'=> 'role.view'
                ],
                'setting'      => [
                    'title'     => 'Settings',
                    'icon'      => 'settings',
                    'permission'=> 'system.site',
                    'children'  => [
                        'site'  => [
                            'title'     => 'Site Settings',
                            'route'     => 'admin.system.setting.site',
                            'icon'      => 'globe',
                            'permission'=> 'system.site'
                        ],
                        'services'  => [
                            'title'     => 'Services',
                            'route'     => 'admin.system.setting.service',
                            'icon'      => 'cpu',
                            'permission'=> 'system.site'
                        ]
                    ]
                ]
            ]
        ],
        'account'   => [
            'title'     => 'Account Setting',
            'children'  => [
                'profile'      => [
                    'title'     => 'Profile',
                    'route'     => 'admin.account.profile',
                    'icon'      => 'user'
                ],
                'security'      => [
                    'title'     => 'Security',
                    'route'     => 'admin.account.security',
                    'icon'      => 'shield'
                ],
                'notify'      => [
                    'title'     => 'Notifications',
                    'route'     => 'admin.account.notify',
                    'icon'      => 'bell'
                ],
                'logout'      => [
                    'title'     => 'Logout',
                    'route'     => 'admin.logout',
                    'icon'      => 'log-out'
                ]
            ]
        ]
    ];
    protected $accountMenu = [
        'dashboard' => [
            'title'     => 'My Dashboard',
            'route'     => 'account.dashboard',
            'icon'      => 'home'
        ],
        'wallet' => [
            'title'     => 'My Wallet',
            'route'     => 'home',
            'icon'      => 'wallet'
        ],
        'profile' => [
            'title'     => 'My Profile',
            'route'     => 'account.profile',
            'icon'      => 'user'
        ],
        'referral' => [
            'title'     => 'Referral',
            'route'     => 'account.referral',
            'icon'      => 'share-alt'
        ],
    ];

    public function __construct($app) {
        $this->app = $app;
    }

    protected function initCurrentRoute() {
        $this->currentRouteName = $this->app->router->currentRouteName();
    }

    protected function reOrderAdminMenu(): array
    {
        $this->initCurrentRoute();
        $systemMenuKeys = [['dashboard', 'overview'], ['content','system','account']];
        $moduleMenuKeys = array_diff(array_keys($this->adminMenu),Arr::collapse($systemMenuKeys));
        $_newMenus = [];

        foreach ($systemMenuKeys[0] as $key) {
            $_newMenus[$key] = $this->adminMenu[$key];
        }
        foreach ($moduleMenuKeys as $key) {
            $_newMenus[$key] = $this->adminMenu[$key];
        }
        foreach ($systemMenuKeys[1] as $key) {
            $_newMenus[$key] = $this->adminMenu[$key];
        }
        return $_newMenus;
    }

    protected function initAdminMenu($menus = []): array
    {
        $ret = false;

        if (empty($menus)) {
            $menus = $this->reOrderAdminMenu();
            foreach ($menus as $key => $child) {
                list($_child, $active) = $this->initAdminMenu($child);
                if ($active) {
                    $menus[$key] = $_child;
                }
            }
        }
        elseif (isset($menus['route']) && $this->currentRouteName == $menus['route']) {
            $ret = true;
        }
        elseif (isset($menus['children'])) {
            foreach ($menus['children'] as $key => $child) {
                list($_child, $active) = $this->initAdminMenu($child);
                if ($active) {
                    $menus['children'][$key] = $_child;
                    $ret = true;
                }
            }
        }
        if ($ret) {
            $menus['active'] = true;
        }
        return [$menus, $ret];
    }

    public function getAdminMenu(): object
    {
        list($menus) = $this->initAdminMenu();
        $menus = collect($menus);
        return json_decode($menus->toJson(), false);
    }

    public function getAdminAccountMenu()
    {
        $menus = $this->adminMenu['account']['children'];
        unset($menus['logout']);
        return $menus;
    }

    public function getAdminSettingMenu()
    {
        return $this->adminMenu['system']['children']['setting']['children'];
    }

    public function addAdminMenu(array $menus, $parent = false) {
        $prefix = '';
        if ($parent) $prefix = "{$parent}.children.";
        foreach ($menus as $key => $menu) {
            $this->adminMenu = Arr::add($this->adminMenu, $prefix.$key, $menu);
        }
    }

    protected function reOrderAccountMenu(): array
    {
        $this->initCurrentRoute();
        $systemMenuKeys = [['dashboard'], ['wallet','profile','referral']];
        $moduleMenuKeys = array_diff(array_keys($this->accountMenu),Arr::collapse($systemMenuKeys));
        $_newMenus = [];

        foreach ($systemMenuKeys[0] as $key) {
            $_newMenus[$key] = $this->accountMenu[$key];
        }
        foreach ($moduleMenuKeys as $key) {
            $_newMenus[$key] = $this->accountMenu[$key];
        }
        foreach ($systemMenuKeys[1] as $key) {
            $_newMenus[$key] = $this->accountMenu[$key];
        }
        return $_newMenus;
    }

    protected function initAccountMenu($menus = []): array
    {
        $ret = false;

        if (empty($menus)) {
            $menus = $this->reOrderAccountMenu();
            foreach ($menus as $key => $child) {
                list($_child, $active) = $this->initAccountMenu($child);
                if ($active) {
                    $menus[$key] = $_child;
                }
            }
        }
        elseif (isset($menus['children'])) {
            foreach ($menus['children'] as $key => $child) {
                list($_child, $active) = $this->initAccountMenu($child);
                if ($active) {
                    $menus['children'][$key] = $_child;
                    $ret = true;
                }
            }
        }
        if (isset($menus['route']) && $this->currentRouteName == $menus['route']) {
            $ret = true;
        }
        if ($ret) {
            $menus['active'] = true;
        }
        return [$menus, $ret];
    }

    public function getAccountMenu(): object
    {
        list($menus) = $this->initAccountMenu();
        $menus = collect($menus);
        return json_decode($menus->toJson(), false);
    }

    public function addAccountMenu(array $menus, $parent = false) {
        $prefix = '';
        if ($parent) $prefix = "{$parent}.children.";
        foreach ($menus as $key => $menu) {
            $this->accountMenu = Arr::add($this->accountMenu, $prefix.$key, $menu);
        }
    }
}
