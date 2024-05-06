<?php

class Controller
{
    protected string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = rtrim('backend', '/'); // first is base url
    }

    public function renderPageTitle(): void {
        $pageTitle = "IL TITOLO"; // Titolo della pagina
        $content = file_get_contents("index.php");
        $replacements = ['{title}' => $pageTitle];

        echo strtr($content, $replacements);
    }

    public function renderAboutUsPage(): void
    {
        $pageTitle = "Penny Wise"; // Titolo della pagina
        $content = file_get_contents("about_us.html"); // Contenuto della pagina about_us.html
        $replacements = ['{title}' => $pageTitle]; // Sostituzione del placeholder {title}

        echo strtr($content, $replacements); // Stampare il contenuto con i placeholder sostituiti
    }

    // Altri metodi per gestire altre pagine, se necessario...
}