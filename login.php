<?php
// recupere les donnees du formulaire
$email=$_POST['email'];
$password=$_POST['password'];


// connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=crud','root','');

// requete 
$query = $pdo->query('SELECT * FROM login');
// RETOURNE SOUS FORME DE TABLEAU ASSOCIATIF
$resultat = $query->fetch(PDO::FETCH_ASSOC);

// on stocke dans 2 variables les valeurs de la table afin de pouvoir les comparer au valeurs du formaulaire
$emaildb=$resultat['name'];
$passworddb=$resultat['password'];

// condition pour comparer si l'email et le mdp sont valide
if($email===$emaildb && $password===$passworddb) {

    header('location: index.php');
}
else {
    header('location: index.html');
}


?>