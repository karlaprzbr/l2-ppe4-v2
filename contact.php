<!doctype html>
<html lang="fr">
  <head>
    <!-- META -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

    <!-- POLICES -->
    <link href="https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:500,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Muli:400,400i,800,800i" rel="stylesheet">
    <link href="inc/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link rel="icon" href="img/logo_portfolio.jpg">

    <title>Portfolio de Karla Pérez</title>
  </head>
  <body>
    <!-- NAVIGATION -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top border-bottom">
      <div class="container">
        <a class="navbar-brand" href="index.html">Portfolio de Karla Pérez</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Accueil
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="resume/cv.html">À propos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="contact.html">Contact</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="container" id="contact">
    <?php if (!isset($_POST['submit'])) { ?>
        <form method="POST">
            <div class="form-group">
                <label for="lastName">Nom</label>
                <input type="text" class="form-control" id="lastName" name="nom">
            </div>
            <div class="form-group">
                <label for="firstName">Prénom</label>
                <input type="text" class="form-control" id="firstName" name="prenom">
            </div>
            <div class="form-group">
                <label for="mail">Mail</label>
                <input type="email" class="form-control" id="mail" name="mail">
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea name="message" id="message" cols="30" rows="10" class="form-control"></textarea>
            </div>
            <input type="submit" class="btn btn-secondary w-100" value="Envoyer">
        </form>
    <?php } elseif (isset($_POST['submit']) && !empty($_POST['submit'])) {
      $nom = $_POST['nom'];
      $prenom = $_POST['prenom'];
      $mail = $_POST['mail'];
      $message = $_POST['message'];
      $formcontent="From: $nom \n Message: $message";
      $recipient = "karla.perezbrugues@gmail.com";
      $subject = "Contact du Portfolio";
      $mailheader = "From: $mail \r\n";
      mail($recipient, $subject, $formcontent, $mailheader) or die("Une erreur est survenue.");
      echo '<p class="alert alert-success">Votre message a bien été transmis.</p>';
    } ?>
    </div>

    <!-- JavaScript -->
    <!-- jQuery, Popper.js, Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
