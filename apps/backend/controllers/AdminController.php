<?php
/**
 * Created by PhpStorm.
 * User: haingoc45
 * Date: 19-03-2017
 * Time: 12:07 CH
 */

namespace Multiple\Backend\Controllers;

use Multiple\Backend\Models\Admin as Admin;
use Phalcon\Mvc\Controller;
use Phalcon\Paginator\Adapter\Model as Paginator;
class AdminController extends Controller
{
    public function indexAction()
    {
        $this->view->title = "Dashboard Admin";
        $numberPage = $this->request->getQuery("page", "int");
        if($numberPage < 1){
            $numberPage = 1;
        }elseif ($numberPage > count(Admin::find())){
            $numberPage = count(Admin::find());
        }
        $this->assets->addCss('public/vendor/dataTables.responsive.css');

        $paginator = new Paginator(array(
            "data"  => Admin::find(),
            "limit" => 5,
            "page"  => $numberPage));
        $this->view->page = $paginator->getPaginate();
    }

    public function newAction()
    {
        $this->view->title = "New Admin";

        if($this->request->isPost()){
            $day = $this->request->getPost('day');
            $month = $this->request->getPost('month');
            $year = $this->request->getPost('year');
            $password = $this->request->getPost('password');
            $birth = $year.'/'.$month.'/'.$day;
            $admin = new Admin();
            $now = new \DateTime();
            $admin->username = $this->request->getPost('username');
            $admin->password = $this->security->hash($password);
            $admin->fullname = $this->request->getPost('fullname');
            $admin->email    = $this->request->getPost('email');
            $admin->identity_card = $this->request->getPost('idc');
            $admin->phone    = $this->request->getPost('phone');
            $admin->birthday = $birth;
            $admin->level    = $this->request->getPost('level');
            $admin->create_time = $now->format('Y-m-d');
            $admin->update_time = $now->format('Y-m-d');
            if($admin->save()){
                $this->flashSession->success("Admin was created successfully");
                return $this->response->redirect('../multiple/admin/admin/index');
            }elseif ($admin->save() === false){
                $messages = $admin->getMessages();

                foreach ($messages as $mess){
                    $this->flashSession->error($mess);
                }
                //return $this->dispatcher->forward(["controller" => "admin", "action"     => "new",]);
            }
        }
    }

    public function editAction()
    {
        $id = $this->request->getQuery('id');
        $this->view->title = "Edit Admin";
        $admin = Admin::find(["id = $id"]);
        if($this->request->isPost()){
            $day = $this->request->getPost('day');
            $month = $this->request->getPost('month');
            $year = $this->request->getPost('year');
            $password = $this->request->getPost('password');
            $birth = $year.'/'.$month.'/'.$day;
            $admin = new Admin();
            $now = new \DateTime();
            $admin->username = $this->request->getPost('username');
            $admin->password = $this->security->hash($password);
            $admin->fullname = $this->request->getPost('fullname');
            $admin->email    = $this->request->getPost('email');
            $admin->identity_card = $this->request->getPost('idc');
            $admin->phone    = $this->request->getPost('phone');
            $admin->birthday = $birth;
            $admin->level    = $this->request->getPost('level');
            $admin->create_time = $now->format('Y-m-d');
            $admin->update_time = $now->format('Y-m-d');
            if($admin->save()){
                $this->flashSession->success("Admin was created successfully");
                return $this->response->redirect('../multiple/admin/admin/index');
            }elseif ($admin->save() === false){
                $messages = $admin->getMessages();

                foreach ($messages as $mess){
                    $this->flashSession->error($mess);
                }
                //return $this->dispatcher->forward(["controller" => "admin", "action"     => "new",]);
            }
        }
        $this->view->admin = $admin;
    }

    public function deleteAction()
    {
        $id = $this->request->getQuery('id');
        $query = Admin::find(["id = $id "]);
        if($query->delete()){
            $this->flashSession->success("Admin was deleted successfully with key $id ");
            //$this->dispatcher->forward(['controller' => 'category', 'action' => 'index']);
            $this->response->redirect('/multiple/admin/admin/');
        }
        else{
            $this->flashSession->error("Admin was created not success");
            $this->dispatcher->forward(['controller' => 'admin', 'action' => 'index']);
        }
    }

}