<?php
namespace Multiple\Backend\Models;
class Users extends \Phalcon\Mvc\Model
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
     * @var integer
     * @Column(type="integer", length=100, nullable=false)
     */

    public $username;

    public $password;

    public $email;

    public $fullname;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    public $identity_card;

    /**
     *
     * @var string
     * @Column(type="string", length=200, nullable=false)
     */
    public $address;

    /**
     *
     * @var integer
     * @Column(type="integer", length=12, nullable=false)
     */
    public $number_code;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $number_star;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $birthday;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $create_time;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $update_time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $level;

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'users';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Users[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Users
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
