<?php
session_start();

include "fonction.php";
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Articles</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">

    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <link rel="stylesheet" href="css/adminlte.min.css?v=3.2.0">
</head>

<body>

    <div class="content-header">

        <?php
        if (isset($_GET["success"]) && !empty($_GET["success"])) {

        ?>

            <div class="alert alert-success" role="alert">

                <?= $_GET["success"]; ?>

            </div>

        <?php

        }

        $article_list = article_list();

        ?>
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Articles</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container">

            <div class="row">

                <?php

                if (isset($article_list) && !empty($article_list)) {

                    foreach ($article_list as $key => $article) {
                ?>
                        <div class="col-md-4">
                            <div class="card card-widget widget-user-2">

                                <div class="widget-user-header bg-white">

                                    <img class="img-fluid" src="<?= $article_list[$key]["image"] ?>" alt="">

                                </div>
                                <div class="card-footer p-0">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a href="" class="nav-link">
                                                <?= $article_list[$key]["nom"] ?>
                                                <span class="float-right badge bg-white">
                                                    0
                                                    <i class="fas fa-heart"></i>
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                <?php

                    }
                }
                ?>


            </div>
        </div>
    </div>

    <script src="plugins/jquery/jquery.min.js"></script>

    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="js/adminlte.min.js?v=3.2.0"></script>

</body>

</html>