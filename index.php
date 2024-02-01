<!-- <title>Home - Penny Wise</title> -->
<?php
	include "scripts/generate_header.php";

	generate_header("Home");
?>
	<header>
		<h1>Penny Wise</h1>
	</header>


	<main>
<section id="first-para">
	<div>
		<img src="assets/img/screenshot.jpg" alt="Screenshot dell'homepage di Penny Wise">
		<p>Benvenuto su Penny Wise, la tua soluzione gratuita per gestire le finanze in modo efficace ed efficiente. Sia
			che tu stia cercando di risparmiare, pianificare per il futuro o semplicemente tenere traccia delle tue
			spese quotidiane, siamo qui per aiutarti.</p>
	</div>
</section>

<section>
	<h2>Cosa puoi fare con Penny Wise?</h2>
	<p>Con Penny Wise, hai a disposizione una serie di strumenti per gestire le tue finanze in modo intelligente:</p>
	<div class="container">
		<div class="item">
			<img src="assets/img/screenshot.jpg" alt="inserimento di una transiazione">
		</div>
		<div class="item">
			<ul>
				<li><strong>Registra le transazioni:</strong> Registra spese ed entrate in modo rapido e accurato,
					fornendo una panoramica completa delle tue finanze.</li>
			</ul>
		</div>
		<div class="item">
			<ul>
				<li><strong>Grafici intuitivi:</strong> Visualizza l'andamento generale delle tue finanze attraverso
					grafici chiari e comprensibili.</li>
				<li><strong>Retrospettive finanziarie:</strong> Effettua analisi retrospettive, migliorando la tua
					capacità di prendere decisioni finanziarie informate.</li>
			</ul>
		</div>
		<div class="item">
			<img src="assets/img/screenshot.jpg" alt="grafico dell'andamento patrimoniale">
		</div>
		<div class="item">
			<img src="assets/img/screenshot.jpg" alt="analisi delle spese suddivise per tag">
		</div>
		<div class="item">
			<ul>
				<li><strong>Categorizzazione avanzata:</strong> Categorizza le tue transazioni assegnando tag
					personalizzati, semplificando la gestione e l'analisi delle tue spese.</li>
				<li><strong>Analisi dettagliata:</strong> Filtra e analizza le spese per categoria, monitorando la
					percentuale di spese per ogni tag. Ottieni una visione dettagliata dei tuoi consumi.</li>
			</ul>
		</div>
	</div>
	<div>
		<h2>Perché scegliere Penny Wise?</h2>
		<p>La nostra webapp è progettata pensando alle tue esigenze specifiche:</p>
		<ul>
			<li><strong>Facile da usare:</strong> Un'interfaccia utente intuitiva rende la registrazione delle
				transazioni e la navigazione nell'app un gioco da ragazzi.</li>
			<li><strong>Gratuita e accessibile:</strong> Penny Wise è completamente gratuito, garantendo a tutti
				l'accesso a uno strumento di gestione finanziaria di alta qualità.</li>
		</ul>
	</div>
</section>


	</main>
<footer>
	<div class="footer-list">
		<h3>Prodotto</h3>
		<ul>
			<li><a href="account_home.php">I Miei Progetti</a></li>
			<li><a href="about_us.php">About Us</a></li>
		</ul>
	</div>
	<div class="footer-list">
		<h3>Risorse</h3>
		<ul>
			<li><a href="index.php">Homepage</a></li>
			<li><a href="release_notes.php">Release Notes</a></li>
			<li><a href="https://github.com/Sdraiati" target="_blank"> <img src="assets/img/github-mark-white.png"
						id="github-mark"> GitHub </a></li>
		</ul>
	</div>
</footer>

</body>

</html>
