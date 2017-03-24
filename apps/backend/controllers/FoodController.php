<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Multiple\Backend\Controllers;
use Multiple\Backend\Models\FoodDescription;
use Phalcon\Mvc\Controller;
use Multiple\Backend\Models\Food as Food;
use Multiple\Backend\Models\FoodDescription as FoodDescrtiption;
use Phalcon\Paginator\Adapter\Model as Paginator;

class FoodController extends Controller
{
    public function indexAction()
    {
        $this->view->title = "Dashboard Food";
        $numberPage = $this->request->getQuery("page", "int");
        if($numberPage < 1){
            $numberPage = 1;
        }elseif ($numberPage > count(Food::find())){
            $numberPage = count(Food::find());
        }
        $this->assets->addCss('public/vendor/dataTables.responsive.css');

        $paginator = new Paginator(array(
            "data"  => Food::find(),
            "limit" => 5,
            "page"  => $numberPage));
        $this->view->page = $paginator->getPaginate();

    }

    public function viewAction()
    {
        $this->view->title = "View Item Food";
        $id = $this->request->getQuery('id');
        $query = Food::find(["id = $id"]);
        $food  = FoodDescription::findFirst(["id_food = $id"]);
        $this->view->query = $query;
        $this->view->food = $food;
    }

    public function newAction()
    {
        $this->view->title = "New Items Food";
        $now = new \DateTime();
        if($this->request->isPost()){
            $cate = new Food();

            $cate->name = $this->request->getPost('name');
            $cate->status = $this->request->getPost('status');
            $cate->create_time = $now->format('Y-m-d');
            $cate->update_time = $now->format('Y-m-d');
            if($this->request->getPost('name') == ''){
                $this->flash->error("data not null");
            }
            if($cate->save()){
                $foodesc = new FoodDescrtiption();
                $foodesc->description = $this->request->getPort('description');
                $foodesc->price = $this->request->getPort('price');
                $foodesc->number = $this->request->getPort('number');
                $foodesc->id_food = $cate->id;
                if($foodesc->save()){
                    $this->flashSession->success("Food was created successfully");
                    return $this->response->redirect('../multiple/admin/food/index');
                }else{
                    $messages = $cate->getMessages();

                    foreach ($messages as $mess){
                        $this->flashSession->error($mess);
                    }
                }

            }elseif ($cate->save() === false){
                $messages = $cate->getMessages();

                foreach ($messages as $mess){
                    $this->flashSession->error($mess);
                }


                return $this->dispatcher->forward(
                    [
                        "controller" => "food",
                        "action"     => "new",
                    ]
                );
            }
        }

    }

    public function editAction()
    {
        $this->view->title = "Edit Items Food";
        $id = $this->request->getQuery('id');
        $query = Food::find(["id = $id"]);
        $now = new \DateTime();
        if($this->request->isPost()){
            $cate = new Food();
            $cate->id = $id;
            $cate->name = $this->request->getPost('name');
            $cate->status = $this->request->getPost('status');
            $cate->create_time = $now->format('Y-m-d');
            $cate->update_time = $now->format('Y-m-d');
            if($cate->save()){
                $this->flashSession->success("Category was created successfully");
                return $this->response->redirect('../multiple/admin/food/index');
            }elseif ($cate->save() === false){
                $messages = $cate->getMessages();

                foreach ($messages as $message){
                    $message = $message;
                }

                echo $message;



                return $this->dispatcher->forward(
                    [
                        "controller" => "food",
                        "action"     => "edit",
                    ]
                );
            }
        }
        $this->view->query = $query;

    }

    public function deleteAction()
    {
        $id = $this->request->getQuery('id');
        $query = Food::find(["id = $id "]);
        if($query->delete()){
            $this->flashSession->success("Category was deleted successfully with key $id ");
            //$this->dispatcher->forward(['controller' => 'category', 'action' => 'index']);
            $this->response->redirect('..//multiple/admin/food/');
        }
        else{
            $this->flashSession->error("Category was created not success");
            $this->dispatcher->forward(['controller' => 'food', 'action' => 'index']);
        }

    }
}
