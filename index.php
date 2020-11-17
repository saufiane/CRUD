<?php
// On démarre une session
session_start();

// On inclut la connexion à la base
require_once('connect.php');

$sql = 'SELECT * FROM `liste`';

// On prépare la requête
$query = $db->prepare($sql);

// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif
$result = $query->fetchAll(PDO::FETCH_ASSOC);

require_once('close.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maniamicro | Liste des produits</title>

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
                <?php
                    if(!empty($_SESSION['message'])){
                        echo '<div class="alert alert-success" role="alert">
                                '. $_SESSION['message'].'
                            </div>';
                        $_SESSION['message'] = "";
                    }
                ?>
                <h1 class="text-center">Liste des produits</h1>
                <div class="container">
                    <div class="text-right">
                <a href="add.php" class="btn btn-primary">Ajouter un produit</a>
                <a href="index.html" class="btn btn-secondary">Deconnexion</a>
                <br>
                </div>
                </div>

                <table class="table">
                    <thead>
                        <th>ID</th>
                        <th>Lieu d'achat</th>
                        <th>Produit</th>
                        <th>Prix en €</th>
                        <th>Nombre</th>
                        <th>Référence</th>
                        <th>Catégorie</th>
                        <th>Date d'achat</th>
                        <th>Garantie</th>
                        <th>Conseils d'entretien</th>
                        <th>Photo du produit</th>
                        <!-- <th>Actions</th> -->
                    </thead>
                    <tbody>
                        <?php
                        // On boucle sur la variable result
                        foreach($result as $produit){
                        ?>
                            <tr>
                                <td><?= $produit['id'] ?></td>
                                <td><?= $produit['lieu'] ?></td>
                                <td><?= $produit['produit'] ?></td>
                                <td><?= $produit['prix'] ?></td>
                                <td><?= $produit['nombre'] ?></td>
                                <td><?= $produit['reference'] ?></td>
                                <td><?= $produit['categorie'] ?></td>
                                <td><?= $produit['dates'] ?></td>
                                <td><?=$produit['garantie'] ?></td>
                                <td><?=$produit['entretien'] ?></td>
                                <td><?=$produit['ticket_photo'] ?></td>
                                <!-- <td><?= $produit['actions'] ?></td> -->

                            <td>
                                <a href="disable.php?id=<?= $produit['id'] ?>" ></a> 
                                <a href="details.php?id=<?= $produit['id'] ?>" class="btn btn-outline-success">Voir</a> 
                                <a href="edit.php?id=<?= $produit['id'] ?>" class="btn btn-outline-warning">Modifier</a> 
                                <a href="delete.php?id=<?= $produit['id'] ?>" class="btn btn-outline-danger">Supprimer</a>
                            </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <a href="add.php" class="btn btn-primary">Ajouter un produit</a>
                <a href="index.html" class="btn btn-secondary">Deconnexion</a>
            </section>
        </div>
    </main>
</body>
</html>