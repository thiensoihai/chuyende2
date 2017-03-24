<?php
namespace Multiple\Backend\Models;
class Services extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $content;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $apply;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $admin_id;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $date_start;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $date_close;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $create_time;

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'services';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Services[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Services
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
