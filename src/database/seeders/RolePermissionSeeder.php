<?php

namespace Database\Seeders;

use App\Models\Permission as ModelsPermission;
use App\Models\Role as ModelsRole;
use App\Models\User;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Permissions
        |--------------------------------------------------------------------------
        */

        $permissions = [
            'dashboard.view',

            'participant.view',
            'participant.create',
            'participant.update',
            'participant.delete',

            'competition.view',
            'competition.create',
            'competition.update',
            'competition.delete',

            'category.view',
            'category.create',
            'category.update',
            'category.delete',

            'match.view',
            'match.create',
            'match.update',
            'match.delete',

            'scoring.view',
            'scoring.create',
            'scoring.update',

            'result.view',

            'user.view',
            'user.create',
            'user.update',
            'user.delete',
        ];

        foreach ($permissions as $permission) {
            ModelsPermission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Master
        |--------------------------------------------------------------------------
        */

        $master = ModelsRole::firstOrCreate([
            'name' => 'master',
            'guard_name' => 'web',
        ]);

        $master->syncPermissions(
            ModelsPermission::all()
        );

        /*
        |--------------------------------------------------------------------------
        | Admin
        |--------------------------------------------------------------------------
        */

        $admin = ModelsRole::firstOrCreate([
            'name' => 'admin',
            'guard_name' => 'web',
        ]);

        $admin->syncPermissions([
            'dashboard.view',

            'participant.view',
            'participant.create',
            'participant.update',
            'participant.delete',

            'competition.view',
            'competition.create',
            'competition.update',
            'competition.delete',

            'category.view',
            'category.create',
            'category.update',
            'category.delete',

            'match.view',
            'match.create',
            'match.update',
            'match.delete',

            'scoring.view',
            'scoring.create',
            'scoring.update',

            'result.view',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Assign Role ke User
        |--------------------------------------------------------------------------
        */

        $deswita = User::where('email', 'admin@test.com')->first();
        $deswita?->assignRole('master');

        $administrator = User::where('email', 'admin@gmail.com')->first();
        $administrator?->assignRole('admin');
    }
}