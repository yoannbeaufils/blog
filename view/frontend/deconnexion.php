<link href="public/css/style.css" rel="stylesheet" />
<div id="deconnexion">
<p>
 Déconnexion prise en compte. A bientôt.<a href="index1.php"><input class="bouton" type="button" value="Retour" ></a>
</p>
</div>
<?php
// Détruit toutes les variables de session
$_SESSION['pseudo'] = NULL;
// Finalement, on détruit la session.
session_destroy();
?>
