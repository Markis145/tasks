<?php

return [

    /*
    |--------------------------------------------------------------------------
    | MANAGER EMAIL
    |--------------------------------------------------------------------------
    |
    | Bla bla bla
    |
    */
    'manager_email' => env('TASKS_MANAGER_EMAIL', 'tasksmanager@miempresa.com'),

    'admin_user_email' => env('ADMIN_USER_EMAIL','marcmestre@iesebre.com'),
    'admin_user_name' => env('ADMIN_USER_NAME','Marc Mestre Algueró'),
    'admin_user_password' => env('ADMIN_USER_PASSWORD','7c4a8d09ca3762af61e59520943dc26494f8941b'),
    'admin_user_mobile' => env('ADMIN_USER_MOBILE'),
    'sergi_user_mobile' => env('SERGI_USER_MOBILE'),
    'admin_user_name_on_tasks' => env('ADMIN_USER_NAME_ON_TASKS','Marc Mestre Algueró'),
    'admin_user_email_on_tasks' => env('ADMIN_USER_EMAIL_ON_TASKS','marcmestre@iesebre.com'),
    'admin_username_password_on_tasks' => env('ADMIN_USER_PASSWORD_ON_TASKS','7c4a8d09ca3762af61e59520943dc26494f8941b'),

    'salt' => env('TASKS_SALT')
];
