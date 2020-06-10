<?php

require_once("../inc/init.php");

////////////////////////////////////////////
//////////// SUPPRIMER UN PRODUIT ////////////////
////////////////////////////////////////////

if(isset($_GET["action"]) && $_GET["action"] == "suppression") {
    $count = $pdo->exec("DELETE FROM produit WHERE id_produit = $_GET[id_produit]");
    if($count > 0){
        $content .= "<div class=\"alert alert-success\" role=\"alert\">
        Le produit Nº" . $_GET["id_produit"] . " a bien été supprimé en base !
      </div>";
    }
}

////////////////////////////////////////////
//////////// RÉCUPÉRER EN BDD LES INFOS DU PRODUIT À MODIFIER ////////////////
////////////////////////////////////////////

if(isset($_GET["action"]) && $_GET["action"] == "modification") {

    $r = $pdo->query("SELECT * FROM produit WHERE id_produit = $_GET[id_produit] ");
    $produit = $r->fetch(PDO::FETCH_ASSOC);

}

////////////////////////////////////////////
//////////// AJOUT/MODIFICATION ////////////////
////////////////////////////////////////////

if($_POST) {

    ////////////////////////////////////////////
    //////////// TRAITEMENT DE LA PHOTO ////////////////
    ////////////////////////////////////////////

    if(!empty($_FILES)){
        // Récupérer le nom de la photo
        $nomPhoto = $_POST["reference"] . "_" . $_FILES["photo"]["name"];
        // Enregistrer en BDD le chemin vers la photo
        $cheminPhotoPourBDD = URL . "photo/" . $nomPhoto;
        // Enregister/copier la photo sur le serveur
        // Fichier de destination à copier
        $dossier_pour_enregistrer_photo = RACINE_SITE . "photo/" . $nomPhoto;

        // Fichier de départ à copier
        // il correspond au fichier temporaire uploadé au niveau de l'input type file
        // il faut récupérer le répertoire de ce fichier temporaire uploadé et le copié vers le répértoire de destination
        // tmp_name correspond au fichier chargé que l'on souhaite copier
        copy($_FILES["photo"]["tmp_name"], $dossier_pour_enregistrer_photo);
    }

    foreach($_POST as $indice=>$valeur){
        $_POST[$indice] = addslashes($valeur);
    }

    ////////////////////////////////////////////
    //////////// Modifier UN PRODUIT ////////////////
    ////////////////////////////////////////////
    if(isset($_POST["modifierProduit"])) {
        $pdo->exec("UPDATE produit
        set reference = $_POST[reference],
        set categorie = '$_POST[categorie]',
        set titre = '$_POST[titre]',
        set description = '$_POST[description]',
        set couleur = '$_POST[couleur]',
        set taille = '$_POST[taille]',
        set public = '$_POST[public]',
        set photo = '$_POST[photo]',
        set prix = '$_POST[prix]',
        set stock = '$_POST[stock]'
        WHERE id_produit = '$_GET[id_produit]' ");

    } else {
        ////////////////////////////////////////////
        //////////// AJOUT DE PRODUIT ////////////////
        ////////////////////////////////////////////

        $count = $pdo->exec("INSERT INTO produit (reference, categorie, titre, description, couleur, 
        taille, public, photo, prix, stock)
        VALUES( '$_POST[reference]', '$_POST[categorie]', '$_POST[titre]', '$_POST[description]',
        '$_POST[couleur]', '$_POST[taille]', '$_POST[public]', '$cheminPhotoPourBDD' ,
        '$_POST[prix]', '$_POST[stock]' ) ");

        // Message de confirmation après ajout
        if($count >0 ){
            $content .= "<div class=\"alert alert-success\" role=\"alert\">
            Votre produit " . $_POST["titre"] . " a bien été ajouté en base.
        </div>";
        }
    }

}


////////////////////////////////////////////
//////////// RÉCUPÉRATION DES PRODUITS À AFFICHER ////////////////
////////////////////////////////////////////

$r = $pdo->query("SELECT * FROM produit");


////////////////////////////////////////////
//////////// VARIABILISER LE CONTENU DU FORMULAIRE////////////////
////////////////////////////////////////////
$id_produit = (isset($produit)) ? $produit["id_produit"] : "";
$reference = (isset($produit)) ? $produit["reference"] : "";
$categorie = (isset($produit)) ? $produit["categorie"] : "";
$titre = (isset($produit)) ? $produit["reference"] : "";
$description = (isset($produit)) ? $produit["description"] : "";
$couleur = (isset($produit)) ? $produit["couleur"] : "";
$taille = (isset($produit)) ? $produit["taille"] : "";
$public = (isset($produit)) ? $produit["public"] : "";
$photo = (isset($produit)) ? $produit["photo"] : "";
$prix = (isset($produit)) ? $produit["prix"] : "";
$stock = (isset($produit)) ? $produit["stock"] : "";


require_once("inc/header.php");

?>

<div class="col-md-10">

    <?php echo $content; ?>

    <div class="table-responsive">
    <caption>Liste des produits</caption>
        <table class="table col-md-12">
        
            <thead class="thead-dark">
                <tr>

                    <!-- JE RÉCUPÈRE LE NOM DE MES COLONNES EN BDD -->
                    <!-- POUR GÉNÉRER LES TH DE MA TABLE HTML DYNAMIQUEMENT -->

                    <?php for($i=0; $i< $r->columnCount(); $i++ ) { ?>
                        <th> <?php echo $r->getColumnMeta($i)["name"]; ?> </th>
                    <?php } ?>

                    <th> modification </th>
                    <th> suppresion </th>

                </tr>
            </thead>
            <tbody>

                <!-- JE FETCH DANS LE JEU DE RÉSULTAT DE MA REQUÊTE SQL (PDOSTATEMENT)-->
                
                <?php while($produit = $r->fetch(PDO::FETCH_ASSOC)) { ?>
                    
                    <tr>

                        <?php foreach($produit as $indice => $valeur) {
                            if($indice == "photo") { ?>
                                <td> <img class="img-fluid" style="width:40px" src="<?php echo $valeur; ?>">  </td>
                           <?php  } else{ ?>
                            <td> <?php echo $valeur;  ?>  </td>
                           <?php } ?>

                        <?php } ?>

                        <!-- LIEN DE MODIFICATION ET SUPPRESSION -->

                        <td>
                            <a href="?action=modification&id_produit= <?php echo $produit['id_produit']; ?>" class="badge badge-dark"> Modifier </a>
                        </td>
                        <td>
                            <a href="?action=suppression&id_produit= <?php echo $produit['id_produit']; ?>" class="badge badge-danger"> Supprimer </a>
                        </td>
                    
                    </tr>
                    
                <?php } ?>

            </tbody>
        </table>

    </div>


    <!-- Formulaire d'ajout/modification de produit -->

    <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" value="<?php echo $id_produit; ?>">
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="reference">Reference</label>
                <input type="text" class="form-control" id="reference" name="reference" value="<?php echo $reference; ?>">
            </div>
            <div class="form-group col-md-3">
                <label for="categorie">Categorie</label>
                <input type="text" class="form-control" id="categorie" name="categorie" value="<?php echo $categorie; ?>">
            </div>
            <div class="form-group col-md-3">
                <label for="titre">Titre</label>
                <input type="text" class="form-control" id="titre" name="titre" value="<?php echo $titre; ?>">
            </div>
            <div class="form-group col-md-3">
                <label for="couleur">Couleur</label>
                <input type="text" class="form-control" id="couleur" name="couleur" value="<?php echo $couleur; ?>">
            </div>
            <div class="form-group col-md-3">
                <label for="taille">Taille</label>
                <input type="text" class="form-control" id="taille" name="taille" value="<?php echo $taille; ?>">
            </div>
            <div class="form-group col-md-3">
                <label for="prix">Prix</label>
                <input type="text" class="form-control" id="prix" name="prix" value="<?php echo $prix; ?>">
            </div>
            <div class="form-group col-md-3">
                <label for="stock">Stock</label>
                <input type="text" class="form-control" id="stock" name="stock" value="<?php echo $stock; ?>">
            </div>
            <div class="w-100"></div>

            <!-- FAIRE VARIABLED LE SELECTED DES INPUTS -->

            <div class="form-group col-md-2">
                <label for="public_m">Public</label>
                <div class="custom-control custom-radio">
                    <input type="radio" id="public_m" name="public" class="custom-control-input" value="m" checked>
                    <label class="custom-control-label" for="public_m">Masculin</label>
                </div>
            </div>
            <div class="form-group col-md-2">
                <label for="public_f" style="color:transparent">Public</label>
                <div class="custom-control custom-radio">
                    <input type="radio" id="public_f" name="public" class="custom-control-input" value="f">
                    <label class="custom-control-label" for="public_f">Féminin</label>
                </div>
            </div>
            
            <div class="custom-file mb-5">
                <input type="file" class="custom-file-input" id="photo" name="photo">
                <label class="custom-file-label" for="photo">Choisir une photo</label>

                <!-- Si je suis dans le cadre d'une modification j'affiche l'img actuelle -->

                <?php if(isset($_GET["action"]) && $_GET["action"] == "modification") { ?>
                    <img class="img-fluid" style="width:40px" src="<?php echo $photo; ?>">
                <?php } ?>

            </div>
            <div class="form-group col-md-12">
                <label for="description">Description</label>
                <input type="text" class="form-control" id="description" name="description" value="<?php echo $description; ?>">
            </div>
        </div>
                            
        <?php if(isset($_GET["action"]) && $_GET["action"] == "modification") { ?>                 
            <button type="submit" class="btn btn-primary" name="modifierProduit">Modifier un produit</button>
        <?php } else { ?>
            <button type="submit" class="btn btn-primary" name="ajouterProduit">Ajouter un produit</button>
        <?php } ?>
    </form>
</div>


<?php
require_once("inc/footer.php");
?>