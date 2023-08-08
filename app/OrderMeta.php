<?php

/**
 * Class OrderMeta.
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
 * Class OrderMeta
 *
 */
class OrderMeta extends Model
{
    /**
     * Get all of the owning metable models.
     * 
     * @return relation
     */
    public function metable()
    {
        return $this->morphTo();
    }
}
