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
        
        'it.chsravanthi@gmail.com'  => [
            'username'     => 'it.chsravanthi@gmail.com',
            'pass'     => 'u@siPort@l',
            'from_name'     => 'Admin',
        ],
		'default' =>
		  [
			'pass'            => 'Admin@24',
			'username'        => 'tsuesi.it@gmail.com',
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
