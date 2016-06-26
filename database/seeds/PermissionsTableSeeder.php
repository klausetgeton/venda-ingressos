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
            [
        //permissions in user
                [
                'name' => 'Listar Usuário',
                'slug' => 'user.view',
                'model' => 'Usuário',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                'name' => 'Criar Usuário',
                'slug' => 'user.create',
                'model' => 'Usuário',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                'name' => 'Editar Usuário',
                'slug' => 'user.edit',
                'model' => 'Usuário',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                'name' => 'Apagar Usuário',
                'slug' => 'user.delete',
                'model' => 'Usuário',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
        //permissions in role
                [
                'name' => 'Listar Grupo',
                'slug' => 'role.view',
                'model' => 'Grupo',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                'name' => 'Criar Grupo',
                'slug' => 'role.create',
                'model' => 'Grupo',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                'name' => 'Editar Grupo',
                'slug' => 'role.edit',
                'model' => 'Grupo',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                'name' => 'Apagar Grupo',
                'slug' => 'role.delete',
                'model' => 'Grupo',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
        //permissions in permission ?!
                [
                'name' => 'Listar Permissão',
                'slug' => 'permission.view',
                'model' => 'Permissão',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                'name' => 'Criar Permissão',
                'slug' => 'permission.create',
                'model' => 'Permissão',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                'name' => 'Editar Permissão',
                'slug' => 'permission.edit',
                'model' => 'Permissão',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                'name' => 'Apagar Permissão',
                'slug' => 'permission.delete',
                'model' => 'Permissão',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
        //permissions in event
                [
                'name' => 'Listar Evento',
                'slug' => 'event.view',
                'model' => 'Evento',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                'name' => 'Criar Evento',
                'slug' => 'event.create',
                'model' => 'Evento',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                'name' => 'Editar Evento',
                'slug' => 'event.edit',
                'model' => 'Evento',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                'name' => 'Apagar Evento',
                'slug' => 'event.delete',
                'model' => 'Evento',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
        //permissions in place
                [
                'name' => 'Listar Local',
                'slug' => 'place.view',
                'model' => 'Local',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                'name' => 'Criar Local',
                'slug' => 'place.create',
                'model' => 'Local',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                'name' => 'Editar Local',
                'slug' => 'place.edit',
                'model' => 'Local',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                'name' => 'Apagar Local',
                'slug' => 'place.delete',
                'model' => 'Local',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
        //permissions in sponsor
                [
                'name' => 'Listar Patrocinador',
                'slug' => 'sponsor.view',
                'model' => 'Patrocinador',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                'name' => 'Criar Patrocinador',
                'slug' => 'sponsor.create',
                'model' => 'Patrocinador',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                'name' => 'Editar Patrocinador',
                'slug' => 'sponsor.edit',
                'model' => 'Patrocinador',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                'name' => 'Apagar Patrocinador',
                'slug' => 'sponsor.delete',
                'model' => 'Patrocinador',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                'name' => 'Listar Desconto',
                'slug' => 'discount.view',
                'model' => 'Desconto',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                'name' => 'Criar Desconto',
                'slug' => 'discount.create',
                'model' => 'Desconto',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                'name' => 'Editar Desconto',
                'slug' => 'discount.edit',
                'model' => 'Desconto',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                'name' => 'Apagar Desconto',
                'slug' => 'discount.delete',
                'model' => 'Desconto',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                'name' => 'Listar Lote',
                'slug' => 'lot.view',
                'model' => 'Lote',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                'name' => 'Criar Lote',
                'slug' => 'lot.create',
                'model' => 'Lote',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                'name' => 'Editar Lote',
                'slug' => 'lot.edit',
                'model' => 'Lote',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                'name' => 'Apagar Lote',
                'slug' => 'lot.delete',
                'model' => 'Lote',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                'name' => 'Listar Ingresso Vendido',
                'slug' => 'soldticket.view',
                'model' => 'Ingresso Vendido',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                'name' => 'Criar Ingresso Vendido',
                'slug' => 'soldticket.create',
                'model' => 'Ingresso Vendido',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                'name' => 'Editar Ingresso Vendido',
                'slug' => 'soldticket.edit',
                'model' => 'Ingresso Vendido',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                'name' => 'Apagar Ingresso Vendido',
                'slug' => 'soldticket.delete',
                'model' => 'Ingresso Vendido',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ]
            ]);
        }
}
