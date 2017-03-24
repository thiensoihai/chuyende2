<?php
/**
 * Created by PhpStorm.
 * User: haingoc45
 * Date: 21-03-2017
 * Time: 7:37 CH
 */

namespace Multiple\Backend\Controllers;

use Multiple\Backend\Models\Users as Users;
use Phalcon\Mvc\Controller;
use Phalcon\Paginator\Adapter\Model as Paginator;

class UserController extends Controller
{
    public function indexAction()
    {
        $this->view->title = "Dashboard Users";
        $numberPage = $this->request->getQuery("page", "int");
        if($numberPage < 1){
            $numberPage = 1;
        }elseif ($numberPage > count(Users::find())){
            $numberPage = count(Users::find());
        }
        $this->assets->addCss('public/vendor/dataTables.responsive.css');

        $paginator = new Paginator(array(
            "data"  => Users::find(),
            "limit" => 5,
            "page"  => $numberPage));
        //đẩy ra view
        // view->tên biến
        $this->view->page = $paginator->getPaginate();
    }

    public function editAction()
    {
        $this->view->title = "Edit User";
        $id = $this->request->getQuery('id');
        $user = Users::find(["id = $id"]);
        $this->view->user = $user;

        if($this->request->isPost()){
            $users = new Users();
            $users->id = $id;
            foreach ($_POST as $key=>$value){
                $users->$key = $value;
            }
            $users->update_time = $this->request->getPost('create_time');

            if($users->save()){
                $this->flashSession->success("User was created successfully");
                return $this->response->redirect('../multiple/admin/user/index');
            }elseif ($users->save() === false){
                $messages = $users->getMessages();
                foreach ($messages as $message){
                    $message = $message;
                }
                echo $message;
                return $this->dispatcher->forward(["controller" => "user","action"     => "edit",]);
            }
        }
    }
}