<?php

use Illuminate\Database\Seeder;

class BillsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bills')->insert([
            [   'name' => 'Képzés',
                'user_id' => 1,
                'description' => 'Képzés | Minden szart ide fogok begyűjteni'
            ],
            [   'name' => 'Megtakarítás',
                'user_id' => 1,
                'description' => 'Spórolás az új laptop/kocsi/ház trióra'
            ],
            [   'name' => 'Nyugdíj',
                'user_id' => 2,
                'description' => 'Eladósodás elleni bankbetéti nyugdíj értékpapír'
            ]
        ]);
    }
}
