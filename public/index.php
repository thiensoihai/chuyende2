<?php

error_reporting(E_ALL);
define("PUBLIC_PATH", '/multiple/public');
define('BASE_PATH', __DIR__ );
use Phalcon\Loader;
use Phalcon\Mvc\Router;
use Phalcon\Mvc\Model\Manager as ModelsManager;
use Phalcon\DI\FactoryDefault;
use Phalcon\Mvc\Application as BaseApplication;

class Application extends BaseApplication
{
    /**
     * Register the services here to make them general or register in the ModuleDefinition to make them module-specific
     */
    protected function registerServices()
    {

        $di = new FactoryDefault();

        $loader = new Loader();

        /**
         * We're a registering a set of directories taken from the configuration file
         */
        $loader
            ->registerDirs([__DIR__ . '/../apps/library/'])
            ->register();

        // Registering a router
        $di->set(
            "modelsManager",
            function() {
                return new ModelsManager();
            }
        );
        $di->set('router', function () {

            $router = new Router();

            $router->setDefaultModule("frontend");

            $router->add('/', [
                'module' => 'frontend',
                'controller' => 'home',
                'action' => 'index',
            ])->setName('frontend');

            $router->add('/:controller/:action', [
                'module'     => 'frontend',
                'controller' => 1,
                'action'     => 2,
            ])->setName('frontend');


            $router->add("/admin/:controller/:action", [
                'module'     => 'backend',
                'controller' => 1,
                'action'     => 2,
            ])->setName('backend-product');

            $router->add("/admin/:controller", [
                'module' => 'backend',
                'controller' => 1,
                'action' => 'index'
            ]);

            $router->add("/admin/:controller/", [
                'module' => 'backend',
                'controller' => 1,
                'action' => 'index'
            ]);

            $router->add('/admin/:controller/:action/id/[0-9]', [
               'module' => 'backend',
                'controller' => 1,
                'action' => 2,
                'id' => 3
            ]);


            return $router;
        });


        $di->set('session', function() {
           $session = new Phalcon\Session\Adapter\Files(['lifetime'=>10, 'cookie_lifetime' => 10]);
           $session->start();
           return $session;
        }, true);

        $this->setDI($di);
    }

    public function main()
    {

        $this->registerServices();

        // Register the installed modules
        $this->registerModules([
            'frontend' => [
                'className' => 'Multiple\Frontend\Module',
                'path'      => '../apps/frontend/Module.php'
            ],
            'backend'  => [
                'className' => 'Multiple\Backend\Module',
                'path'      => '../apps/backend/Module.php'
            ]
        ]);

        echo $this->handle()->getContent();
    }
}

$application = new Application();
$application->main();
