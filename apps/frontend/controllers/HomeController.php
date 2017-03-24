<?php
/**
 * Created by PhpStorm.
 * User: haingoc45
 * Date: 24-03-2017
 * Time: 6:14 CH
 */

namespace Multiple\Frontend\Controllers;

use Multiple\Backend\Models\Movie as Movie;
use Multiple\Backend\Models\MovieDescription as MovieDesc;
use Multiple\Backend\Models\MovieTrailer as MovieTrailer;
use Multiple\Backend\Models\Category as Category;

use Phalcon\Mvc\Controller;
use Phalcon\Paginator\Adapter\Model as Paginator;


class HomeController extends Controller
{
    public function indexAction()
    {

    }
}