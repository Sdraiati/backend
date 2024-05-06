<?php
    include "scripts/generate_header.php";
    include "controllers/Controller.php";

    // Crea un'istanza del controller
    $controller = new Controller();

    generate_header("Home");

    // Ottieni il titolo dalla funzione renderAboutUsPage() del controller
    $controller->renderPageTitle();
?>
<header>
    <h1>{title}</h1>
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
            <!-- Contenuto omesso per brevità -->
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
    <!-- Contenuto omesso per brevità -->
</footer>

</body>
</html>
