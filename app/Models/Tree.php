<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tree extends Model
{
    /**
     * Get the index name for the model.
     *
     * @return string
     */
    public function childs() {
        return $this->hasMany('App\Models\Tree','pef_item_id','id') ;
    }

    /**
     * Get the index name for the model.
     *
     * @return string
     */
    public function parents() {
        return $this->hasMany('App\Models\Tree','id', 'pef_item_id') ;
    }
}
