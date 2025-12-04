<?php

// Views

include_once("view/HomepageView.php");
include_once("view/NotfoundView.php");

include_once("view/GenreView.php");
include_once("view/GameView.php");
include_once("view/PemainView.php");
include_once("view/EventView.php");

$action = $_GET["action"] ?? "list";
$dataId = $_GET["id"] ?? null;
$page = $_GET["page"] ?? "home";
$title = "Gaming Lounge";
$body = "";

$view = "";
    
// Choose the view according to the page parameter
switch ($page) {
    case "genres":
        $view = new GenreView();
        break;
    case "games":
        $view = new GameView();
        break;
    case "players":
        $view = new PemainView();
        break;
    case "events":
        $view = new EventView();
        break;
    case "home":
    case "":
        $view = new HomepageView();
        break;
    default:
        $view = new NotfoundView();
    }

    // Render the page if the controller is assigned & available
    if (isset($view)) {
        $body = $view->render($action, $dataId);
    }

?>

<!doctype html>

<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width,initial-scale=1" />

        <!-- Bootstrap CSS -->
        <link href="assets/bootstrap@5.3.8.css" rel="stylesheet" crossorigin="anonymous">

        <!-- JQuery, PopperJS, BootstrapJS -->
        <script src="assets/jquery@3.7.1.js" crossorigin="anonymous"></script>
        <script src="assets/popper@2.11.8.js" crossorigin="anonymous"></script>
        <script src="assets/bootstrap@5.3.8.js" crossorigin="anonymous"></script>

        <!-- Title for website -->
        <title><?= $title ?></title>
    </head>

    <body>
        <?php include_once("view/template/header.php") ?>

        <?= $body ?>

        <?php include_once("view/template/footer.php") ?>
    </body>
</html>