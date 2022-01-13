<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class Permissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permissions:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Permissions init';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $modules = config('permission.modules');

            $_permissions = [];

            foreach ($modules as $module => $permissions) {
                foreach ($permissions as $permission => $name) {
                    $_permissions[] = [
                        'name'          => "{$module}.{$permission}",
                        'guard_name'    => 'employee'
                    ];
                }
            }
            Permission::upsert($_permissions, ['name', 'guard_name']);

            $role = Role::firstOrCreate(
                ['id' => 1],
                [
                    'name'          => 'administrator',
                    'guard_name'    => 'employee'
                ]
            );
            app(PermissionRegistrar::class)->forgetCachedPermissions();
            $role->syncPermissions(collect($_permissions)->pluck('name'));

            DB::table(config('permission.table_names.model_has_roles'))->updateOrInsert([
                'role_id' => 1,
                'model_type' => 'App\Models\Employee',
                'model_id' => 1
            ]);

            $this->info('The command was successful!');
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }

        return 0;
    }
}
