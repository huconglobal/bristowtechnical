<?php

use Illuminate\Database\Seeder;
use Huconglobal\Helix\Models\Module;
use Huconglobal\Iap\Models\Collectiontype;

class IapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $module = Module::create([
            'name'        => 'iap',
            'title'       => 'IAP',
            'description' => 'Integrated assessment solution for simulator systems',
            'enabled'     => 1
        ]);

        $module->abilities()->createMany([
            [
                'name'  => 'iap.manageCandidates',
                'title' => 'iap::pages.manageCandidates'
            ],
            [
                'name'  => 'iap.manageFacilitators',
                'title' => 'iap::pages.manageFacilitators'
            ],
            [
                'name'  => 'iap.viewOwnReports',
                'title' => 'iap::pages.viewOwnReports'
            ],
            [
                'name'  => 'iap.viewAllReports',
                'title' => 'iap::pages.viewAllReports'
            ],
            [
                'name'  => 'iap.viewGraphs',
                'title' => 'iap::pages.viewGraphs'
            ],
            [
                'name'  => 'iap.viewFacilitatedReports',
                'title' => 'iap::pages.viewFacilitatedReports'
            ],
            [
                'name'       => 'iap.manageVersions',
                'title'      => 'iap::pages.manageVersions',
                'restricted' => 1
            ],
            [
                'name'  => 'iap.manageDocuments',
                'title' => 'iap::pages.manageDocuments'
            ],
            [
                'name'  => 'iap.manageSimulators',
                'title' => 'iap::pages.manageSimulators'
            ],
            [
                'name'  => 'iap.manageCharts',
                'title' => 'iap::pages.manageCharts'
            ],
            [
                'name'       => 'iap.useApi',
                'title'      => 'iap::pages.useApi',
                'restricted' => 1
            ],
            [
                'name'  => 'iap.manageHelicoptertypes',
                'title' => 'iap::pages.manageHelicoptertypes'
            ],
            [
                'name'  => 'iap.viewCertificateOverview',
                'title' => 'iap::pages.viewCertificateOverview'
            ],
            [
                'name'  => 'iap.approveSubsessions',
                'title' => 'iap::pages.approveSubsessions'
            ],
            [
                'name'  => 'iap.editSubmittedData',
                'title' => 'iap::pages.editSubmittedData'
            ]
        ]);

        \Helix::createMenuitems([
            [
                'title'     => 'IAP',
                'is_header' => 1,
                'sorting'   => 1
            ],
            [
                'title'     => 'iap::pages.reports',
                'icon'      => 'fa fa-file',
                'active'    => 'iap/reports/*',
                'sorting'   => 2,
                'menuitems' => [
                    [
                        'title'   => 'iap::pages.recurrent',
                        'route'   => 'iap.reports.recurrent.index',
                        'active'  => 'iap/reports/recurrent/*',
                        'ability' => 'iap.viewAllReports',
                        'sorting' => 1
                    ]
                ]
            ],
            [
                'title'     => 'helix::pages.statistics',
                'icon'      => 'fas fa-chart-bar',
                'sorting'   => 3,
                'menuitems' => [
                    [
                        'title'   => 'iap::pages.scoredistribution',
                        'route'   => 'iap.statistics.scoredistribution',
                        'ability' => 'iap.viewGraphs',
                        'sorting' => 1,
                    ],
                    [
                        'title'   => 'iap::pages.instructormeans',
                        'route'   => 'iap.statistics.facilitatormeans',
                        'ability' => 'iap.viewGraphs',
                        'sorting' => 2,
                    ],
                    [
                        'title'   => 'iap::pages.pilotperformance',
                        'route'   => 'iap.statistics.candidateperformance',
                        'ability' => 'iap.viewGraphs',
                        'sorting' => 3,
                    ]
                ]
            ],
            [
                'title'   => 'iap::pages.certificates',
                'route'   => 'iap.certificate.index',
                'icon'    => 'fa fa-certificate',
                'ability' => 'iap.viewCertificateOverview',
                'sorting' => 4,
            ],
            [
                'title'   => 'iap::pages.approvals',
                'route'   => 'iap.approval.index',
                'icon'    => 'fa fa-check',
                'ability' => 'iap.approveSubsessions',
                'sorting' => 5,
            ],
            [
                'title'     => 'helix::pages.resources',
                'active'    => 'iap/resources/*',
                'icon'      => 'fa fa-cubes',
                'sorting'   => 6,
                'menuitems' => [
                    [
                        'title'   => 'helix::pages.versions',
                        'route'   => 'iap.resources.version.index',
                        'active'  => 'iap/resources/version/*',
                        'ability' => 'iap.manageVersions',
                        'sorting' => 1
                    ],
                    [
                        'title'   => 'helix::pages.documents',
                        'route'   => 'iap.resources.document.index',
                        'active'  => 'iap/resources/document/*',
                        'ability' => 'iap.manageDocuments',
                        'sorting' => 2
                    ],
                    [
                        'title'   => 'helix::pages.charts',
                        'route'   => 'iap.resources.chart.index',
                        'active'  => 'iap/resources/chart/*',
                        'ability' => 'iap.manageCharts',
                        'sorting' => 3
                    ],
                    [
                        'title'   => 'iap::pages.simulators',
                        'route'   => 'iap.resources.simulator.index',
                        'active'  => 'iap/resources/simulator/*',
                        'ability' => 'iap.manageSimulators',
                        'sorting' => 4
                    ],
                    [
                        'title'   => 'iap::pages.helicoptertypes',
                        'route'   => 'iap.resources.helicoptertype.index',
                        'active'  => 'iap/resources/helicoptertype/*',
                        'ability' => 'iap.manageHelicoptertypes',
                        'sorting' => 5
                    ]
                ]
            ],
        ], null, $module);

        // Refresh cache for menuitems
        \Cache::tags('menuitems')->flush();

        // Insert existing 'static' data
        $this->importPresetData();
    }

    private function importPresetData()
    {
        $checktypes = [
            ['name' => 'Regular Item', 'shorthand' => 'regitem'],
            ['name' => 'Memory Item', 'shorthand' => 'memitem'],
            ['name' => 'Before Repositioning', 'shorthand' => 'repositem'],
            ['name' => 'Intermission', 'shorthand' => 'intermission'],
            ['name' => 'Generic', 'shorthand' => 'generic']
        ];

        $eventtypes = [
            ['name' => 'Normal Operations', 'shorthand' => 'normops'],
            ['name' => 'Caution', 'shorthand' => 'caution'],
            ['name' => 'Emergency', 'shorthand' => 'emergency'],
            ['name' => 'Operational Event', 'shorthand' => 'opev']
        ];

        $levels = [
            ['description' => 'Level 1', 'level' => '1'],
            ['description' => 'Level 2', 'level' => '2'],
            ['description' => 'Level 3', 'level' => '3'],
            ['description' => 'Level 4', 'level' => '4'],
            ['description' => 'Level 5', 'level' => '5'],
            ['description' => 'Level 6', 'level' => '6']
        ];

        \Huconglobal\Iap\Models\Collectiontype::create([
            'name' => 'OPC',
            'shorthand' =>  'opc'
        ]);

        foreach ($checktypes as $checktype) {
            \Huconglobal\Iap\Models\Checktype::create($checktype);
        }

        foreach ($eventtypes as $eventtype) {
            \Huconglobal\Iap\Models\Eventtype::create($eventtype);
        }

        foreach ($levels as $level) {
            \Huconglobal\Iap\Models\Level::create($level);
        }
    }
}
