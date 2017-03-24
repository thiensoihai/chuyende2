<?php
/**
 * Created by PhpStorm.
 * User: haingoc45
 * Date: 23-03-2017
 * Time: 11:16 CH
 */

namespace Multiple\Backend\Controllers;

use Phalcon\Mvc\Controller;
use Multiple\Backend\Models\Services as Services;
use Phalcon\Paginator\Adapter\Model as Paginator;

class ServiceController extends Controller
{
    /**
     * @return \Phalcon\Http\Response\Cookies|\Phalcon\Http\Response\CookiesInterface
     */
    public function indexAction()
    {
        $this->view->title = "Dashboard Services";
        $numberPage = $this->request->getQuery("page", "int");
        if($numberPage < 1){
            $numberPage = 1;
        }elseif ($numberPage > count(Services::find())){
            $numberPage = count(Services::find());
        }
        $this->assets->addCss('public/vendor/dataTables.responsive.css');

        $paginator = new Paginator(array(
            "data"  => Services::find(),
            "limit" => 5,
            "page"  => $numberPage));
        $this->view->page = $paginator->getPaginate();
    }
}