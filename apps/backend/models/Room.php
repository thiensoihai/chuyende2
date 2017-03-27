<?php

namespace Multiple\Backend\Models;
use Phalcon\Mvc\Model;
class Room extends Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    public $id;

    /**
     *
     * @var string
     * @Column(type="string", length=200, nullable=false)
     */
    public $name_room;

    /**
     *
     * @var string
     * @Column(type="string", length=200, nullable=false)
     */
    public $address;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $status;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $number_seat;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    public $type_room;

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'room';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Room[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Room
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
