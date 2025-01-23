<?php
include 'lebro.php';
$sid = $_SESSION['id'];
$idP = $_GET['idP'];
$idPC = $_GET['idPC'];
$statutint = "statutrp";


if(isset($_POST['reponseproduit'])) {

$notifproduitperso=$bdd->prepare('SELECT * FROM freeCitizenCommentairesProduit WHERE idAuteur = ? AND idContact = ? AND idArticle = ? AND notification = ?');
$notifproduitperso->execute(array($sid, $_GET['idPC'], $_GET['idP'], ""));
$notifproduitperso = $notifproduitperso->rowCount();

if($notifproduitperso !== 0){

	$notificationproduit = "o"; } else{

	$notificationproduit = ""; }

	     $reponseacquerir = htmlspecialchars($_POST['reponseacquerir']);

         $reponseproduit = $bdd->prepare('INSERT INTO freeCitizenCommentairesProduit (datePost, idContact, idArticle, idAuteur, contact_produit, statutint, notification) VALUES(NOW(),?,?,?,?,?,?)');
         $reponseproduit->execute(array($_GET['idPC'], $_GET['idP'], $sid, $reponseacquerir, $statutint, $notificationproduit));
         $reponseproduit->closeCursor; 
        

header("Location: compte.php?id=".$sid.'&idP='.$idP.'&idPC='.$idPC); }


?>