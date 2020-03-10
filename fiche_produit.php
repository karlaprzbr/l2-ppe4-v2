<?php
session_start();
require_once("includes/script.php");
include("fonctions_panier.php");

if(isset($_GET['pdt_id']) AND !empty($_GET['pdt_id'])) {
  $pdt_id = htmlspecialchars($_GET['pdt_id']);
  $produit = $bdd->prepare('SELECT * FROM produits INNER JOIN types_vet ON produits.pdt_type_vet_id = types_vet.type_vet_id INNER JOIN genres_vet ON produits.pdt_genre_vet_id = genres_vet.genre_vet_id INNER JOIN membres ON produits.pdt_membre_id = membres.membre_id WHERE pdt_id =' . $pdt_id);
  $produit->execute(array($pdt_id));
  $pdt_data = $produit->fetch();
  $pdt_libelle = $pdt_data['pdt_libelle'];
  $pdt_prix = $pdt_data['pdt_prix'];
  $pdt_taille = $pdt_data['pdt_taille'];
  $commentaires = $bdd->query('SELECT * FROM commentaires INNER JOIN membres ON commentaires.com_membre_id = membres.membre_id INNER JOIN produits ON commentaires.com_pdt_id = produits.pdt_id WHERE pdt_id ='. $pdt_id .' ORDER BY com_date DESC');
  if ($commentaires !== false ) {
    $com_data = $commentaires->fetchAll();
  }
} else {
  die('Erreur');
}

?>

<!doctype html>
<html>
    <?php require_once("includes/head.php")?>
    <body>
        <?php require_once("includes/includes.php")?>
        <nav>
            <ul>
                <li><a href="femmes.php">FEMMES</a></li>
                <li><a href="hommes.php">HOMMES</a></li>
                <li><a href="tout.php">TOUT</a></li>
            </ul>
            <?php require_once("includes/nav.php")?>
        </nav>

        <div id="main">
          <div id="ficheProduit">
            <h1> <?php echo $pdt_data['pdt_libelle'] ?> </h1>
            <img src="<?php echo $pdt_data['pdt_img_lien'] ?>" alt="Image produit" />
            <p><?php echo $pdt_data['pdt_description'] ?> </p>
            <p>Taille <?php echo $pdt_data['pdt_taille']?></p>
            <p>
              <?php echo $pdt_data['pdt_prix'] ?>€
              <form action="fiche_produit.php?pdt_id=<?= $_GET['pdt_id'] ?>" method="POST"><input type="submit" class="button" name="ajout_panier" value="Ajouter au panier"></form>
              <?php
              if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['ajout_panier'])) {
                ajouterArticle($pdt_id,$pdt_libelle,$pdt_prix);
              }
              ?>
            </p>
          </div>
        </div>
    </body>
</html>
