
<?php

$routes = [];

if( config( 'app.shop_multishop' ) || config( 'app.shop_registration' ) ) {
    $routes = ['routes' => [
        'admin' => ['prefix' => 'admin', 'middleware' => ['web', 'verified']],
        'jqadm' => ['prefix' => 'admin/{site}/jqadm', 'middleware' => ['web', 'auth', 'verified']],
        'jsonadm' => ['prefix' => 'admin/{site}/jsonadm', 'middleware' => ['web', 'auth', 'verified']],
        'jsonapi' => ['prefix' => 'jsonapi/{site}', 'middleware' => ['web', 'api']],
        'account' => ['prefix' => 'profile/{site}', 'middleware' => ['web', 'auth']],
        'supplier' => ['prefix' => 'supplier/{site}', 'middleware' => ['web']],
        'default' => ['prefix' => 'shop/{site}', 'middleware' => ['web']],
        'update' => ['prefix' => '{site}'],
    ] ];
}


return $routes + [

        'apc_enabled' => false, // enable for maximum performance if APCu is availalbe
        'apc_prefix' => 'aimeos:', // prefix for caching config and translation in APCu
        'pcntl_max' => 4, // maximum number of parallel command line processes when starting jobs

        'routes' => [
            'account' => ['prefix' => '{locale}/myaccount', 'middleware' => ['web', 'auth']],
            'default' => ['prefix' => '{locale}/shop', 'middleware' => ['web']],
        ],


        'page' => [
            // Docs: https://aimeos.org/docs/Laravel/Adapt_pages
            // Hint: catalog/filter is also available as single 'catalog/tree', 'catalog/search', 'catalog/attribute'
            'account-index' => ['test/customized', 'locale/select'],
            'basket-index' => [ 'basket/bulk', 'basket/standard','basket/related', 'locale/select' ],
            'catalog-count' => [ 'catalog/count' ],
            'catalog-detail' => [ 'basket/mini','catalog/stage','catalog/detail','catalog/session','locale/select' ],
            'catalog-home' => [ 'basket/mini','catalog/home','locale/select','cms/page', 'basket/customized', 'test/customized'],
            'catalog-list' => [ 'basket/mini','catalog/filter','catalog/lists','locale/select' ],
            'catalog-stock' => [ 'catalog/stock' ],
            'catalog-suggest' => [ 'catalog/suggest' ],
            'catalog-tree' => [ 'basket/mini','catalog/filter','catalog/stage','catalog/lists','locale/select' ],
            'checkout-confirm' => [ 'checkout/confirm' ],
            'checkout-index' => [ 'checkout/standard' ],
            'checkout-update' => [ 'checkout/update' ],
            'customized' => [ 'test/customized' ],
        ],


        'resource' => [
            'db' => [
                'adapter' => 'pgsql',
                'host' => '127.0.0.1',
                'port' => '5432',
                'database' => 'myshop',
                'username' => 'city5user',
                'password' => 'secret',
                'stmt' => [],
            ],
        ],


        'admin' => [],

        'client' => [
            'html' => [
                'locale' => [
                    'select' => [
                        'currency' => [
                            'param-name' => 'currency',
                        ],
                        'language' => [
                            'param-name' => 'locale',
                        ],
                    ],
                ],
                'basket' => [
                    'cache' => [
                        // 'enable' => false, // Disable basket content caching for development
                    ],
                ],
                'common' => [
                    'template' => [
                        // 'baseurl' => 'packages/aimeos/shop/themes/elegance',
                    ],
                ],
                'catalog' => [
                    'selection' => [
                        'type' => [
                            'color' => 'radio',
                            'length' => 'radio',
                            'width' => 'radio',
                        ],
                    ],
                ],
            ],
        ],

        'controller' => [
        ],

        'i18n' => [
        ],

        'madmin' => [
            'cache' => [
                'manager' => [
                    'name' => 'None',
                ],
            ],
            'log' => [
                'manager' => [
                    'standard' => [
                        'loglevel' => 7,
                    ],
                ],
            ],
        ],

        'mshop' => [
        ],


        'command' => [
        ],

        'frontend' => [
        ],

        'backend' => [
        ],

    ];
