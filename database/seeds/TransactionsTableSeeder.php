<?php

use Illuminate\Database\Seeder;

class TransactionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('transactions')->insert([
            [   'bill_id' => 1,
                'income' => true,
                'amount' => 10000,
                'from' => 'Alapítvány',
                'description' => 'Ennyi támogatást kaptunk a képzés kezdetére. Mindenről kell számla!!!'
            ],
            [   'bill_id' => 1,
                'income' => false,
                'amount' => 800,
                'from' => 'AnnaKrisz ABC',
                'description' => 'Nasi a 2. képzés alkalomra'
            ],
            [   'bill_id' => 1,
                'income' => false,
                'amount' => 3500,
                'from' => 'Gipsz Jakab',
                'description' => 'Ennyit basztunk el pólókra'
            ],
            [   'bill_id' => 2,
                'income' => false,
                'amount' => 500,
                'from' => 'Adó',
                'description' => 'Lenyúlta a NAV'
            ],
        ]);
    }
}
