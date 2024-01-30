<?php

// iniziare una sessione
function generate_header($title)  {

// 1. iniziare sessione.
session_start();

// genera head
echo "
<!DOCTYPE html>
<html lang=it>

<head>
	<meta charset=\"utf-8\" />
	<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\" />
	<title> " . $title . " </title>
	<base href=\"/backend/\" />
	<meta name=\"description\" content=\"un sito per mostrare cose\">
	<meta name=\"keywords\" content=\"sito, cose, dati, UN BEL GRAFICONE A TORTA\">
	<link rel=\"stylesheet\" type=\"text/css\" href=\"index.css\">
</head>";


// 2. genera navbar
if (isset($_SESSION["username"])) {
    // generare solo img utente
    var_dump($_SESSION["username"]);
    echo "
    <nav>
	<div class=\"Logo\">
		<a href=\"index.html\"><img src=\"assets/img/logo.jpeg\" alt=\"logo\"></a>
	</div>
	<div class=\"Login\">
		<ul class=\"login-list\">
			<li><a href=\"account_home.html\" id=\"utente\">Utente</a></li>
		</ul>
    </nav>
   " ;
} else {
    
// generare login e registrati. 
echo "
<nav>
	<div class=\"Logo\">
		<a href=\"index.html\"><img src=\"assets/img/logo.jpeg\" alt=\"logo\"></a>
	</div>
	<div class=\"Login\">
		<ul class=\"login-list\">
			<li><button data-button-kind=\"accedi\">Accedi</button></li>
			<li><button data-button-kind=\"registrati\">Registrati</button></li>
		</ul>
	</div>
</nav>

<section id=\"accedi\" class=\"hidden\">
	<h2>Login</h2>
	<form id=\"loginForm\" action=\"javascript:void(0)\">
		<label for=\"loginEmail\">Email:</label>
		<input type=\"email\" id=\"loginEmail\" name=\"email\" required autocomplete=\"email\">
		<label for=\"loginPassword\">Password:</label>
		<input type=\"password\" id=\"loginPassword\" name=\"password\" required autocomplete=\"current-password\">
		<button type=\"button\" data-button-kind=\"accediHide\">Annulla</button>
		<button type=\"submit\">Accedi</button>
	</form>
</section>

<section id=\"registrati\" class=\"hidden\">
	<h2>Registrazione</h2>
	<form id=\"registratiForm\" action=\"javascript:void(0)\">
		<label for=\"signupUsername\">Nome Utente:</label>
		<input type=\"text\" id=\"signupUsername\" name=\"username\" required autocomplete=\"username\">
		<label for=\"signupEmail\">Email:</label>
		<input type=\"email\" id=\"signupEmail\" name=\"email\" required autocomplete=\"email\">
		<label for=\"signupPassword\">Password:</label>
		<input type=\"password\" id=\"signupPassword\" name=\"password\" required autocomplete=\"new-password\">
		<span id=\"passwordError\" class=\"hidden\">Le due password non coincidono.</span>
		<label for=\"signupConfirmPassword\">Ripeti Password:</label>
		<input type=\"password\" id=\"signupConfirmPassword\" name=\"password\" required autocomplete=\"new-password\">
		<button type=\"button\" data-button-kind=\"registratiHide\">Annulla</button>
		<button type=\"submit\">Registrati</button>
	</form>
</section>

<script type=\"module\" src=\"assets/js/nav.js\"></script>
";
}




}


?>