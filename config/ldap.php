<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default LDAP Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the LDAP connections below you wish
    | to use as your default connection for all LDAP operations. Of
    | course you may add as many connections you'd like below.
    |
    */

    'default' => env('LDAP_CONNECTION', 'default'),

    /*
    |--------------------------------------------------------------------------
    | LDAP Connections
    |--------------------------------------------------------------------------
    |
    | Below you may configure each LDAP connection your application requires
    | access to. Be sure to include a valid base DN - otherwise you may
    | not receive any results when performing LDAP search operations.
    |


    Tester in controller:
    /*
        $_ds = null;
        $_ldap = null;

    		$_ds = ldap_connect("DEFTHW99A11ADS.ww930.my-it-solutions.net:636");
			ldap_set_option($_ds, LDAP_OPT_PROTOCOL_VERSION, 3);
			ldap_set_option($_ds, LDAP_OPT_REFERRALS, 0);
			ldap_set_option($_ds, LDAP_OPT_DEBUG_LEVEL, 7); 
		
			$dom_pass =  ("ww930\\A608553"); // add the "\" to complete username
			$_ldap = ldap_bind($_ds, $dom_pass, 'sCHt04uus3ci!' ); //bind the connection

            $auth_log = @ldap_bind($_ds,'ww930\\A608553','sCHt04uus3ci!');

            $ldap_filter = '(samaccountname=A608553)';
            $ldap_search = ldap_search($_ds,'DC=ww930,DC=my-it-solutions,DC=net',$ldap_filter);
            $ldap_result = ldap_count_entries($_ds, $ldap_search);
			$entries = ldap_get_entries($_ds, $ldap_search);

		    ldap_close($_ds); 
        DD($entries);
    */
    

    'connections' => [

        'default' => [
            'hosts' => [env('LDAP_HOST', '127.0.0.1')],
            'username' => env('LDAP_USERNAME', 'cn=user,dc=local,dc=com'),
            'password' => env('LDAP_PASSWORD', 'secret'),
            'port' => env('LDAP_PORT', 389),
            'base_dn' => env('LDAP_BASE_DN', 'dc=local,dc=com'),
            'timeout' => env('LDAP_TIMEOUT', 5),
            'use_tls' => env('LDAP_TLS', false),
            'use_starttls' => env('LDAP_STARTTLS', false),
            'use_sasl' => env('LDAP_SASL', false),
            'sasl_options' => [
                // 'mech' => 'GSSAPI',
            ],
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | LDAP Logging
    |--------------------------------------------------------------------------
    |
    | When LDAP logging is enabled, all LDAP search and authentication
    | operations are logged using the default application logging
    | driver. This can assist in debugging issues and more.
    |
    */

    'logging' => [
        'enabled' => env('LDAP_LOGGING', true),
        'channel' => env('LOG_CHANNEL', 'stack'),
        'level' => env('LOG_LEVEL', 'info'),
    ],

    /*
    |--------------------------------------------------------------------------
    | LDAP Cache
    |--------------------------------------------------------------------------
    |
    | LDAP caching enables the ability of caching search results using the
    | query builder. This is great for running expensive operations that
    | may take many seconds to complete, such as a pagination request.
    |
    */

    'cache' => [
        'enabled' => env('LDAP_CACHE', false),
        'driver' => env('CACHE_DRIVER', 'file'),
    ],

];
