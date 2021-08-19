<?php

namespace mvc;

class Router
{

    static public function parse(string $url,Request $request)
    {
        $url = trim($url);

        if ($url == "/mvc/")
        {
            $request->controller = "tasks";
            $request->action = "index";
            $request->params = [];
        }
        else
        {   
            /*  Ở đây sẽ băm $url /root/controller/acction/params  thành controller, acction và prams 
                rồi gán thành các thuộc tính của object $request. */
            $explode_url = explode('/', $url);
            $explode_url = array_slice($explode_url, 2);
            $request->controller = $explode_url[0];
            $request->action = $explode_url[1];
            $request->params = array_slice($explode_url, 2);
        }
    }
}
