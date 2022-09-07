<?php

function secure($data)
{
    $data = trim($data);
    $data = strip_tags($data);
    $data = stripslashes($data);
    return $data;
}

function _database_login()
{

    $database = "";

    try {
        $database = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
    } catch (Exception $e) {
        $database = "Une erreur s'est produite lors de la connexion à la base de donnée.";
    }

    return $database;
}

function check_exist_userby_email($email): bool{

    $exist_user = false;

    $database = _database_login();

    $request = "SELECT * FROM user WHERE email=:email";

    $request_prepare = $database->prepare($request);

    $request_execution = $request_prepare->execute(['email' => $email]);

    if($request_execution ){

        $data = $request_prepare->fetchAll(PDO::FETCH_ASSOC);

        if(isset($data) && !empty($data) && is_array($data)){

            $exist_user = true;

        }
    }

    return $exist_user;

}


function add_article(string $nom, string $description, string $image): bool
{

    $add_article = false;


    $database = _database_login();

    $request = "INSERT INTO articles (nom, description, image) VALUES (:nom, :description, :image)";

    $request_prepare = $database->prepare($request);

    $request_execution = $request_prepare->execute(
        [
            'nom' => $nom,
            'description' => $description,
            'image' => $image,
        ]);

    if($request_execution){
        
        $add_article = true;
        
    }

    return $add_article;

}

function article_list(){

    $article_list = [];

    $database = _database_login();

    $request = "SELECT * FROM articles ORDER BY id DESC";

    $request_prepare = $database->prepare($request);

    $request_execution = $request_prepare->execute();

    if($request_execution){

        $data = $request_prepare->fetchAll(PDO::FETCH_ASSOC);

        if(isset($data) && !empty($data) && is_array($data)){

            $article_list = $data;

        }
    }

    return $article_list;

}
