<?php

use Illuminate\Database\Seeder;
use Huconglobal\Helix\Models\Module;
use Huconglobal\Helix\Models\Role;
use Huconglobal\Helix\Models\Person;
use Huconglobal\Helix\Models\User;

class HelixSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $person = Person::create([
            'firstname' => 'Helix',
            'lastname'  => 'Superuser'
        ]);

        $user = $person->user()->create([
            'email'     => 'hucon@huconglobal.com',
            'password'  => \Hash::make('Eureka13'),
            'hidden'    => 1,
            'api_token' => str_random(100)
        ]);

        $role = Role::create([
            'name'   => 'superadmin',
            'title'  => 'Superadmin',
            'hidden' => 1
        ]);

        $module = Module::create([
            'name'        => 'helix',
            'title'       => 'Helix',
            'description' => 'Base Package',
            'enabled'     => 1
        ]);

        $user->roles()->attach($role);

        $module->abilities()->createMany([
            [
                'name'        => '*',
                'title'       => 'helix::pages.everything',
                'entity_type' => '*',
                'restricted'  => 1
            ],
            [
                'name'  => 'helix.manageUsersAndRoles',
                'title' => 'helix::pages.manageUsersAndRoles'
            ],
            [
                'name'  => 'helix.managePeople',
                'title' => 'helix::pages.managePeople'
            ],
            [
                'name'  => 'helix.manageEmployees',
                'title' => 'helix::pages.manageEmployees'
            ],
        ]);

        // Create menu items
        \Helix::createMenuitems([
            [
                'title'   => 'helix::pages.dashboard',
                'route'   => 'helix.dashboard',
                'icon'    => 'fas fa-tachometer-alt',
                'sorting' => 1
            ],
            [
                'title'   => 'helix::pages.people',
                'icon'    => 'fa fa-street-view',
                'active'  => 'helix/person/*',
                'sorting' => 2,
                'menuitems' => [
                    [
                        'title'   => 'helix::pages.overview',
                        'route'   => 'helix.person.index',
                        'active'  => 'helix/person/index',
                        'ability' => 'helix.managePeople',
                        'sorting' => 1
                    ],
                    [
                        'title'   => 'helix::pages.add',
                        'route'   => 'helix.person.create',
                        'active'  => 'helix/person/create',
                        'ability' => 'helix.managePeople',
                        'sorting' => 2
                    ],
                    [
                        'title'   => 'helix::pages.trash',
                        'route'   => 'helix.person.trashed',
                        'active'  => 'helix/person/trashed',
                        'ability' => 'helix.managePeople',
                        'sorting' => 3
                    ]
                ]
            ],
            [
                'title'   => 'helix::pages.usersAndRoles',
                'route'   => 'helix.users.index',
                'icon'    => 'fas fa-address-card',
                'active'  => 'helix/users/*',
                'ability' => 'helix.manageUsersAndRoles',
                'sorting' => 3
            ],
            [
                'title'       => 'helix::pages.superadmin',
                'icon'        => 'fa fa-cogs',
                'description' => 'superadmin',
                'role'        => 'superadmin',
                'sorting'     => 4,
                'menuitems'   => [
                    [
                        'title'   => 'helix::pages.tools',
                        'route'   => 'helix.superadmin.tools',
                        'role'    => 'superadmin',
                        'sorting' => 1
                    ],
                    [
                        'title'   => 'helix::pages.devices',
                        'route'   => 'helix.superadmin.device.index',
                        'active'  => 'helix/superadmin/device/*',
                        'role'    => 'superadmin',
                        'sorting' => 2
                    ]
                ]
            ]
        ], null, $module);

        // Give superadmin-role the ability to do everything
        $role->abilities()->attach(1);
        // Refresh the cache for abilities and roles
        \Bouncer::refresh();
        // Refresh cache for menuitems
        \Cache::tags('menuitems')->flush();
    }
}
