<?php


return [

    'frontend_url' => env('FRONTEND_URL', 'http://localhost:8080'),

    "titles" => [
        "1" => "Mrs.",
        "2" => "Ms.",
        "3" => "Miss.",
        "4" => "Mr.",
        "5" => "Dr.",
        "6" => "Prof.",
        "7" => "Hon.",
        "8" => "Ven.",
    ],


    "permissions" => [
        "system_admin_permissions" => [
            'index_roles',

            "index_users",
            "show_user",
            "store_user",
            "update_user",
            "destroy_user",

            "index_categories",
            "show_category",
            "store_category",
            "update_category",
            "destroy_category",

            "index_products",
            "show_product",
            "store_product",
            "update_product",
            "destroy_product",
        ],
        "system_user_permissions" => [

            "index_categories",
            "index_products",

        ],

    ]
];
