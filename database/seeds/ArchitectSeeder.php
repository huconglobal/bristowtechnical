<?php

use Illuminate\Database\Seeder;
use Huconglobal\Helix\Models\Module;

class ArchitectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $module = Module::create([
            'name'        => 'arch',
            'title'       => 'Architect',
            'description' => 'Authoring system for entities in IAP',
            'enabled'     => 1
        ]);

        $module->abilities()->createMany([
            [
                'name'       => 'arch.read',
                'title'      => 'arch::pages.readAbility',
                'restricted' => 0
            ],
            [
                'name'       => 'arch.write',
                'title'      => 'arch::pages.writeAbility',
                'restricted' => 1
            ],
            [
                'name'       => 'arch.publish',
                'title'      => 'arch::pages.publishAbility',
                'restricted' => 1
            ],
        ]);

        // Find the IAP module record
        $iapmodule = \Huconglobal\Helix\Models\Module::where('name', 'iap')
            ->with(['menuitems' => function ($query) {
                // Eager load IAP's menuitems ordered by sorting desc
                $query->orderBy('sorting', 'desc');
            }])->first();

        // Create an Architect menuitem associated with the IAP-module
        $architem = $iapmodule->menuitems()->create([
            'title'   => 'Architect',
            'icon'    => 'icon icon-architect',
            'active'  => 'arch/*',
            'sorting' => $iapmodule->menuitems->first()->sorting + 1
        ]);

        \Helix::createMenuitems([
            [
                'title'   => 'arch::pages.collections',
                'route'   => 'arch.collection.index',
                'active'  => 'arch/collection/*',
                'ability' => 'arch.read',
                'sorting' => 1
            ],
            [
                'title'   => 'arch::pages.sessions',
                'route'   => 'arch.session.index',
                'active'  => 'arch/session/*',
                'ability' => 'arch.read',
                'sorting' => 2
            ],
            [
                'title'   => 'arch::pages.blocks',
                'route'   => 'arch.block.index',
                'active'  => 'arch/block/*',
                'ability' => 'arch.read',
                'sorting' => 3
            ],
            [
                'title'   => 'arch::pages.events',
                'route'   => 'arch.event.index',
                'active'  => 'arch/event/*',
                'ability' => 'arch.read',
                'sorting' => 4
            ],
            [
                'title'   => 'arch::pages.checklists',
                'route'   => 'arch.checklist.index',
                'active'  => 'arch/checklist/*',
                'ability' => 'arch.read',
                'sorting' => 5
            ],
            [
                'title'   => 'arch::pages.collectionitemsets',
                'route'   => 'arch.collectionitemset.index',
                'active'  => 'arch/collectionitemset/*',
                'ability' => 'arch.read',
                'sorting' => 6
            ],
            [
                'title'   => 'arch::pages.sessionitemsets',
                'route'   => 'arch.sessionitemset.index',
                'active'  => 'arch/sessionitemset/*',
                'ability' => 'arch.read',
                'sorting' => 7
            ]
        ], $architem, $module);

        // Refresh cache for menuitems
        \Cache::tags('menuitems')->flush();
    }
}
