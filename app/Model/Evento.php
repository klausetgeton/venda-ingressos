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

    public function possibildadesCompra()
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

            return $merged;

        } catch (Exception $e)
        {
            return $e->getMessage();
        }
    }
}
