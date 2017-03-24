<?php

namespace Multiple\Backend\Models;
use Phalcon\Mvc\Model;
use Multiple\Backend\Models\BaseModel as Base;
class Category extends Base
{
    public $id;

    public $name;

    public $parent_id;

    public $create_time;

    public $update_time;

    /**
     * This model is mapped to the table sample_cars
     */
    public function getSource()
    {
        return "category";
    }

    /**
     * A car only has a Brand, but a Brand have many Cars
     */
    public function initialize()
    {
        //$this->belongsTo("brand_id", "Brands", "id");
    }
}