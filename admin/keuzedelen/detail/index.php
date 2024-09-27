<?php

// url: /admin/roles/detail
// Dit is de controller-pagina voor het genereren van een detailpagina van
// één opleiding.

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
// Controleren of de pagina is aangeroepen met behulp van een link (GET).
// Op dit moment hier niet van toepassing.
// De ID van de opleiding wordt hier opgevangen. 
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Veldnaam id opvangen en opslaan.
    if(isset($_GET["id"])) {
        $id = htmlspecialchars($_GET["id"]);
    }
    else {
        $errorMessage = "De id van de rol is niet meegegeven.";
        callErrorPage($errorMessage);
    }
}
else {
    $errorMessage = "De pagina is op onjuiste manier aangeroepen. Geen GET gebruikt.";
    callErrorPage($errorMessage);
}

// 3. CONTROLLER FUNCTIES
// Hier vinden alle acties plaats die moeten gebeuren om de juiste
// informatie te bewerken.
require_once __DOCUMENTROOT__ . '/models/Keuzedelen.php';

$keuzedeel = keuzedelen::select($id);


// 4. VIEWS OPHALEN
// De HTML-pagina (view) wordt hier opgehaald.
// $title is de titel van de html pagina.
$title = "keuzedelen detailoverzicht";
$id = $keuzedeel["id"];
$code = $keuzedeel["code"];
$title = $keuzedeel["title"];
$sbu = $keuzedeel["sbu"];
$description = $keuzedeel["description"];
$goalsDescription = $keuzedeel["goalsDescription"];
$preconditions = $keuzedeel["preconditions"];
$teachingMethods = $keuzedeel["teachingMethods"];
$certificate = $keuzedeel["certificate"];
$linkVideo = $keuzedeel["linkVideo"];
$linkKD = $keuzedeel["linkKD"];
$editUrl = "/admin/keuzedelen/edit/";
$overviewUrl = "/admin/keuzedelen/overview/";
require __DOCUMENTROOT__ . '/views/admin/keuzedelen/detailedview.php';