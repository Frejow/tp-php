<?php
session_start();
$_SESSION["sign_up_errors"] = [];

$errors = [];

$data = [];

include "fonction.php";

if (!isset($_POST["nom"]) || empty($_POST["nom"])) {
    $errors["nom"] = "Ce champs est vide";
}

if (!isset($_POST["prenom"]) || empty($_POST["prenom"])) {
    $errors["prenom"] = "Ce champs est vide";
}

if (!isset($_POST["sexe"]) || empty($_POST["sexe"])) {
    $errors["sexe"] = "De quel sexe êtes-vous ?";
}

if (!isset($_POST["age"]) || empty($_POST["age"])) {
    $errors["age"] = "Veuillez renseigner votre âge";
}

if (isset($_POST["age"]) && !empty($_POST["age"]) && $_POST["age"]<=0) {
    $errors["age"] = "Valeur incorrecte";
}

if (isset($_POST["age"]) && !empty($_POST["age"])) {
    $data["age"] = secure($_POST["age"]);
}

if (isset($_POST["nom"]) && !empty($_POST["nom"])) {
    $data["nom"] = secure($_POST["nom"]);
}

if (isset($_POST["prenom"]) && !empty($_POST["prenom"])) {
    $data["prenom"] = secure($_POST["prenom"]);
}

if(isset($_POST["sexe"]) && !empty($_POST["sexe"])){

    $data["sexe"] = $_POST["sexe"];

    if("F" != $_POST["sexe"] && "M" != $_POST["sexe"] && "A" != $_POST["sexe"]){

        $errors["sexe"] = "Valeur incorrect.";

    }
}

if (isset($_POST["age"]) && !empty($_POST["age"])) {
    $data["age"] = secure($_POST["age"]);
}

if (!isset($_POST["mail"]) || empty($_POST["mail"])) {
    $errors["mail"] = "Le champs d'addresse email est vide.";
}

if (isset($_POST["mail"]) && !empty($_POST["mail"]) && !filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL)) {
    $errors["mail"] = "Entrez une addresse email valide s'il vous plaît";
}


if (isset($_POST["mail"]) && !empty($_POST["mail"]) && (!filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL) || filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL))) {
    $data["mail"] = secure($_POST["mail"]);
}

if (!isset($_POST["motdepasse"]) || empty($_POST["motdepasse"]) && !check_exist_userby_email($_POST["mail"])) {
    $errors["motdepasse"] = "Le champs du mot de passe est vide.";
}

if (isset($_POST["motdepasse"]) && !empty($_POST["motdepasse"]) && strlen(secure($_POST["motdepasse"])) < 8) {
    $errors["motdepasse"] = "Le champs doit contenir minimum 8 caractères. Les espaces ne sont pas pris en compte.";
}

if (isset($_POST["motdepasse"]) && !empty($_POST["motdepasse"]) && strlen(secure($_POST["motdepasse"])) >= 8 && empty($_POST["remotdepasse"]) && !check_exist_userby_email($_POST["mail"])) {
    $errors["remotdepasse"] = "Entrez votre mot de passe à nouveau.";
}

if ((isset($_POST["remotdepasse"]) && !empty($_POST["remotdepasse"]) && strlen(secure($_POST["motdepasse"])) >= 8 && $_POST["remotdepasse"] != $_POST["motdepasse"])) {
    $errors["remotdepasse"] = "Mot de passe erroné. Entrez le mot de passe du précédent champs";
}

if (
    isset($_POST["motdepasse"]) && !empty($_POST["motdepasse"]) && strlen(secure($_POST["motdepasse"])) >= 8
    && isset($_POST["remotdepasse"]) && !empty($_POST["remotdepasse"])
    && $_POST["remotdepasse"] == $_POST["motdepasse"]
    && !isset($_POST["terms"]) && empty($_POST["terms"])
) {
    $errors["terms"] = "Veuillez cocher cette case s'il vous plaît.";
}

if(check_exist_userby_email($_POST["mail"])){
    $errors["mail"] = "[" . $_POST["mail"] . "] est déjà associé à un compte. Veuillez le changer ou connectez-vous si vous en êtes propriétaire.";
}

setcookie(
    "user_sign_up_data",
    json_encode($data),
    [
        'expires' => time() + 365 * 24 * 3600,
        'path' => '/',
        'secure' => true,
        'httponly' => true,
    ]
);

if (empty($errors)) {

    //echo "Pas d'erreur";

    $database =  _database_login();

    if (is_object($database)) {

        // Ecriture de la requête
        $request_insertion = 'INSERT INTO user(nom, prenom, sexe, age, email, motdepasse) VALUES (:nom, :prenom, :sexe, :age, :email, :motdepasse)';

        // Préparation
        $request_insertion_prepare = $database->prepare($request_insertion);

        // Exécution ! La recette est maintenant en base de données
        $result = $request_insertion_prepare->execute([
            'nom' => $_POST["nom"],
            'prenom' => $_POST["prenom"],
            'sexe' => $_POST["sexe"],
            'age' => $_POST["age"],
            'email' => $_POST["mail"],
            'motdepasse' => sha1($_POST["motdepasse"])
        ]);

        if ($result) {

            header("location: inscription.php?success=Inscription effectuée avec succès. Veuillez vous connecter.");
        } else {

            header("location: inscription.php?error=Oupss!!! Une erreur s'est produite lors de l'enregistrement de l'utilisateur. Veuillez réessayer ou contacter l'admin du site.");
        }
    } else {

        header("location: inscription.php?error=" . $database);
    }
} else {

    $_SESSION["sign_up_errors"] = $errors;

    header("location: inscription.php");
}

