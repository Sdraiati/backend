<?php

include "scripts/generate_header.php";
class Controller
{
    protected string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = rtrim('backend', '/'); // first is base url
    }

    public function renderPage($titlePage, $logged): void{
        $fileName = "views/".$titlePage.".html";
        if(file_exists($fileName))
        {
            $html_content = file_get_contents($fileName);
            echo $html_content;
        }
        else{
            throw new Exception("file not found!");
        }

    }
}