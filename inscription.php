<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Test | Inscription</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">

    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <link rel="stylesheet" href="css/adminlte.min.css?v=3.2.0">
    <script nonce="606b050b-0076-4339-82ed-db4f2e1da2c7">
        (function(w, d) {
            ! function(a, e, t, r) {
                a.zarazData = a.zarazData || {};
                a.zarazData.executed = [];
                a.zaraz = {
                    deferred: []
                };
                a.zaraz.q = [];
                a.zaraz._f = function(e) {
                    return function() {
                        var t = Array.prototype.slice.call(arguments);
                        a.zaraz.q.push({
                            m: e,
                            a: t
                        })
                    }
                };
                for (const e of ["track", "set", "ecommerce", "debug"]) a.zaraz[e] = a.zaraz._f(e);
                a.zaraz.init = () => {
                    var t = e.getElementsByTagName(r)[0],
                        z = e.createElement(r),
                        n = e.getElementsByTagName("title")[0];
                    n && (a.zarazData.t = e.getElementsByTagName("title")[0].text);
                    a.zarazData.x = Math.random();
                    a.zarazData.w = a.screen.width;
                    a.zarazData.h = a.screen.height;
                    a.zarazData.j = a.innerHeight;
                    a.zarazData.e = a.innerWidth;
                    a.zarazData.l = a.location.href;
                    a.zarazData.r = e.referrer;
                    a.zarazData.k = a.screen.colorDepth;
                    a.zarazData.n = e.characterSet;
                    a.zarazData.o = (new Date).getTimezoneOffset();
                    a.zarazData.q = [];
                    for (; a.zaraz.q.length;) {
                        const e = a.zaraz.q.shift();
                        a.zarazData.q.push(e)
                    }
                    z.defer = !0;
                    for (const e of [localStorage, sessionStorage]) Object.keys(e || {}).filter((a => a.startsWith("_zaraz_"))).forEach((t => {
                        try {
                            a.zarazData["z_" + t.slice(7)] = JSON.parse(e.getItem(t))
                        } catch {
                            a.zarazData["z_" + t.slice(7)] = e.getItem(t)
                        }
                    }));
                    z.referrerPolicy = "origin";
                    z.src = "/cdn-cgi/zaraz/s.js?z=" + btoa(encodeURIComponent(JSON.stringify(a.zarazData)));
                    t.parentNode.insertBefore(z, t)
                };
                ["complete", "interactive"].includes(e.readyState) ? zaraz.init() : a.addEventListener("DOMContentLoaded", zaraz.init)
            }(w, d, 0, "script");
        })(window, document);
    </script>
</head>

<body class="hold-transition register-page">
    <div class="register-box">

        <?php
        if (isset($_GET["error"]) && !empty($_GET["error"])) {
        ?>
            <div class="alert alert-danger" role="alert">
                <?= $_GET["error"]; ?>
            </div>
        <?php
        }
        ?>

        <?php
        if (isset($_GET["success"]) && !empty($_GET["success"])) {
        ?>
            <div class="alert alert-success" role="alert">
                <?= $_GET["success"]; ?>
            </div>
        <?php
        }
        ?>

        <div class="card">
            <div class="card-body register-card-body">
                <h3 class="login-box-msg">Inscription</h3>

                <?php

                $errors = [];

                if (isset($_SESSION["sign_up_errors"]) && !empty($_SESSION["sign_up_errors"])) {
                    $errors = $_SESSION["sign_up_errors"];
                }

                $data = [];

                if (isset($_COOKIE["user_sign_up_data"]) && !empty($_COOKIE["user_sign_up_data"])) {
                    $data = json_decode($_COOKIE["user_sign_up_data"], true);
                }

                ?>

                <form action="inscriptiontreat.php" method="post" novalidate>

                    <div class="input-group mb-3">
                        <input type="text" name="nom" class="form-control" placeholder="Nom" value="<?php echo (isset($data["nom"]) && !empty($data["nom"])) ? $data["nom"] : "" ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>

                    <?php
                    if (isset($errors["nom"]) && !empty($errors["nom"])) {
                        echo "<p style = 'color:red'>" . $errors["nom"] . "</p>";
                    }
                    ?>

                    <div class="input-group mb-3">
                        <input type="text" name="prenom" class="form-control" placeholder="Prénoms" value="<?php echo (isset($data["prenom"]) && !empty($data["prenom"])) ? $data["prenom"] : "" ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>

                    <?php
                    if (isset($errors["prenom"]) && !empty($errors["prenom"])) {
                        echo "<p style = 'color:red'>" . $errors["prenom"] . "</p>";
                    }
                    ?>

                    <div class="input-group mb-3">
                        <label for="sexe" class="form-label">Sexe : </label>

                        <label for="sexe-m">
                            <input type="radio" class="" id="sexe-m" name="sexe" value="M" />
                            Masculin
                        </label>

                        <label for="sexe-f">
                            <input type="radio" class="" id="sexe-f" name="sexe" value="F" />
                            Féminin
                        </label>

                        <label for="sexe-a">
                            <input type="radio" class="" id="sexe-a" name="sexe" value="A" />
                            Autre
                        </label>
                    </div>

                    <?php
                    if (isset($errors["sexe"]) && !empty($errors["sexe"])) {
                        echo "<p style = 'color:red'>" . $errors["sexe"] . "</p>";
                    }
                    ?>

                    <div class="input-group mb-3">
                        <input type="number" name="age" class="form-control" placeholder="Age" value=" <?php echo (isset($data["age"]) && !empty($data["age"])) ? $data["age"] : "" ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>

                    <?php
                    if (isset($errors["age"]) && !empty($errors["age"])) {
                        echo "<p style = 'color:red'>" . $errors["age"] . "</p>";
                    }
                    ?>

                    <div class="input-group mb-3">
                        <input type="email" name="mail" class="form-control" placeholder="Email" value="<?php echo (isset($data["mail"]) && !empty($data["mail"])) ? $data["mail"] : "" ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>

                    <?php
                    if (isset($errors["mail"]) && !empty($errors["mail"])) {
                        echo "<p style = 'color:red'>" . $errors["mail"] . "</p>";
                    }
                    ?>

                    <div class="input-group mb-3">
                        <input type="password" name="motdepasse" class="form-control" placeholder="Créer un mot de passe" value="<?php echo (isset($data["motdepasse"]) && !empty($data["motdepasse"])) ? $data["motdepasse"] : "" ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    <?php
                    if (isset($errors["motdepasse"]) && !empty($errors["motdepasse"])) {
                        echo "<p style = 'color:red'>" . $errors["motdepasse"] . "</p>";
                    }
                    ?>

                    <div class="input-group mb-3">
                        <input type="password" name="remotdepasse" class="form-control" placeholder="Saisir à nouveau le mot de passe" value="<?php echo (isset($data["remotdepasse"]) && !empty($data["remotdepasse"])) ? $data["remotdepasse"] : "" ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    <?php
                    if (isset($errors["remotdepasse"]) && !empty($errors["remotdepasse"])) {
                        echo "<p style = 'color:red'>" . $errors["remotdepasse"] . "</p>";
                    }
                    ?>

                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="agreeTerms" name="terms" value="">
                                <label for="agreeTerms">
                                    J'accepte les <a href="#">termes</a>
                                </label>
                            </div>
                        </div>

                        <?php
                        if (isset($errors["terms"]) && !empty($errors["terms"])) {
                            echo "<p style = 'color:red'>" . $errors["terms"] . "</p>";
                        }
                        ?>

                    </div>

                    <div class="row">
                        <div class="col-6">
                            <button type="reset" class="btn btn-primary btn-block">Annuler</button>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary btn-block">S'inscrire</button>
                        </div>
                    </div>

                </form>
                <a href="index.php?page=sign_in" class="text-center">Déjà inscrit ? Connectez-vous</a>
            </div>

        </div>
    </div>
    <script src="plugins/jquery/jquery.min.js"></script>

    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="js/adminlte.min.js?v=3.2.0"></script>
</body>

</html>