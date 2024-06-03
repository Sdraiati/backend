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

    public function renderProjectPage($titlePage, $logged, $projectManager): void{
        $html_content = $this->getPage($titlePage, $logged);
        $projects = array();
        if($logged){
            $data = json_decode($_COOKIE['LogIn'], true); 
            $projects = $projectManager->getProjectList($data['email']);
        }
        else{
            $data = ['username'=>'', 'email'=>''];
        }
        $html_content = str_replace("{{ username }}", $data['username'], $html_content);
        $html_content = str_replace("{{ email }}", $data['email'], $html_content);
        $projectList = "";
        # if projects is empty
        if((count($projects) === 1 && $projects[0] === null))
        {
            $projectList = "<p>Non hai ancora nessun progetto.</p>";
        }
        else
        {
            foreach($projects as $project)
            {
                $link = $project['link_condivisione'];
                $projectList = $projectList . "<il class='projectContainer'>
                                                <span>".$project['nome']."</span>
                                                <span>".$project['descrizione']."</span>
                                                <ul>
                                                    <li><button onclick='share(\"".$link."\")'>condividi</button></li>
                                                    <li><button onclick='openProjectPage(\"".$link."\")'>apri</button></li>
                                                </ul>
                                                </il>";
            }
        }
        //$projectList = $projectList . '<p>'.$data['email'].'</p>';
        $html_content = str_replace("{{ projects }}", $projectList, $html_content);
        echo $html_content;
    }
}
