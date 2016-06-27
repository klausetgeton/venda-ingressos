<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PermissionsTableSeeder2 extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        DB::table('permissions')->insert(
            [
        //permissions in Auditing
                [
                'name' => 'Listar Auditoria',
                'slug' => 'audit.view',
                'model' => 'Auditoria',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ]
            ]);
        }
}
