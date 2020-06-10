
<!-- Footer -->
<footer class="page-footer font-small blue pt-4">

  <!-- Footer Links -->
  <div class="container-fluid text-center text-md-left">

    <!-- Grid row -->
    <div class="row">

      <!-- Grid column -->
      <div class="col-md-6 mt-md-0 mt-3">

        <!-- Content -->
        <h5 class="text-uppercase">Ma boutique en ligne</h5>
        <p>The place to be pour trouver la fringue qu'il vous faut</p>

      </div>
      <!-- Grid column -->

      <hr class="clearfix w-100 d-md-none pb-3">

      <!-- Grid column -->
      <div class="col-md-3 mb-md-0 mb-3">

        <!-- Links -->
        <h5 class="text-uppercase">Liens</h5>

        <ul class="list-unstyled">

        <?php if(!internauteEstConnecte()) { ?>
          <li>
            <a href="inscription.php">Inscription</a>
          </li>
          <li>
            <a href="connexion.php">Connexion</a>
          </li>
        <?php } else{ ?>
          <li>
            <a href="profil.php">Mon profil</a>
          </li>
        <?php } ?>
        </ul>

      </div>
      <!-- Grid column -->

      <!-- Grid column -->

    </div>
    <!-- Grid row -->

  </div>
  <!-- Footer Links -->

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">© 2020 Ma boutique en ligne: 
    <a href="https://mdbootstrap.com/"> maboutiqueenligne.com</a>
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="inc/js/app.js"></script>
        </div>
    </body>
</html>