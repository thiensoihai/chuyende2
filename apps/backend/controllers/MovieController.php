<?php

namespace Multiple\Backend\Controllers;


use Phalcon\Mvc\Controller;
use Multiple\Backend\Models\Movie as Movie;
use Phalcon\Paginator\Adapter\Model as Paginator;
use Multiple\Backend\Models\Category as Category;
use Multiple\Backend\Models\MovieDescription as MovieDescription;
class MovieController extends Controller
{
    public function indexAction()
    {
        $this->view->catalog = Category::find();
        $this->view->status = MovieDescription::find();
        $this->view->title = "Dashboard Movie";
        $numberPage = $this->request->getQuery("page", "int");
        if($numberPage < 1){
            $numberPage = 1;
        }elseif ($numberPage > count(Movie::find())){
            $numberPage = count(Movie::find());
        }
        $this->assets->addCss('public/vendor/dataTables.responsive.css');

        $paginator = new Paginator(array(
            "data"  => Movie::find(),
            "limit" => 20,
            "page"  => $numberPage));
        $this->view->page = $paginator->getPaginate();

    }
    
    public function noticeAction()
    {
        $errorNotice = [
                "catalog_id"    => "Catalog Id not null. Shall you choose catalog title diffence Choose Catalog ID",
                "adult"         => "Adult Id not null. Shall you choose Adult title diffence Choose Adult",
                "premiere"      => [
                    "less_now"  => "Premiere not less than now",
                    "more_now"  => "Premiere not more than now"
                ],
                "close"         => [
                    "equal_now" => "Close_date not equal now",
                    "less_now"  => "Close_date not less than now"
                ],
                "time"          => [
                    "less_60"   => "Time not less than 60 minutes",
                    "than_120"  => "Time not more than 120 minutes",
                ]
            ];
    }

    public function newAction()
    {
        $this->view->title = "New Items Movie";
        $this->view->catalog = Category::find();

        $now = new \DateTime();
        if($this->request->isPost()){
            $mov = new Movie();

            
            $mov->name = $this->request->getPost('name');
            $mov->category_id =$this->request->getPost('category_id') ;
            $mov->create_time = $now->format('Y-m-d');
            $mov->update_time = $now->format('Y-m-d');

            

            if($mov->save()){
                
                if($this->request->hasFiles()){
                    $files=$this->request->getUploadedFiles();
                    foreach ($files as $file) {
                        $file_Name = $file->getName();
                        $file->moveTo(BASE_PATH.'/images/movies/'.$file->getName());    
                    }
                }
                $movdes = new MovieDescription();
                $movdes->description    = $this->request->getPost("description");
                $movdes->image          = $file_Name;
                $movdes->price          = $this->request->getPost("price");
                $movdes->adult          = $this->request->getPost("adults");
                $movdes->premiere       = $this->request->getPost("premiere");
                $movdes->status         = 0;
                $movdes->close_date     = $this->request->getPost("close_date");
                $movdes->actor          = $this->request->getPost("actor");
                $movdes->director       = $this->request->getPost("director");
                $movdes->type_movie     = $this->request->getPost("type_movie");
                $movdes->movie_id       = $mov->id;
                $movdes->time           = $this->request->getPost("time");
                $movdes->star           = 1;
                if($movdes->save() == false){

                    $messmovies = $movdes->getMessages();
                    foreach ($messmovies as $mvd){
                        echo "movdes: ". $mvd . "<br>";
                    }
                }
                else{
                    $this->flashSession->success("Movie was created successfully");
                    $this->dispatcher->forward(['controller' => 'movie', 'action' => 'index']);
                }
            }else{
                $messmovie = $mov->getMessages();
                foreach ($messmovie as $mvd){
                    echo "mov: ". $mvd . "<br>";
                }
                return $this->dispatcher->forward(
                    [
                        "controller" => "movie",
                        "action"     => "new",
                    ]
                );
            }


        }

    }

    public function editAction()
    {
        $this->view->title = "Edit Items Catalog";
        $id = $this->request->getQuery('id');
        $query = Movie::find(["id = $id"]);
        $this->view->catalog = Category::find();
        $movie = MovieDescription::find(["movie_id = $id"]);
        foreach($query as $qr){
            $this->view->name_movie = $qr->name;
            $this->view->catalog_id = $qr->category_id;
        }
        foreach ($movie as $mov){
            $this->view->id             = $mov->id;
            $this->view->description    = $mov->description;
            $this->view->image          = $mov->image;
            $images                     = $mov->image;
            $this->view->price          = $mov->price;
            $this->view->adult          = $mov->adult;
            $this->view->premiere       = $mov->premiere;
            $this->view->status         = $mov->status;
            $this->view->close_date     = $mov->close_date;
            $this->view->actor          = $mov->actor;
            $this->view->director       = $mov->director;
            $this->view->type_movie     = $mov->type_movie;
            $this->view->movie_id       = $mov->movie_id;
            $this->view->time           = $mov->time;
            $this->view->star           = $mov->star;
        }
        $this->view->option_adult = array(0 => "Free old", 13 => "> 13", 16 => "> 16", 18 => "> 18");
        $now = new \DateTime();
        if($this->request->isPost()){
            $movie = new Movie();
            $movie->id = $id;
            $movie->name = $this->request->getPost('name');
            $movie->category_id = $this->request->getPost('category_id');
            $movie->create_time = $now->format('Y-m-d');
            $movie->update_time = $now->format('Y-m-d');
            if($movie->save()){
                if($this->request->hasFiles()){
                    $files=$this->request->getUploadedFiles();
                    foreach ($files as $file) {
                        $file_Name = $file->getName();
                        $file->moveTo(BASE_PATH.'/images/movies/'.$file->getName());    
                    }
                }else{
                    $file_Name = $image;
                }
                $moviedesc = new MovieDescription();
                
                $moviedesc->description    = $this->request->getPost("description");
                $moviedesc->image          = $file_Name;
                $moviedesc->price          = $this->request->getPost("price");
                $moviedesc->adult          = $this->request->getPost("adults");
                $moviedesc->premiere       = $this->request->getPost("premiere");
                $moviedesc->status         = 1;
                $moviedesc->close_date     = $this->request->getPost("close_date");
                $moviedesc->actor          = $this->request->getPost("actor");
                $moviedesc->director       = $this->request->getPost("director");
                $moviedesc->type_movie     = $this->request->getPost("type_movie");
                $moviedesc->movie_id       = $id;
                $moviedesc->time           = $this->request->getPost("time");
                $moviedesc->star           = 1;
                
                if($moviedesc->save() == false){

                    $messmovies = $moviedesc->getMessages();
                    foreach ($messmovies as $mvd){
                        echo "movdes: ". $mvd . "<br>";
                    }
                }
                else{
                    $this->flashSession->success("Movie was created successfully");
                    $this->dispatcher->forward(['controller' => 'movie', 'action' => 'index']);
                }
                
            }else{
                $messmovie = $movie->getMessages();
                foreach ($messmovie as $mvd){
                    echo "mov: ". $mvd . "<br>";
                }
                return $this->dispatcher->forward(
                    [
                        "controller" => "movie",
                        "action"     => "new",
                    ]
                );
            }
            
            
        }


    }

    public function deleteAction()
    {
        $id = $this->request->getQuery('id');
        $query = Movie::find(["id = $id "]);
        if($query->delete()){
            $this->flashSession->success("Movie was deleted successfully with key $id ");
            $this->dispatcher->forward(['controller' => 'Movie', 'action' => 'index']);
        }
        else{
            $this->flashSession->error("Movie was created not success");
            $this->dispatcher->forward(['controller' => 'Movie', 'action' => 'index']);
        }

    }
}