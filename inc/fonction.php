<?php

//
// Fonction permettant de savoir si un internaute est connecté ou pas
//
function internauteEstConnecte(){
    if(!isset($_SESSION["membre"])) return false;
    else return true;
}

//
// Fonction permettant de savoir si un internaute est administrateur du site
//
function internauteEstConnecteEtEstAdmin(){

    if(internauteEstConnecte() && $_SESSION["membre"]["statut"] == 1){
        return true;
    } else {
        return false;
    }
    
}

//
// Fonction permettant de renvoyer le montant total du panier
//
function montantTotal(){
    $total = 0;
    for($i=0; $i < count($_SESSION["panier"]["id_produit"]); $i++){
        $total += $_SESSION["panier"]["quantite"][$i] * $_SESSION["panier"]["prix"][$i];
    }

    return round($total, 2);
}

//
// Fonction permettant de créer un panier si il n'est pas créé
//
function creation_panier() {

    if(!isset($_SESSION["panier"])){
        $_SESSION["panier"] = array();
        $_SESSION["panier"]["id_produit"] = array();
        $_SESSION["panier"]["quantite"] = array();
        $_SESSION["panier"]["prix"] = array();
        $_SESSION["panier"]["titre"] = array();
    }

}


//
// Fonction permettant d'ajouter un produit au panier en session
//
function ajouterProduitDansPanier($id_produit, $quantite, $prix, $titre) {

    creation_panier();

    // le produit est-il déjà dans mon panier?
    $position_produit = array_search($id_produit, $_SESSION["panier"]["id_produit"]);

    // Si le produit est existant en session je modifie juste sa quantite
    if($position_produit !== false) {
        $_SESSION["panier"]["quantite"][$position_produit] += $quantite;
    }else {  // si le produit est inéxistant
        $_SESSION["panier"]["id_produit"][] = $id_produit ; 
        $_SESSION["panier"]["quantite"][] = $quantite; 
        $_SESSION["panier"]["prix"][] = $prix ;
        $_SESSION["panier"]["titre"][] = $titre ;
    }

}

//
// Fonction permettant de retirer un produit du panier
//
function retirerProduitPanier($id_produit_a_supprimer) {

    // Récupérer la position du produit dans la $_SESSION["panier"]
    $position_produit = array_search($id_produit_a_supprimer, $_SESSION["panier"]["id_produit"]);

    if($position_produit !== false) { // Si le produit est bien en session, je le supprime
        array_splice($_SESSION["panier"]["id_produit"], $position_produit);
        array_splice($_SESSION["panier"]["quantite"], $position_produit);
        array_splice($_SESSION["panier"]["prix"], $position_produit);
        array_splice($_SESSION["panier"]["titre"], $position_produit);
    }


}

?>