<?php
return [
    // Available Time Formats
    'time' => [
        '24hour' => [
            'format'     => 'H:i',
            'formatFull' => 'H:i:s',
            'moment'     => 'HH:mm',
            'momentFull' => 'HH:mm:ss',
            'fc'         => 'H(:mm)'
        ],
        '12hour' => [
            'format'     => 'h:i A',
            'formatFull' => 'h:i:s A',
            'moment'     => 'hh:mm A',
            'momentFull' => 'hh:mm:ss A',
            'fc'         => 'h(:mm)t'
        ]
    ],
    // Available Date Formats
    'date' => [
        'dmy' => [
            'format' => 'd/m/y',
            'moment' => 'DD/MM/YY',
            'picker' => 'dd/mm/yy',
            'short'  => 'DD/MM'
        ],
        'mdy' => [
            'format' => 'm/d/y',
            'moment' => 'MM/DD/YY',
            'picker' => 'mm/dd/yy',
            'short'  => 'MM/DD'
        ],
        'ymd' => [
            'format' => 'y/m/d',
            'moment' => 'YY/MM/DD',
            'picker' => 'yy/dd/mm',
            'short'  => 'MM/DD'
        ]
    ],
    // Metric and Imperial default settings
    'measurements' => [
        'metric' => [
            'speed' => [
                'fast'   => 'kilometres_per_hour',
                'faster' => 'metre_per_second'
            ]
        ],
        'imperial' => [
            'speed' => [
                'fast'   => 'miles_per_hour',
                'faster' => 'feet_per_second'
            ]
        ]
    ],
];
