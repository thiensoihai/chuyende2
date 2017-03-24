<?php
namespace Multiple\Backend\Models;
use Phalcon\Mvc\Model\Validator\Email as Email;

class Admin extends \Phalcon\Mvc\Model
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
     * @Column(type="string", length=50, nullable=false)
     */
    public $username;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    public $password;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    public $fullname;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    public $email;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    public $identity_card;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $phone;

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
     * Validations and business logic
     *
     * @return boolean
     */
//    public function validation()
//    {
//        $this->validate(
//            new Email(
//                [
//                    'field'    => 'email',
//                    'required' => true,
//                ]
//            )
//        );
//
//        if ($this->validationHasFailed() == true) {
//            return false;
//        }
//
//        return true;
//    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'admin';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Admin[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Admin
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
