<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert(
        //permissions in user
            [
                'name' => 'Listar Usuário',
                'slug' => 'user.view',
                'model' => 'User',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        DB::table('permissions')->insert(
            [
                'name' => 'Criar Usuário',
                'slug' => 'user.create',
                'model' => 'User',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        DB::table('permissions')->insert(
            [
                'name' => 'Editar Usuário',
                'slug' => 'user.edit',
                'model' => 'User',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        DB::table('permissions')->insert(
            [
                'name' => 'Apagar Usuário',
                'slug' => 'user.delete',
                'model' => 'User',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        DB::table('permissions')->insert(
            //permissions in role
            [
                'name' => 'Listar Grupo',
                'slug' => 'role.view',
                'model' => 'Role',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        DB::table('permissions')->insert(
            [
                'name' => 'Criar Grupo',
                'slug' => 'role.create',
                'model' => 'Role',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        DB::table('permissions')->insert(
            [
                'name' => 'Editar Grupo',
                'slug' => 'role.edit',
                'model' => 'Role',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        DB::table('permissions')->insert(
            [
                'name' => 'Apagar Grupo',
                'slug' => 'role.delete',
                'model' => 'Role',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        DB::table('permissions')->insert(
            //permissions in permission ?!
            [
                'name' => 'Listar Permissão',
                'slug' => 'permission.view',
                'model' => 'Permission',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        DB::table('permissions')->insert(
            [
                'name' => 'Criar Permissão',
                'slug' => 'permission.create',
                'model' => 'Permission',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        DB::table('permissions')->insert(
            [
                'name' => 'Editar Permissão',
                'slug' => 'permission.edit',
                'model' => 'Permission',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        DB::table('permissions')->insert(
                [
                    'name' => 'Apagar Permissão',
                    'slug' => 'permission.delete',
                    'model' => 'Permission',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ]
        );

    }
}
