<?php

use App\Tag;
use App\Task;
use App\User;
use Illuminate\Support\Facades\DB;

if (!function_exists('create_primary_user')) {
    function create_primary_user() {
        $user = User::where('email', 'marcmestre@iesebre.com')->first();
        if (!$user) {
            User::firstOrCreate([
                'name' => 'Marc Mestre Alguero',
                'email' => 'marcmestre@iesebre.com',
                'password' => bcrypt(env('PRIMARY_USER_PASSWORD','123456'))
            ]);
        }
    }
}


if (!function_exists('create_example_tasks')) {
    function create_example_tasks() {
        Task::create([
            'name' => 'comprar pa',
            'completed' => false
        ]);
        Task::create([
            'name' => 'comprar llet',
            'completed' => false
        ]);
        Task::create([
            'name' => 'Estudiar PHP',
            'completed' => true
        ]);
    }
}

if (!function_exists('create_example_tags')) {
    function create_example_tags() {
        Tag::create([
            'name' => 'feina',
            'description' => 'blafeina',
            'color' => '#04B404'
        ]);
        Tag::create([
            'name' => 'classe',
            'description' => 'blaclasse',
            'color' => '#04B100'
        ]);
        Tag::create([
            'name' => 'casa',
            'description' => 'blacasa',
            'color' => '#02C404'
        ]);
    }
}

if (!function_exists('create_mysql_database')) {
    function create_mysql_database($name){
        //PDO
        //MYSQL: CREATE DATABASE IF NOT EXISTS $name
        $statement = "CREATE DATABASE IF NOT EXISTS $name";
        DB::connection('mysqlroot')->getPdo()->exec($statement);
    }
}