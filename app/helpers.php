<?php

use App\Tag;
use App\Task;
use App\User;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Exceptions\PermissionDoesNotExist;
use Spatie\Permission\Exceptions\RoleAlreadyExists;
use Spatie\Permission\Exceptions\RoleDoesNotExist;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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
            'completed' => false,
            'description' => 'anar al spar a comprarlo',
            'user_id' => 1
        ]);
        Task::create([
            'name' => 'comprar llet',
            'completed' => false,
            'description' => 'anar al spar a comprarla',
            'user_id' => 1
        ]);
        Task::create([
            'name' => 'Estudiar PHP',
            'completed' => true,
            'description' => 'a caseta de chill',
            'user_id' => 1
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

if (!function_exists('drop_mysql_database')) {
    function drop_mysql_database($name){
        //PDO
        //MYSQL: CREATE DATABASE IF NOT EXISTS $name
        $statement = "DROP DATABASE IF NOT EXISTS $name";
        DB::connection('mysqlroot')->getPdo()->exec($statement);
    }
}

if (!function_exists('create_mysql_user')) {
    function create_mysql_user($name, $password = null, $host = 'localhost'){
        if(!$password) $password = str_random();
        $statement = "CREATE USER IF NOT EXISTS {$name}@{$host}";
        DB::connection('mysqlroot')->getPdo()->exec($statement);
        $statement = "ALTER USER '{$name}'@'{$host}' IDENTIFIED BY '{$password}'";
        DB::connection('mysqlroot')->getPdo()->exec($statement);
        return $password;
    }
}

if (!function_exists('grant_mysql_privileges')) {
    function grant_mysql_privileges($user,$database,$host = 'localhost')
    {
        $statement = "GRANT ALL PRIVILEGES ON {$database}.* TO '{$user}'@'{$host}' WITH GRANT OPTION";
        DB::connection('mysqlroot')->getPdo()->exec($statement);
        $statement = "FLUSH PRIVILEGES";
        DB::connection('mysqlroot')->getPdo()->exec($statement);
    }
}

if (!function_exists('create_database')) {
    function create_database()
    {
        create_mysql_database(env('DB_DATABASE'));
        create_mysql_user(env('DB_USERNAME'),env('DB_PASSWORD'));
        grant_mysql_privileges(env('DB_USERNAME'),env('DB_DATABASE'));
    }
}

if (!function_exists('initialize_roles')) {
    function initialize_roles() {
        // Crear rols
        try {
            $taskManager = Role::create([
                'name' => 'TaskManager'
            ]);

            $tasks = Role::create([
                'name' => 'Tasks'
            ]);
        } catch(Exception $e) {

        }

        try {
            Permission::create([
                'name' => 'tasks.index'
            ]);

            Permission::create([
                'name' => 'tasks.show'
            ]);

            Permission::create([
                'name' => 'tasks.store'
            ]);

            Permission::create([
                'name' => 'tasks.update'
            ]);

            Permission::create([
                'name' => 'tasks.complete'
            ]);

            Permission::create([
                'name' => 'tasks.uncomplete'
            ]);

            Permission::create([
                'name' => 'tasks.destroy'
            ]);
        } catch(Exception $e) {

        }

        try {
            $taskManager->givePermissionTo('tasks.index');
            $taskManager->givePermissionTo('tasks.show');
            $taskManager->givePermissionTo('tasks.store');
            $taskManager->givePermissionTo('tasks.update');
            $taskManager->givePermissionTo('tasks.complete');
            $taskManager->givePermissionTo('tasks.uncomplete');
            $taskManager->givePermissionTo('tasks.destroy');
        } catch(Exception $e){

        }

        try {
            Permission::create([
                'name' => 'user.tasks.index'
            ]);

            Permission::create([
                'name' => 'user.tasks.show'
            ]);

            Permission::create([
                'name' => 'user.tasks.store'
            ]);

            Permission::create([
                'name' => 'user.tasks.update'
            ]);

            Permission::create([
                'name' => 'user.tasks.complete'
            ]);

            Permission::create([
                'name' => 'user.tasks.uncomplete'
            ]);

            Permission::create([
                'name' => 'user.tasks.destroy'
            ]);
        } catch(Exception $e) {

        }

        try {
            $tasks->givePermissionTo('user.tasks.index');
            $tasks->givePermissionTo('user.tasks.show');
            $tasks->givePermissionTo('user.tasks.store');
            $tasks->givePermissionTo('user.tasks.update');
            $tasks->givePermissionTo('user.tasks.complete');
            $tasks->givePermissionTo('user.tasks.uncomplete');
            $tasks->givePermissionTo('user.tasks.destroy');
        } catch(Exception $e) {

        }
    }
}

if (!function_exists('sample_users')) {
    function sample_users()
    {
        //superadmin no cal -> jo mateix

        try {
            factory(User::class)->create([
                'name' => 'Pepe Pringao',
                'email' => 'pepepringao@hotmail.com'
            ]);
        } catch (exception $e) {

        }

        try {
            $bartsimpson = factory(User::class)->create([
                'name' => 'Bart Simpson',
                'email' => 'bartsimpson@hotmail.com'
            ]);
        } catch (exception $e) {

        }

        try {
            $bartsimpson->assignRole('Tasks');
        } catch (exception $e) {

        }

        try {
            $homersimpson = factory(User::class)->create([
                'name' => 'Homer Simpson',
                'email' => 'homersimpson@hotmail.com'
            ]);
        } catch (exception $e) {

        }

        try {
            $homersimpson->assignRole('TaskManager');
        } catch (exception $e) {

        }

        try {
            $sergitur = factory(User::class)->create([
                'name' => 'Sergi Tur',
                'email' => 'sergiturbadenas@gmail.com',
                'password' => 'secret'
            ]);
        } catch (exception $e) {

        }

        try {
            $sergitur->assignRole('TaskManager');
        } catch (exception $e) {

        }
    }
};

// TODO: crear multiples usuaris amb diferents rols
// TODO: Com gestionar el superadmin
