<?php

use Illuminate\Database\Seeder;

class ClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clients=['client1','client2','client3'];
        foreach ($clients as $client){
            App\Client::create([

                ]);
        }

    }
}
