<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class Evento extends AuditedObject
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'eventos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['descricao', 'data', 'hora', 'nome', 'locais_id', 'valor_masculino', 'valor_feminino', 'completo'];

   /**
    * Get the lotes for the evento
    */
    public function lotes()
    {
        return $this->hasMany('App\Model\Lote', 'eventos_id');
    }

    /**
    * Get the patrocinadores for the evento
    */
    public function patrocinadores()
    {
        return $this->hasMany('App\Model\Patrocinador', 'eventos_id');
    }

    /**
    * Get the descontos for the evento
    */
    public function descontos()
    {
        return $this->hasMany('App\Model\Desconto', 'eventos_id');
    }

   /**
    * Get the local associated with the evento.
    */
    public function local()
    {
        return $this->belongsTo('App\Model\Local', 'locais_id');
    }
   /**
    * Get the administradores for the evento
    */
    public function administradores()
    {
        return $this->belongsToMany('App\Model\User', 'administradores_evento');
    }

    public function delete()
    {
        // delete all related objects
        $this->descontos()->delete();
        $this->patrocinadores()->delete();
        $this->lotes()->delete();

        // delete the user
        return parent::delete();
    }

    /**
    * Get the lotes for the evento
    */
    public function availableLotes()
    {
        $today = date("H:i:s");

        //havent been totaly sold
        $lotes = $this->lotes()->where('quantidade', '>', 0);

        if(isset($lotes))
        {
            $lotes = $lotes->where('data_inicio', '>=', $today);
        }else
        {
        }
    }

    public function possibilidadesCompra()
    {
        try
        {
            //all lotes from this event
            $lotes = Lote::select('id')->where('eventos_id', $this->id)->get();

            //sold tickets from all lotes in this event
            $vendidos = IngressoVendido::select('possibilidades_compra_id')->whereIn('lotes_id', $lotes)->get();

            //places sold of this event
            $pcs = PossibilidadeCompra::whereIn('id', $vendidos)->get();

            //sol itens are now disponivel = false;
            $pc_vendidas = array();
            foreach ($pcs as $pc)
            {
                $pc->disponivel = false;
                $pc_vendidas[] = $pc;
            }

            //all the possibilities from event, sold or not sold
            //disponivel means that the user can buy. When you update a place and reduce the capacity,
            //the places where you remove are marked as disponivel = false, because we cant remove a place that was sold in another event after
            $pc_disponiveis = $this->local->possibilidades_compra->where('disponivel', true);

            //merge the sold places and the available places
            $merged = $pc_disponiveis->merge($pc_vendidas, $pc_disponiveis);

            //order by name
            $merged = $merged->sortBy('nome');

            $organized = array();

            $currentLocation = null;

            foreach ($merged as $pp)
            {
                // Para usar no node e facilitar a comparacao
                // CARON, ALTEREI AQUI
                // Esse aqui é gambs, nao vou conseguir alterar agora
                $pp->posicao = $pp->nome;
                // O boolean apenas nao me serve, para frente utilizo mais status.
                $pp->situacao = ($pp->disponivel ? 'livre' : 'reservado');

                if($currentLocation == null)
                {
                    $currentLocation = preg_replace('/[0-9]+/', '', $pp->nome);
                }

                if($currentLocation == preg_replace('/[0-9]+/', '', $pp->nome))
                {
                    $organized[$currentLocation][] = $pp;
                }
                else
                {
                    $currentLocation = preg_replace('/[0-9]+/', '', $pp->nome);
                    $organized[$currentLocation][] = $pp;
                }
            }


         //   dd($organized);

            $novoOrganized = [];


            foreach ($organized as $fileiraDesc => $acentos)
            {
                $fileira =  new \stdClass();
                $fileira->descricao = $fileiraDesc;
                $fileira->acentos = $acentos;

                $novoOrganized[] = $fileira;
            }


            // CARON, ALTEREI AQUI
            // Antes estava com array dentro de array, como é especifico de 1 evento apenas removi o outro nivel
            $event = $this->toArray();
            $event['lotes'] = $this->lotes;
            $event['local']['possibilidades_compra'] = '';
            $event['fileiras'] = $novoOrganized;

            return $event;

        } catch (Exception $e)
        {
            return $e->getMessage();
        }
    }
}
