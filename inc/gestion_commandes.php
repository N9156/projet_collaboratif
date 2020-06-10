<?php

require_once("../inc/init.php");

// L'idée générale de cette page c'est d'afficher les commandes

$r = $pdo->query("SELECT * FROM commande");

while($commande = $r->fetch(PDO::FETCH_ASSOC)) {
    echo "<pre>";
    var_dump($commande);
    echo "</pre>";
}

?>

<table class="table">
  <thead>
    <tr>

        <!-- JE RÉCUPÈRE LE NOM DE MES COLONNES EN BDD -->
        <!-- POUR GÉNÉRER LES TH DE MA TABLE HTML DYNAMIQUEMENT -->


    </tr>
  </thead>
  <tbody>

        <!-- JE FETCH DANS LE JEU DE RÉSULTAT DE MA REQUÊTE SQL (PDOSTATEMENT)-->


  </tbody>
</table>