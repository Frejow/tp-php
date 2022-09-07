<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ajout</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">

    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <link rel="stylesheet" href="css/adminlte.min.css?v=3.2.0">
</head>

<body>
    

<?php

$data = [];

$errors = [];

if (isset($_COOKIE["add_articles_data"]) && !empty($_COOKIE["add_articles_data"])) {

    $data = json_decode($_COOKIE["add_articles_data"], true);
}

if (isset($_SESSION["add_articles_errors"]) && !empty($_SESSION["add_articles_errors"])) {

    $errors = $_SESSION["add_articles_errors"];
}

?>

<div class="">
    <div class="card-body login-card-body">

        <?php

        if (isset($_GET["error"]) && !empty($_GET["error"])) {

        ?>

            <div class="alert alert-danger" role="alert">

                <?= $_GET["error"]; ?>

            </div>

        <?php

        }

        ?>


        <div class="row">

            <div class="col"></div>

            <div class="col-8">


                <form action="ajout_articlestreat.php" method="post" novalidate enctype="multipart/form-data">

                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Ajouter un article</h3>
                        </div>
                        <form>
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="article_name">Nom de l'article</label>
                                    <input type="text" class="form-control" name="name" id="article_name" placeholder="Veuillez entrer le nom de votre article" value="<?php echo (isset($data["name"]) && !empty($data["name"])) ? $data["name"] : ""; ?>">

                                    <?php
                                    if (isset($errors["name"]) && !empty($errors["name"])) {
                                        echo "<p class='text-danger'>" . $errors["name"] . "</p>";
                                    }
                                    ?>

                                </div>

                                <div class="form-group">
                                    <label for="article_description">Description</label>
                                    <textarea class="form-control" rows="3" name="description" id="article_description" placeholder="Décrivez l'article en quelques mots"><?php echo (isset($data["description"]) && !empty($data["description"])) ? $data["description"] : ""; ?></textarea>

                                    <?php
                                    if (isset($errors["description"]) && !empty($errors["description"])) {
                                        echo "<p class='text-danger'>" . $errors["description"] . "</p>";
                                    }
                                    ?>

                                </div>

                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="image" id="image">
                                        <label class="custom-file-label" for="image">Sélectionner une image</label>
                                    </div>

                                    <?php
                                    if (isset($errors["image"]) && !empty($errors["image"])) {
                                        echo "<p class='text-danger'>" . $errors["image"] . "</p>";
                                    }
                                    ?>

                                </div>

                            </div>
                            <div class="card-footer">
                                <input type="submit" class="btn btn-primary" value="Ajouter">
                                <input type="reset" class="btn btn-danger" value="Annuler">
                            </div>
                        </form>
                    </div>

                </form>

            </div>

            <div class="col"></div>

        </div>

    </div>

</div>

<script src="plugins/jquery/jquery.min.js"></script>

    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="js/adminlte.min.js?v=3.2.0"></script>

</body>

</html>