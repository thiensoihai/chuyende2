<?php
/**
 * Created by PhpStorm.
 * User: haingoc45
 * Date: 28-02-2017
 * Time: 2:36 CH
 */

namespace Multiple\Backend\Controllers;

use Phalcon\Mvc\Controller;
use Multiple\Backend\Models\Category as Category;
use Phalcon\Paginator\Adapter\Model as Paginator;

class CategoryController extends Controller
{
    public function indexAction()
    {

        $this->view->title = "Dashboard Catalog";
        $numberPage = $this->request->getQuery("page", "int");
        if($numberPage < 1){
            $numberPage = 1;
        }elseif ($numberPage > count(Category::find())){
            $numberPage = count(Category::find());
        }
        $this->assets->addCss('public/vendor/dataTables.responsive.css');

        $paginator = new Paginator(array(
            "data"  => Category::find(),
            "limit" => 5,
            "page"  => $numberPage));
        $this->view->page = $paginator->getPaginate();

    }

    public function newAction()
    {
        $this->view->title = "New Items Catalog";
        $now = new \DateTime();
        if($this->request->isPost()){
            $cate = new Category();

            foreach($_POST as $key => $value){
                $cate->$key = $value;
            }

            $cate->create_time = $now->format('Y-m-d');
            $cate->update_time = $now->format('Y-m-d');
            if($this->request->getPost('name') == ''){
                $this->flash->error("data not null");
            }
            var_dump($cate->getMessages());
            if($cate->save()){
                $this->flashSession->success("Category was created successfully");
                return $this->response->redirect('../multiple/admin/category/index');
            }elseif ($cate->save() === false){
                //$messages = $cate->getMessages();

//                foreach ($messages as $mess){
//                    $this->flashSession->error($mess);
//                }


                return $this->dispatcher->forward(
                    [
                        "controller" => "category",
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
        $query = Category::find(["id = $id"]);
        $now = new \DateTime();
        if($this->request->isPost()){
            $cate = new Category();
            $cate->id = $id;
            $cate->name = $this->request->getPost('name');
            $cate->description = $this->request->getPost('description');
            $cate->parent_id = $this->request->getPost('parent_id');
            $cate->create_time = $now->format('Y-m-d');
            $cate->update_time = $now->format('Y-m-d');
            if($cate->save()){
                $this->flashSession->success("Category was created successfully");
                return $this->response->redirect('../multiple/admin/category/index');
            }elseif ($cate->save() === false){
                $messages = $cate->getMessages();

                foreach ($messages as $message){
                    $message = $message;
                }

                echo $message;



                return $this->dispatcher->forward(
                    [
                        "controller" => "category",
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
        $query = Category::find(["id = $id "]);
        if($query->delete()){
            $this->flashSession->success("Category was deleted successfully with key $id ");
            //$this->dispatcher->forward(['controller' => 'category', 'action' => 'index']);
            $this->response->redirect('/multiple/admin/category/');
        }
        else{
            $this->flashSession->error("Category was created not success");
            $this->dispatcher->forward(['controller' => 'category', 'action' => 'index']);
        }

    }
}