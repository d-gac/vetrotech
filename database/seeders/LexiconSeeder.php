<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class LexiconSeeder extends Seeder
{
    //php artisan db:seed --class=LexiconSeeder
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lexicons')->insert([
            'name' => 'Wewnętrzne',
            'type' => 'dimensions',
            'code_id' => 0,
            'status' => 1
        ]);
        DB::table('lexicons')->insert([
            'name' => 'Zewnętrzne',
            'type' => 'dimensions',
            'code_id' => 1,
            'status' => 1
        ]);
        DB::table('lexicons')->insert([
            'name' => '33.1 mleczne',
            'type' => 'typeOfGlass',
            'code_id' => 0,
            'status' => 1
        ]);
        DB::table('lexicons')->insert([
            'name' => '44.2 mleczna',
            'type' => 'typeOfGlass',
            'code_id' => 1,
            'status' => 1
        ]);
        DB::table('lexicons')->insert([
            'name' => 'antisol',
            'type' => 'typeOfGlass',
            'code_id' => 2,
            'status' => 1
        ]);
        DB::table('lexicons')->insert([
            'name' => 'lustro weneckie',
            'type' => 'typeOfGlass',
            'code_id' => 3,
            'status' => 1
        ]);
        DB::table('lexicons')->insert([
            'name' => 'P2/float',
            'type' => 'typeOfGlass',
            'code_id' => 4,
            'status' => 1
        ]);
        DB::table('lexicons')->insert([
            'name' => 'refleks',
            'type' => 'typeOfGlass',
            'code_id' => 5,
            'status' => 1
        ]);
        DB::table('lexicons')->insert([
            'name' => 'duplex',
            'type' => 'nameOfGlass',
            'code_id' => 0,
            'status' => 1
        ]);
        DB::table('lexicons')->insert([
            'name' => 'Ernesto',
            'type' => 'nameOfGlass',
            'code_id' => 1,
            'status' => 1
        ]);
        DB::table('lexicons')->insert([
            'name' => 'naświetle boczne',
            'type' => 'nameOfGlass',
            'code_id' => 2,
            'status' => 1
        ]);
        DB::table('lexicons')->insert([
            'name' => 'szlif',
            'type' => 'nameOfGlass',
            'code_id' => 3,
            'status' => 1
        ]);
        DB::table('lexicons')->insert([
            'name' => 'Dział Nr 1',
            'type' => 'numberDepartment',
            'code_id' => 0,
            'status' => 1
        ]);
        DB::table('lexicons')->insert([
            'name' => 'Dział Nr 2',
            'type' => 'numberDepartment',
            'code_id' => 1,
            'status' => 1
        ]);
        DB::table('lexicons')->insert([
            'name' => 'Osoba fizyczna',
            'type' => 'contractorType',
            'code_id' => 0,
            'status' => 1
        ]);
        DB::table('lexicons')->insert([
            'name' => 'Osoba prawna',
            'type' => 'contractorType',
            'code_id' => 1,
            'status' => 1
        ]);
    }
}
