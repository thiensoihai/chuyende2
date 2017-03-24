<?php

class BookTicketDescription extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    public $id_book_ticket;

    /**
     *
     * @var string
     * @Column(type="string", length=500, nullable=false)
     */
    public $name_seat;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $choose_food_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $paid_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $fullname;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
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
     * @Column(type="string", length=100, nullable=false)
     */
    public $showings;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $date_showings;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $create_time;

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'book_ticket_description';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return BookTicketDescription[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return BookTicketDescription
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
