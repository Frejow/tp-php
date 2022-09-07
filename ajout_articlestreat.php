<?php

session_start();

$_SESSION["add_articles_errors"] = [];

$data = [];

$errors = [];

include "fonction.php";

if (isset($_POST["name"]) && !empty($_POST["name"])) {

    $data["name"] = $_POST["name"];

} else {

    $errors["name"] = "Veuillez remplir correctement ce champs";
}

if (isset($_POST["description"]) && !empty($_POST["description"])) {

    $data["description"] = $_POST["description"];
} else {

    $errors["description"] = "Veuillez remplir correctement ce champs";
}

if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {

    //die(var_dump($_FILES["image"]));

    if ($_FILES["image"]["size"] <= 3000000) {

        $file_name = $_FILES["image"]["name"];

        $file_info = pathinfo($file_name);

        $file_ext = $file_info["extension"];

        $allowed_ext = ["png", "jpg", "jpeg", "gif"];

        if (in_array($file_ext, $allowed_ext)) {

            if (!is_dir("uploads")) {

                mkdir("uploads");
            }

            move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . basename($_FILES['image']['name']));

            $data["image"] = 'uploads/' . basename($_FILES['image']['name']);

        } else {

            $errors["image"] = "L'extension de votre image n'est pas pris en compte. <br> Extensions autorisées [ PNG/JPG/JPEG/GIF ]";
        }
    } else {

        $errors["image"] = "Image trop lourde. Poids maximum autorisé : 3mo";
    }
} else {

    $errors["image"] = "Une erreur s'est produite lors de l'envoi de l'image. Veuillez réessayer";
}

setcookie(
    "add_articles_data",
    json_encode($data),
    [
        'expires' => time() + 365 * 24 * 3600,
        'path' => '/',
        'secure' => true,
        'httponly' => true,
    ]
);

if (empty($errors)) {

    if(add_article($data["name"],  $data["description"],  $data["image"])){

        header("location: articles.php?success=Votre projet a été ajouté avec succès");

    }else{

        header("location: ajout_articles.php?error=Oupss!!! Une erreure s'est produite lors de l'opération d'ajout. Veuillez réessayer ou contactez l'administrateur du site.");

    }

} else {

    $_SESSION["add_articles_errors"] = $errors;

    header("location: ajout_articles.php");
}
