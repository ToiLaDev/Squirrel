<?php


namespace App\Services;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RouteMethods
{

    /**
     * Register the typical authentication routes for an application.
     *
     * @return callable
     */
    public function squirrel()
    {
        return function () {

            $this->middleware('web')
                ->group(function() {
                    $this->get('', 'HomeController@index')->name('home');
                    $this->get('lang/{locale}', 'LanguageController@swap')->name('language');

                    $this->middleware('guest')
                        ->group(function() {
                            // Login Routes...
                            $this->get('login/{provider}', 'Auth\SocialController@login')->name('social.login');
                            $this->get('authorize/{provider}', 'Auth\SocialController@authorize')->name('social.authorize');
                        })
                    ;

                    $this->namespace('Account')
                        ->prefix('account')
                        ->name('account.')
                        ->middleware('auth')
                        ->group(function() {
                            // Dashboard Routes...
                            $this->get('dashboard', 'DashboardController@index')->name('dashboard');
                            $this->get('profile', 'AccountController@profile')->name('profile');
                            $this->get('referral', 'AccountController@referral')->name('referral');
                            $this->post('general', 'AccountController@general')->name('general');
                            $this->post('password', 'AccountController@password')->name('password');
                        });

                    $this->namespace('Admin')
                        ->prefix(config('app.admin_prefix'))
                        ->name('admin.')
                        ->group(function() {

                            $this->middleware('guest:employee')
                                ->group(function() {
                                    // Login Routes...
                                    $this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
                                    $this->post('login', 'Auth\LoginController@login');

                                    // Password Reset Routes...
                                    $this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
                                    $this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
                                    $this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
                                    $this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

                                    // Password Confirmation Routes...
                                    $this->get('password/confirm', 'Auth\ConfirmPasswordController@showConfirmForm')->name('password.confirm');
                                    $this->post('password/confirm', 'Auth\ConfirmPasswordController@confirm');

                                });

                            $this->middleware('auth:employee')
                                ->group(function() {
                                    // Logout Routes...
                                    //$this->post('logout', 'Auth\LoginController@logout')->name('admin.logout');
                                    $this->get('logout', 'Auth\LoginController@logout')->name('logout');
                                    // Dashboard Routes...
                                    $this->get('', 'DashboardController@index')->name('dashboard');

                                    $this->group(['prefix' => 'system'], function() {
                                        $this->resource('employees', 'EmployeeController')->except([
                                            'show'
                                        ]);
                                        $this->resource('roles', 'RoleController')->except([
                                            'show', 'create'
                                        ]);

                                        $this->group(['prefix' => 'setting'], function() {
                                            $this->get('site', 'SettingController@site')->name('system.setting.site');
                                            $this->put('site', 'SettingController@site_update')->name('system.setting.site.update');
                                            $this->get('service', 'SettingController@service')->name('system.setting.service');
                                            $this->put('service', 'SettingController@service_update')->name('system.setting.service.update');
                                        });
                                    });

                                    $this->group(['prefix' => 'medias'], function() {
                                        $this->get('query', 'MediaController@query')->name('media.query');
                                        $this->get('window', 'MediaController@window')->name('media.window');
                                        $this->get('manager', 'MediaController@manager')->name('media.manager');
                                        $this->post('upload', 'MediaController@upload')->name('media.upload');
                                        $this->post('folder', 'MediaController@folder')->name('media.folder');
                                        $this->put('rename/{id}', 'MediaController@rename')->name('media.rename');
                                        $this->delete('delete/{id}', 'MediaController@delete')->name('media.delete');
                                        $this->delete('deletes', 'MediaController@deletes')->name('media.deletes');
                                    });

                                    $this->group(['prefix' => 'account'], function() {
                                        $this->get('profile', 'AccountController@profile')->name('account.profile');
                                        $this->put('profile', 'AccountController@profile_update')->name('account.profile_update');
                                        $this->get('security', 'AccountController@security')->name('account.security');
                                        $this->put('security', 'AccountController@security_update')->name('account.security_update');
                                        $this->get('notify', 'AccountController@notify')->name('account.notify');
                                        $this->put('notify', 'AccountController@notify_update')->name('account.notify_update');
                                    });

                                });
                        });


                    $this->get(config('app.cast_uri'), 'CastController@index')
                        ->where('slug', '[a-z0-9-]+')
                        ->where('id', '[0-9]+')
                        ->where('time', '[0-9]{14}')
                        ->where('hash_id', '[a-z0-9]+')
                        ->where('page', config('app.cast_page_prefix') . '([0-9]+)')
                        ->name('cast');
                });

            $this->namespace('Api')
                ->middleware('api')
                ->prefix('api')
                ->name('api.')
                ->group(function() {
                    $this->post('/register', 'AuthController@register')->name('register');

                    $this->post('/login', 'AuthController@login')->name('login');

                    $this->middleware('auth:sanctum')
                        ->group(function() {
                            $this->get('/me', function(Request $request) {
                                return Auth::user();
                            });

                            $this->post('/logout', 'AuthController@@logout');
                        });
                });
        };
    }
}
