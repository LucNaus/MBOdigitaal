<?php

// url: /admin/educations/add
// Dit is de controller-pagina voor het toevoegen van een nieuwe
// opleiding afkomstig van het formulier /admin/educations/new.

// Globale variablen en functies die op bijna alle pagina's
// gebruikt worden.
require $_SERVER["DOCUMENT_ROOT"] . '/docroot.php';
require __DOCUMENTROOT__ . '/config/globalvars.php';
require __DOCUMENTROOT__ . '/errors/default.php';

// 1. INLOGGEN CONTROLEREN
// Hier wordt gecontroleerd of de gebruiker is ingelogd en de juiste rechten
// heeft. De rollen "applicatiebeheerder" en "administrator" hebben toegang. 
require __DOCUMENTROOT__ . '/models/Auth.php';
Auth::check(["applicatiebeheerder", "administrator"]);

// 2. INPUT CONTROLEREN
// Controleren of de pagina is aangeroepen met behulp van form POST
// en of the variabelen wel bestaan.
// htmlspecialchars() wordt gebruikt om cross site scripting (xss) te voorkomen.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Veldnaam code opvangen en opslaan.
    if (isset($_POST["code"])) {
        $code = htmlspecialchars($_POST["code"]);
    } else {
        $errorMessage = "code is niet ingevuld of ontbreekt.";
        callErrorPage($errorMessage);
    }

    // Veldnaam title opvangen en opslaan.
    if (isset($_POST["title"])) {
        $title = htmlspecialchars($_POST["title"]);
    } else {
        $errorMessage = "titel van het keuzedeel is niet ingevuld of ontbreekt.";
        callErrorPage($errorMessage);
    }

    // Veldnaam level opvangen en opslaan.
    if (isset($_POST["sbu"])) {
        $sbu = htmlspecialchars($_POST["sbu"]);
    } else {
        $errorMessage = "sbu van het keuzedeel is niet ingevuld of ontbreekt.";
        callErrorPage($errorMessage);
    }

    // Veldnaam description opvangen en opslaan.
    if (isset($_POST["description"])) {
        $description = htmlspecialchars($_POST["description"]);
    } else {
        $errorMessage = "Omschrijving van het keuzedeel is niet ingevuld of ontbreekt.";
        callErrorPage($errorMessage);
    }

    // Veldnaam goalsDescription opvangen en opslaan.
    if (isset($_POST["goalsDescription"])) {
        $goalsDescription = htmlspecialchars($_POST["goalsDescription"]);
    } else {
        $errorMessage = "De goalsDescription van het keuzedeel is niet ingevuld of ontbreekt.";
        callErrorPage($errorMessage);
    }

    // Veldnaam preconditions opvangen en opslaan.
    if (isset($_POST["preconditions"])) {
        $preconditions = htmlspecialchars($_POST["preconditions"]);
    } else {
        $errorMessage = "De preconditions van het keuzedeel is niet ingevuld of ontbreekt.";
        callErrorPage($errorMessage);
    }

    // Veldnaam teachingMethods opvangen en opslaan.
    if (isset($_POST["teachingMethods"])) {
        $teachingMethods = htmlspecialchars($_POST["preconditions"]);
    } else {
        $errorMessage = "De teachingMethods van het keuzedeel is niet ingevuld of ontbreekt.";
        callErrorPage($errorMessage);
    }

    // Veldnaam certificate opvangen en opslaan.
    if (isset($_POST["certificate"])) {
        $certificate = htmlspecialchars($_POST["preconditions"]);
    } else {
        $errorMessage = "De certificate van het keuzedeel is niet ingevuld of ontbreekt.";
        callErrorPage($errorMessage);
    }

    // Veldnaam linkVideo opvangen en opslaan.
    if (isset($_POST["linkVideo"])) {
        $linkVideo = htmlspecialchars($_POST["preconditions"]);
    } else {
        $errorMessage = "De linkVideo van het keuzedeel is niet ingevuld of ontbreekt.";
        callErrorPage($errorMessage);
    }

    // Veldnaam linkKD opvangen en opslaan.
    if (isset($_POST["linkKD"])) {
        $linkKD = htmlspecialchars($_POST["preconditions"]);
    } else {
        $errorMessage = "De linkKD van het keuzedeel is niet ingevuld of ontbreekt.";
        callErrorPage($errorMessage);
    }



} else {
    $errorMessage = "De pagina is op onjuiste manier aangeroepen. Geen POST gebruikt.";
    callErrorPage($errorMessage);
}

// 3. CONTROLLER FUNCTIES
// Hier vinden alle acties plaats die moeten gebeuren voordat een nieuwe pagina
// wordt getoond.
require_once __DOCUMENTROOT__ . '/models/Keuzedelen.php';

$result = keuzedeel::insert(
    $code,
    $title,
    $sbu,
    $description,
    $goalsDescription,
    $preconditions,
    $teachingMethods,
    $certificate,
    $linkVideo,
    $linkKD
);

// // Controleren of het gelukt is om een opleiding toe te voegen aan de database.
if ($result) {
    $message = "het keuzedeel $title met code $code is toegevoegd.";
} else {
    $message = "Het is niet gelukt om een nieuwe opleiding toe te voegen.";
    callErrorPage($message);
}

// 4. VIEWS OPHALEN (REDIRECT)
// Er wordt hier een redirect gedaan naar het overzicht van alle opleidingen.
// Het bericht de gebruiker is toegevoegd wordt meegestuurd als variabele.
$url = "/admin/keuzedelen/overview/?message=$message";
header('Location: ' . $url, true);
exit();
