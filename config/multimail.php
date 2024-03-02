<?php

return [
    /*
    |--------------------------------------------------------------------------
    | List your email providers
    |--------------------------------------------------------------------------
    |
    | Enjoy a life with multimail
    |
    */
    'use_default_mail_facade_in_tests' => true,

    'emails'  => [
        'acknowledgements@zastaindia.com' => [
            'pass'          => 'Qe5zRX3z',
            'username'      => 'acknowledgements@zastaindia.com',
            'from_name'     => 'Acknowledgements',
        ],
        'praveen@zastaindia.com'  => [
            'username'     => 'praveen@zastaindia.com',
            'pass'     => 'G8hush@n',
            'from_name'     => 'Praveen',
        ],
		'default' =>
		  [
			'pass'            => 'Qe5zRX3z',
			'username'        => 'acknowledgements@zastaindia.com',
		  ]
    ],

    'provider' => [
        'default' => [
            'host'      => 'smtp.office365.com',
            'port'      => 587,
            'encryption' => 'tls',
        ],
    ],

];
