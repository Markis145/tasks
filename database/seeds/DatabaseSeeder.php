<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        create_primary_user();
        create_example_tasks();
        create_example_tags();
        create_example_tasks_with_tags();
        initialize_roles();
        sample_users();
        sample_logs();

        //TODO -> Com ferho en el registre
    }
}
