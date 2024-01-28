<?php
    include '../config/database.php'
?>

<?php

// prendere i valori dalla POST request 
// in questo momento ci sono solo dei valori di prova.
// devono poi essere aggiornati con i valori che
// vengono passati dal cliente tramite pOST request.
/*
    un tag si può modificare: 
    1. globalmente => tutti i progetti contenenti quel tag allora devono modificarlo e se 
    ci sono spese correlate a quel tag, modificare l'associazione al tag 
    => devono essere modificate (in ordine):
        1. all'interno della tabella tag_progetto (UPDATE tag_progetto SET id_progetto = id_nuovo_progetto, nome_tag = nome_tag_nuovo 
        WHERE tag = old_tag;)
        2. all'interno della tabella tag (UPDATE tag SET nome = nuovo_nome_tag, descrizione = nuova_descrizione WHERE tag = old_tag; )
        3. if NOT NULL => UPDATE movimento SET tag = nuovo_nome_tag WHERE tag = old_tag; 
    2. dal progetto => tutte le spese associate a quel tag devono modificare la loro associazione 
    => devono essere modificate in ordine: 
       1. righe della tabella tag_progetto (UPDATE tag_progetto SET nome_tag = nome_tag_nuovo WHERE tag_progetto.id_progetto = progetto.id ).
       2. righe della tabella spese (if NOT NULL => UPDATE movimento SET tag = nuovo_nome_tag WHERE movimento.tag = old_tag;).
*/


$id_progetto = "1";
$data = "2024-01-27 11:48:30"; // 2001-03-10 17:16:18 (the MySQL DATETIME format).

$nuovo_importo = "20.00";
$nuova_descrizione = "nuova descrizione derivata da un update";

// query al db
$sql = "UPDATE movimento SET importo = ${nuovo_importo}, descrizione = \"${nuova_descrizione}\" WHERE id_progetto = ${id_progetto} AND data = \"${data}\"; "; 
echo '<h1> ' . $sql . ' </h1>';

/*
$result = mysqli_query($conn, $sql);
if ($result) {
    echo '<h2> transazione riuscita </h2>' ;
} else {
    echo '<h2> transazione NON: riuscita (non esiste il record da aggiornare all'interno della tabella). </h2>' ;
}
*/ 

if($conn->close()) {
    echo '<h2> connection closed </h2>';
}