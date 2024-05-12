<?php

include "scripts/generate_header.php";
class Controller
{
    protected string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = rtrim('backend', '/'); // first is base url
    }

    /*public function renderPageTitle(): void {
        $pageTitle = "IL TITOLO"; // Titolo della pagina
        $content = file_get_contents("views/index.html");
        $replacements = ['{title}' => $pageTitle];

        echo strtr($content, $replacements);
    }

    public function renderAboutUsPage(): void
    {
        $pageTitle = "Penny Wise"; // Titolo della pagina
        $content = file_get_contents("views/about_us.html"); // Contenuto della pagina about_us.html
        $replacements = ['{title}' => $pageTitle]; // Sostituzione del placeholder {title}

        echo strtr($content, $replacements); // Stampare il contenuto con i placeholder sostituiti
    }*/

    // Altri metodi per gestire altre pagine, se necessario...

    public function renderPage($titlePage): void{
        $fileName = "views/".$titlePage.".html";
        if(file_exists($fileName))
        {
            $html_content = file_get_contents($fileName);
            //$replacements = ['{{ title }}' => $title];
            //$header = generate_header($titlePage);
            //$html_content = $header . $html_content;
            //echo strtr($html_content, $replacements);
            echo $html_content;
        }
        else{
            throw new Exception("file not found!");
        }

    }
}