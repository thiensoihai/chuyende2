<?php
namespace Multiple\Backend\Models;
class MovieDescription extends \Phalcon\Mvc\Model
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
     * @Column(type="string", nullable=false)
     */
    public $description;

    /**
     *
     * @var string
     * @Column(type="string", length=200, nullable=false)
     */
    public $image;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=false)
     */
    public $price;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $adult;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $premiere;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $id_room;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $status;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $close_date;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $actor;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    public $director;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    public $type_movie;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $movie_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $star;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $id_feedback;

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'movie_description';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return MovieDescription[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return MovieDescription
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
