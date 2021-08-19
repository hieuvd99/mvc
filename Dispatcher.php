<?php

namespace mvc;

use mvc\Request;
use mvc\Router;

class Dispatcher
{
    private $request;

    public function dispatch()
    {
        $this->request = new Request();
        Router::parse($this->request->url, $this->request);
        $controller = $this->loadController();
        call_user_func_array([$controller, $this->request->action], $this->request->params); //Gọi function của controller theo đối số vừa lấy được
    }

    public function loadController()
    {   
        //Lấy tên controller + Controller: Student + Controller = StudentController
        $name = ucfirst($this->request->controller) . "Controller";
        /* Tuy nhiên ở đây không sử dụng prs-4 */
        // $file = ROOT . 'Controllers/' . $name . '.php';
        // require($file);
        // $controller = new $name();
        // return $controller;

        //tạo url controller và ruturn
        $controller = 'mvc\Controllers\\' . $name;
	    return new $controller;
    }

}
