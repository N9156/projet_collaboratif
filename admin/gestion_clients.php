<?php
   require_once("../inc/init.php");
   
   ////////////////////////////////////////////
   //////////// RÉCUPÉRATION DES CLIENTS ////////////////
   ////////////////////////////////////////////
   
   $r = $pdo->query("SELECT * FROM membre");
   $r1 = $pdo->query("SELECT * FROM membre WHERE statut = 2 ");
   $r2 = $pdo->query("SELECT m.nom , COUNT(c.id_commande) AS 'nombre de commande'FROM membre m, commande c WHERE m.id_membre=c.id_membre GROUP BY m.nom");
   $r3 = $pdo->query("SELECT nom, prenom FROM membre LIMIT 1");
   $r4 = $pdo->query("SELECT id_membre,pseudo,nom,prenom,email,adresse,ville,code_postal,photo FROM membre LIMIT 1");
   
   
   
   
   
   require_once("inc/header.php");
   
   ?>
<!-- -$r-Liste des membres --------------------------------------------------------------------------------- -->
<div class="col-md-10">
<?php echo $content; ?>
<div class="table-responsive">
   <caption>Liste des membres</caption>
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
         <?php while($membre = $r->fetch(PDO::FETCH_ASSOC)) { ?>
         <tr>
            <?php foreach($membre as $indice => $valeur) {
               if($indice == "photo") { ?>
            <td> <img class="img-fluid" style="width:40px" src="<?php echo $valeur; ?>">  </td>
            <?php  } else{ ?>
            <td> <?php echo $valeur;  ?>  </td>
            <?php } ?>
            <?php } ?>
            <!-- LIEN DE MODIFICATION ET SUPPRESSION -->
            <td>
               <a href="?action=modification&id_membre= <?php echo $membre['id_membre']; ?>" class="badge badge-dark"> Modifier </a>
            </td>
            <td>
               <a href="?action=suppression&id_membre= <?php echo $membre['id_membre']; ?>" class="badge badge-danger"> Supprimer </a>
            </td>
         </tr>
         <?php } ?>
      </tbody>
   </table>
</div>
<!-- -----------$r1--Liste des clients ---------------------------------------------------------------------- -->
<div class="table-responsive">
   <caption>Liste des clients</caption>
   <table class="table col-md-12">
      <thead class="thead-dark">
         <tr>
            <!-- JE RÉCUPÈRE LE NOM DE MES COLONNES EN BDD -->
            <!-- POUR GÉNÉRER LES TH DE MA TABLE HTML DYNAMIQUEMENT -->
            <?php for($i=0; $i< $r1->columnCount(); $i++ ) { ?>
            <th> <?php echo $r1->getColumnMeta($i)["name"]; ?> </th>
            <?php } ?>
            <th> modification </th>
            <th> suppresion </th>
         </tr>
      </thead>
      <tbody>
         <!-- JE FETCH DANS LE JEU DE RÉSULTAT DE MA REQUÊTE SQL (PDOSTATEMENT)-->
         <?php while($membre = $r1->fetch(PDO::FETCH_ASSOC)) { ?>
         <tr>
            <?php foreach($membre as $indice => $valeur) {
               if($indice == "photo") { ?>
            <td> <img class="img-fluid" style="width:40px" src="<?php echo $valeur; ?>">  </td>
            <?php  } else{ ?>
            <td> <?php echo $valeur;  ?>  </td>
            <?php } ?>
            <?php } ?>
            <!-- LIEN DE MODIFICATION ET SUPPRESSION -->
            <td>
               <a href="?action=modification&id_membre= <?php echo $membre['id_membre']; ?>" class="badge badge-dark"> Modifier </a>
            </td>
            <td>
               <a href="?action=suppression&id_membre= <?php echo $membre['id_membre']; ?>" class="badge badge-danger"> Supprimer </a>
            </td>
         </tr>
         <?php } ?>
      </tbody>
   </table>
</div>
<!-- ---$r2------Nombre de commande par client -------------------------------------------------------------------------- -->
<div class="table-responsive">
   <caption>Nombre de commande par client</caption>
   <table class="table col-md-12">
      <thead class="thead-dark">
         <tr>
            <!-- JE RÉCUPÈRE LE NOM DE MES COLONNES EN BDD -->
            <!-- POUR GÉNÉRER LES TH DE MA TABLE HTML DYNAMIQUEMENT -->
            <?php for($i=0; $i< $r2->columnCount(); $i++ ) { ?>
            <th> <?php echo $r2->getColumnMeta($i)["name"]; ?> </th>
            <?php } ?>
            
         </tr>
      </thead>
      <tbody>
         <!-- JE FETCH DANS LE JEU DE RÉSULTAT DE MA REQUÊTE SQL (PDOSTATEMENT)-->
         <?php while($membre = $r2->fetch(PDO::FETCH_ASSOC)) { ?>
         <tr>
            <?php foreach($membre as $indice => $valeur) { ?>
            <td> <?php echo $valeur;  ?>  </td>
            <?php } ?>
            <!-- LIEN POPUP -->
            <td>
               <!--  <a href="?action=popup&id_membre= //<?php //echo $membre['id_membre']; ?>" class="badge badge-dark"> Détail client </a>-->
               <!-- Button trigger modal -->
               <!--https://getbootstrap.com/docs/4.0/components/modal/ -->
               
            </td>
         </tr>
         <?php } ?>
      </tbody>
   </table>
</div>
<!-- ------$r3---Les membres admin-------------$r4------------------------------------------------------------- -->
<div class="table-responsive">
   <caption>Les membres admin</caption>
   <table class="table col-md-12">
      <thead class="thead-dark">
         <tr>
            <!-- JE RÉCUPÈRE LE NOM DE MES COLONNES EN BDD -->
            <!-- POUR GÉNÉRER LES TH DE MA TABLE HTML DYNAMIQUEMENT -->
            <?php for($i=0; $i< $r3->columnCount(); $i++ ) { ?>
            <th> <?php echo $r3->getColumnMeta($i)["name"]; ?> </th>
            <?php } ?>
            <th> popup </th>
         </tr>
      </thead>
      <tbody>
         <!-- JE FETCH DANS LE JEU DE RÉSULTAT DE MA REQUÊTE SQL (PDOSTATEMENT)-->
         <?php while($membre = $r3->fetch(PDO::FETCH_ASSOC)) { ?>
         <tr>
            <?php foreach($membre as $indice => $valeur) { ?>
            <td> <?php echo $valeur;  ?>  </td>
            <?php } ?>
            <!-- LIEN POPUP -->
            <td>
               <!--  <a href="?action=popup&id_membre= //<?php //echo $membre['id_membre']; ?>" class="badge badge-dark"> Détail client </a>-->
               <!-- Button trigger modal -->
               <!--https://getbootstrap.com/docs/4.0/components/modal/ -->
               <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter" id="2">
               Détail admin
               </button>
               <!-- Modal -->
               <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h5 class="modal-title" id="exampleModalLongTitle">FICHE ADMIN</h5>
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                           </button>
                        </div>
                        <div class="modal-body">
                           
                           <?php 
                                
                                
                                echo "<ul>";
                                    while($membre = $r4-> fetch(PDO::FETCH_ASSOC)){ 
                                        
                                   
                                        
                                            echo "<li>" . $membre["id_membre"] . " <br>". "</li>";
                                            echo "<li>". $membre["pseudo"] . " <br>". "</li>";
                                            echo "<li>". $membre["nom"] . " <br>". "</li>";
                                            echo "<li>". $membre["prenom"] . " <br>". "</li>";
                                            echo "<li>". $membre["email"] . " <br>". "</li>";
                                            echo "<li>". $membre["adresse"] . " <br>". "</li>";
                                            echo "<li>". $membre["ville"] . " <br>". "</li>";
                                            echo "<li>". $membre["code_postal"] ." <br>". "</li>";
                                            echo "<li>". $membre["photo"]. "</li>";
                                        
                                    };
                                            
                                       
                                 echo "</ul>";
                                    


        
                            ?>
                        </div>
                        <div class="modal-footer">
                           <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        </div>
                     </div>
                  </div>
               </div>
            </td>
         </tr>
         <?php } ?>
      </tbody>
   </table>
</div>
<?php
   require_once("inc/footer.php");
   ?>