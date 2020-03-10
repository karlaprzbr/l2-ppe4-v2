<?php
session_start();
require_once("includes/script.php");
include("fonctions_panier.php");
$erreur = false;

$action = (isset($_POST['action'])? $_POST['action']:  (isset($_GET['action'])? $_GET['action']:null ));
if($action !== null)
{
   if(!in_array($action,array('ajout', 'suppression', 'refresh')))
   $erreur=true;

   //récuperation des variables en POST ou GET
   $l = (isset($_POST['l'])? $_POST['l']:  (isset($_GET['l'])? $_GET['l']:null )) ;
   $p = (isset($_POST['p'])? $_POST['p']:  (isset($_GET['p'])? $_GET['p']:null )) ;
   $q = (isset($_POST['q'])? $_POST['q']:  (isset($_GET['q'])? $_GET['q']:null )) ;

   //Suppression des espaces verticaux
   $l = preg_replace('#\v#', '',$l);
   //On verifie que $p soit un float
   $p = floatval($p);

   //On traite $q qui peut etre un entier simple ou un tableau d'entier

   if (is_array($q)){
      $QteArticle = array();
      $i=0;
      foreach ($q as $contenu){
         $QteArticle[$i++] = intval($contenu);
      }
   }
   else
   $q = intval($q);

}

if (!$erreur){
   switch($action){
      Case "ajout":
         ajouterArticle($l,$q,$p);
         break;

      Case "suppression":
         supprimerArticle($l);
         break;

      Case "refresh" :
         for ($i = 0 ; $i < count($QteArticle) ; $i++)
         {
            modifierQTeArticle($_SESSION['panier']['pdt_libelle'][$i],round($QteArticle[$i]));
         }
         break;

      Default:
         break;
   }
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
          <h1>Panier</h1>
            	<?php
              if (!isset($_SESSION['mail'])) {
                echo "<p>Pour continuer, connectez-vous ou créez un compte !</p>";
              } else {

                if (!isset($_SESSION['panier']))
              	{
                  echo "<p>Votre panier est vide</p>";
                } else {
                  $nbArticles=count($_SESSION['panier']['pdt_libelle']);
                  ?>
                  <form method="post" action="panier.php">
                    <table>
                      <tr>
                        <td>Libellé</td>
                        <td>Prix</td>
                        <td>Action</td>
                      </tr>
                  <?php
                  for ($i=0 ;$i < $nbArticles ; $i++) {
                    echo "<tr>";
                    echo "<td>".htmlspecialchars($_SESSION['panier']['pdt_libelle'][$i])."</ td>";
                    echo "<td>".htmlspecialchars($_SESSION['panier']['pdt_prix'][$i])." €</td>";
                    echo "<td><a href=\"".htmlspecialchars("panier.php?action=suppression&l=".rawurlencode($_SESSION['panier']['pdt_libelle'][$i]))."\"><i class=\"fas fa-trash-alt\"></i></a></td>";
                    echo "</tr>";
                  }

                  echo "<tr><td>Total : </td>";
                  echo "<td>".MontantGlobal()."€ </td></tr>";

                  echo "<tr><td><form action=\"panier.php\" method=\"post\">";
                  echo "<input type=\"submit\" class=\"button\" value=\"Payer\" name=\"payer\"/>";
                  echo "</form></td></tr></table></form>";
                }
              }
              if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['payer'])) {

                $bdd = new PDO('mysql:host=localhost;dbname=ppe4_fringuesvp;charset=utf8', 'root', '');
                $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                for ($i = 0; $i < count($_SESSION['panier']['pdt_libelle']); $i++) {
                  $req_pdt = 'DELETE FROM produits WHERE pdt_id = '.$_SESSION['panier']['pdt_id'][$i];
                  $req_com = 'DELETE FROM commentaires WHERE com_pdt_id ='.$_SESSION['panier']['pdt_id'][$i];
                  try {
                    $bdd->exec($req_com);
                    $bdd->exec($req_pdt);
                    echo "<p>Commande validée !</p>";
                    $_SESSION['nb_cmd'] = $_SESSION['nb_cmd'] + 1;
                  } catch(PDOException $e) {
                    echo $req_pdt . "<br>" . $e->getMessage();
                  }
                }
                supprimerPanier();
              }
            	?>
        </div>
    </body>
</html>
