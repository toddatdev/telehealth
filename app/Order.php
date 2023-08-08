<?php

/**
 * Class Order.
 *
 * @category Doctry
 *
 * @package Doctry
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @link    http://www.amentotech.com
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 *
 */
class Order extends Model
{
    /**
     * Get the user that owns the order.
     * 
     * @return relation
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Order can have multiple order meta
     *
     * @return relation
     */
    public function orderMeta()
    {
        return $this->morphMany('App\OrderMeta', 'metable');
    }

    /**
     * Get the payout record associated with the order.
     * 
     * @return relation
     */
    public function payout()
    {
        return $this->hasOne('App\Payout');
    }

    /**
     * Posts can have multiple meta
     * 
     * @param string $meta_key meta_key
     *
     * @return relation
     */
    public function metaValue($meta_key)
    {
        if (!empty($meta_key)) {
            return $this->morphMany('App\OrderMeta', 'metable')->where('meta_key', $meta_key)
                ->select('id', 'meta_value')->pluck('meta_value')->first();
        }
    }
}
