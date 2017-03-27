<?php
/**
 * Created by PhpStorm.
 * User: haingoc45
 * Date: 24-03-2017
 * Time: 6:14 CH
 */

namespace Multiple\Frontend\Controllers;

use Multiple\Frontend\Models\Movie as Movie;
use Multiple\Frontend\Models\MovieDescription as MovieDesc;
use Multiple\Frontend\Models\Category as Category;
use Phalcon\Di;
use Phalcon\Mvc\Model\Manager as ModelsManager;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Mvc\Controller;
use Phalcon\Paginator\Adapter\Model as Paginator;


class HomeController extends Controller
{
    public function indexAction()
    {
        $di = new Di();
        $di->set(
            "modelsManager",
            function() {
                return new ModelsManager();
            }
        );

        $sql = "SELECT c.name, m.id, m.name, m.category_id, md.id, md.description, md.image, md.price, md.adult, 
                md.premiere, md.status, md.close_date, md.actor, md.director, md.type_movie,md.movie_id, md.time, 
                md.star FROM Multiple\Frontend\Models\Movie AS m , Multiple\Frontend\Models\MovieDescription AS md, 
                Multiple\Frontend\Models\Category AS c 
                WHERE m.id = md.movie_id AND m.category_id = c.id";
        $robot = $this->modelsManager
            ->createQuery($sql);
        $sql = $robot->execute();
        // Paginator====================================================================================================
        $numberPage = $this->request->getQuery("page", "int");
        if($numberPage < 1){
            $numberPage = 1;
        }elseif ($numberPage > count($sql)){
            $numberPage = count($sql);
        }
        $this->assets->addCss('public/vendor/dataTables.responsive.css');

        $paginator = new Paginator(array(
            "data"  => $sql,
            "limit" => 6,
            "page"  => $numberPage));
        $this->view->page = $paginator->getPaginate();
        // End =========================================================================================================

    }

    public function detailAction()
    {
        $id = $this->request->getQuery('id');
        $di = new Di();
        $di->set(
            "modelsManager",
            function() {
                return new ModelsManager();
            }
        );

        $sql = "SELECT c.name as category_name, m.id, m.name, m.category_id, md.id, md.description, md.image, md.price, md.adult, 
                md.premiere, md.status, md.close_date, md.actor, md.director, md.type_movie,md.movie_id, md.time, 
                md.star FROM Multiple\Frontend\Models\Movie AS m , Multiple\Frontend\Models\MovieDescription AS md, 
                Multiple\Frontend\Models\Category AS c 
                WHERE m.id = md.movie_id AND m.category_id = c.id AND m.id = $id ";
        $robot = $this->modelsManager
            ->createQuery($sql);
        $sql = $robot->execute();
//        echo '<pre>';
//        print_r($sql);
//        $this->view->disable();
        $this->view->data = $sql;
    }
}