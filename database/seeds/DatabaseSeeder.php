<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*$this->call(UsersTableSeeder::class);
        $this->call(BillsTableSeeder::class);
        $this->call(TransactionsTableSeeder::class);*/
        $this->call(TagsTableSeeder::class);
    }
}
