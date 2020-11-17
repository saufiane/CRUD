<?php
// On démarre une session
session_start();

if($_POST){
    if(isset($_POST['produit']) && !empty($_POST['produit'])
    && isset($_POST['prix']) && !empty($_POST['prix'])
    && isset($_POST['lieu']) && !empty($_POST['lieu'])
    && isset($_POST['nombre']) && !empty($_POST['nombre'])
    && isset($_POST['reference']) && !empty($_POST['reference'])
    && isset($_POST['categorie']) && !empty($_POST['categorie'])
    && isset($_POST['dates']) && !empty($_POST['dates'])
    && isset($_POST['garantie']) && !empty($_POST['garantie'])
    && isset($_POST['entretien']) && !empty($_POST['entretien'])
    && isset($_POST['ticket_photo']) && !empty($_POST['ticket_photo'])){
        // On inclut la connexion à la base
        require_once('connect.php');

        // On nettoie les données envoyées
        $produit = strip_tags($_POST['produit']);
        $prix = strip_tags($_POST['prix']);
        $lieu = strip_tags($_POST['lieu']);
        $nombre = strip_tags($_POST['nombre']);
        $reference = strip_tags($_POST['reference']);
        $categorie = strip_tags($_POST['categorie']);
        $dates = strip_tags($_POST['dates']);
        $garantie = strip_tags($_POST['garantie']);
        $entretien = strip_tags($_POST['entretien']);
        $ticket_photo = strip_tags($_POST['ticket_photo']);

        $sql = 'INSERT INTO `liste` (`produit`, `prix`, `lieu`, `nombre` , `reference` , `categorie` , `dates` , `garantie` , `entretien` , `ticket_photo`) 
        VALUES (:produit, :prix, :lieu, :nombre, :reference, :categorie, :dates, :garantie, :entretien, :ticket_photo);';

        $query = $db->prepare($sql);

        $query->bindValue(':produit', $produit, PDO::PARAM_STR);
        $query->bindValue(':prix', $prix, PDO::PARAM_STR);
        $query->bindValue(':lieu', $lieu, PDO::PARAM_STR);
        $query->bindValue(':nombre', $nombre, PDO::PARAM_INT);
        $query->bindValue(':reference', $reference, PDO::PARAM_STR);
        $query->bindValue(':categorie', $categorie, PDO::PARAM_STR);
        $query->bindValue(':dates', $dates, PDO::PARAM_STR);
        $query->bindValue(':garantie', $garantie, PDO::PARAM_STR);
        $query->bindValue(':entretien', $entretien, PDO::PARAM_STR);
        $query->bindValue(':ticket_photo', $ticket_photo, PDO::PARAM_STR);
        $query->execute();

        $_SESSION['message'] = "Produit ajouté";
        require_once('close.php');

        header('Location: index.php');
    }else{
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un produit</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <main class="container">
        <div class="row">
            <section class="col-12">
                <?php
                    if(!empty($_SESSION['erreur'])){
                        echo '<div class="alert alert-danger" role="alert">
                                '. $_SESSION['erreur'].'
                            </div>';
                        $_SESSION['erreur'] = "";
                    }
                ?>
                <h1>Ajouter un produit</h1>
                <form method="post">
                    <div class="form-group">
                        <label for="produit">Produit</label>
                        <input type="text" id="produit" name="produit" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="prix">Prix</label>
                        <input type="text" id="prix" name="prix" class="form-control">

                    </div>
                    <div class="form-group">
                        <label for="prix">Lieu</label>
                        <input type="text" id="lieu" name="lieu" class="form-control">

                    </div>
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="number" id="nombre" name="nombre" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="reference">Reference</label>
                        <input type="text" id="reference" name="reference" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="categorie">Categorie</label>
                        <input type="text" id="categorie" name="categorie" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="dates">Date d'achat</label>
                        <input type="text" id="dates" name="dates" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="garantie">Garantie</label>
                        <input type="text" id="garantie" name="garantie" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="entretien">Conseils d'entretien</label>
                        <input type="text" id="entretien" name="entretien" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="ticket_photo">Photo du produit</label>
                        <input type="file" id="ticket_photo" name="ticket_photo" class="form-control">
                    </div>
                    <button class="btn btn-primary">Envoyer</button>
                    <p><a href="index.php">Retour</a>
                </form>
            </section>
        </div>
    </main>
</body>
</html>