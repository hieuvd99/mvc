<?php

namespace mvc;

class Request
{
    public $url;

    public function __construct()
    {   
        //Tạo request để gán cho thuộc tính $url
        $this->url = $_SERVER["REQUEST_URI"];
    }
}

