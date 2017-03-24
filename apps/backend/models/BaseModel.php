<?php
namespace Multiple\Backend\Models;
use Phalcon\Mvc\Model;
class BaseModel extends Model
{
    public static function findByName($params)
    {
        if($params == ''){
            return "Not params need find";
        }
        else{
            return parent::findByName($params);
        }
    }

    public static function findById($params)
    {
        if($params == ''){
            return "Not params need find";
        }
        else{
            return parent::findById($params);
        }
    }

    public static function findByWhere($params)
    {
        if($params == ''){
            return "Not params need find";
        }
        else{
            return parent::find($params);
        }
    }
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Category
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }
}