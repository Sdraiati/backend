<?php

include "scripts/generate_header.php";
class Controller
{
    protected string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = rtrim('backend', '/'); // first is base url
    }

    private function loggedState($html_content, $logged)
    {
        $loggedHeader = '<div class="Login">
        <ul class="login-list">
            <li><a href="account_home" id="utente">Utente</a></li>
        </ul>
    </div>	';
        $noLoggedHeader = '<div class="Login">
        <ul class="login-list">
            <li><button data-button-kind="accedi">Accedi</button></li>
            <li><button data-button-kind="registrati">Registrati</button></li>
            <li class="hidden"><a href="account_home" id="utente">Utente</a></li>
        </ul>
    </div>	';
        if($logged)
        {
            $html_content = str_replace("{{ header }}", $loggedHeader, $html_content);
        }
        else{
            $html_content = str_replace("{{ header }}", $noLoggedHeader, $html_content);
        }
        return $html_content;
    }

    private function getPage($titlePage, $logged){
        $fileName = "views/".$titlePage.".html";
        if(file_exists($fileName))
        {
            $html_content = file_get_contents($fileName);
            return $this->loggedState($html_content, $logged);
        }
        else{
            throw new Exception("file not found!");
        }

    }

    public function renderPage($titlePage, $logged): void{
        echo $this->getPage($titlePage, $logged);
    }

    public function renderProjectPage($titlePage, $logged, $projects): void{
        $html_content = $this->getPage($titlePage, $logged);
        if($logged){
            $data = json_decode($_COOKIE['LogIn'], true); 
        }
        else{
            $data = ['username'=>'', 'email'=>''];
        }
        $html_content = str_replace("{{ username }}", $data['username'], $html_content);
        $html_content = str_replace("{{ email }}", $data['email'], $html_content);
        $projectList = "";
        foreach($projects as $project)
        {
            $projectList = $projectList . '<il class="projectContainer">
                                            <span>'.$project['nome'].'</span>
                                            <span>'.$project['descrizione'].'</span>
                                            <button>condividi</button>
                                            <button>apri</button>
                                            </il>';
        }
        $html_content = str_replace("{{ projects }}", $projectList, $html_content);
        echo $html_content;
    }
}
