<?php

namespace Multiple\Backend;

use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Dispatcher;
use Phalcon\DiInterface;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Db\Adapter\Pdo\Mysql as Database;
use Phalcon\Flash\Direct as FlashDicrect;
use Phalcon\Flash\Session as FlashSession;
class Module implements ModuleDefinitionInterface
{
    /**
     * Registers the module auto-loader
     *
     * @param DiInterface $di
     */
    public function registerAutoloaders(DiInterface $di = null)
    {
        $loader = new Loader();

        $loader->registerNamespaces(
            [
                'Multiple\Backend\Controllers' => '../apps/backend/controllers/',
                'Multiple\Backend\Models'      => '../apps/backend/models/',
                'Multiple\Backend\Plugins'     => '../apps/backend/plugins/',
            ]
        );

        $loader->register();
    }

    /**
     * Registers services related to the module
     *
     * @param DiInterface $di
     */
    public function registerServices(DiInterface $di)
    {
        // Registering a dispatcher
        $di->set('dispatcher', function () {
            $dispatcher = new Dispatcher();
            $dispatcher->setDefaultNamespace('Multiple\Backend\Controllers\\');
            $dispatcher->setDefaultController('login');
            $dispatcher->setDefaultAction('index');
            return $dispatcher;
        });

        // set Flash service
        $di->set('flash', function (){
            return new FlashDicrect(
                [
                    "error"   => "alert alert-danger",
                    "success" => "alert alert-success",
                    "notice"  => "alert alert-info",
                    "warning" => "alert alert-warning",
                ]
            );
        });


        $di->set('flashSession', function (){
           return new FlashSession(
               [
                   "error"   => "alert alert-danger",
                   "success" => "alert alert-success",
                   "notice"  => "alert alert-info",
                   "warning" => "alert alert-warning",
               ]
           );
        });

        // Registering the view component
        $di->set('view', function () {
            $view = new View();
            $view->setViewsDir('../apps/backend/views/');
            return $view;
        });

        // Set a different connection in each module
        $di->set('db', function () {
            return new Database(
                [
                    "host" => "localhost",
                    "username" => "root",
                    "password" => "",
                    "dbname" => "movieweb",
                    'charset'   =>'utf8'
                ]
            );
        });
    }
}
