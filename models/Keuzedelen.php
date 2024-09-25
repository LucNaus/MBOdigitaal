<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/docroot.php';
require_once __DOCUMENTROOT__ . '/config/globalvars.php';
require_once __DOCUMENTROOT__ . '/errors/default.php';
require_once __DOCUMENTROOT__ . '/database/dbconnection.php';
require_once __DOCUMENTROOT__ . '/vendor/autoload.php';

use Ramsey\Uuid\Uuid;

class Keuzedeel
{
    // insert voegt één nieuwe opleiding toe aan de tabel keuzedeel.
    // Er wordt een UUIDv4 gegeneert als unieke ID.
    // Deze UUID wordt opgeslagen string (niet de snelste methode).
    public static function insert(
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
    ) {
        global $db;

        // Generate a version 4 (random) UUID
        $keuzedeelId = Uuid::uuid4();

        $sql_insert_into_keuzedeel = "INSERT INTO keuzedeel (id, code, title, sbu, description, goalsDescription, preconditions, teachingMethods, certificate, linkVideo, linkKD)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";

        $stmt = $db->prepare($sql_insert_into_keuzedeel);

        if (
            $stmt->execute([
                $keuzedeelId,
                $code,
                $title,
                $sbu,
                $description,
                $goalsDescription,
                $preconditions,
                $teachingMethods,
                $certificate,
                $linkVideo,
                $linkKD == "" ? null : $linkKD,
            ])
        ) {
            return true;
        } else {
            return false;
        }
    }

    // select selecteert één keuzedeel op basis van een gegeven id.
    // Er wordt een associative array ($keuzedeel["id"]) van de opleiding gereturneerd.
    public static function select($id)
    {
        global $db;

        $sql_select_keuzedelen_by_id = "SELECT * FROM keuzedeel WHERE id=?;";

        $stmt = $db->prepare($sql_select_keuzedelen_by_id);

        if ($stmt->execute([$id])) {
            $keuzedelen = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($keuzedelen as $keuzedeel) {
                return $keuzedeel;
            }
        }
    }

    // selectAll selecteert alle opleidingen geordend op code.
    // Er wordt een associative array met meerdere rijen gereturneerd.
    public static function selectAll()
    {
        global $db;

        $sql_selectAll_keuzedelen = "SELECT * FROM keuzedeel ORDER by code;";

        $stmt = $db->prepare($sql_selectAll_keuzedelen);

        if ($stmt->execute()) {
            $keuzedelen = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $keuzedelen;
        }
    }

    // update werkt de informatie van een record van een bepaalde id bij.
    // De functie returneerd true als dit gelukt is en false als het niet
    // gelukt is.
    public static function update(
        $id,
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
    ) {
        global $db;

        $sql_update_keuzedeel_by_id = "UPDATE keuzedeel
        SET code=?, title=?, sbu=?, description=?, goalsDescription=?, preconditions=?, teachingMethods=?, certificate=?, linkVideo=?, linkKD=?
        WHERE id=?";

        $stmt = $db->prepare($sql_update_keuzedeel_by_id);

        if (
            $stmt->execute([
                $code,
                $title,
                $sbu,
                $description,
                $goalsDescription,
                $preconditions,
                $teachingMethods,
                $certificate,
                $linkVideo,
                $linkKD == "" ? null : $linkKD,
                $id
            ])
        ) {
            return true;
        } else {
            return false;
        }

    }

    // delete verwijdert een record uit de tabel keuzedeel met een bepaald id.
    // De functie returneert true als dit gelukt is en false als dit niet gelukt is.
    public static function delete($id)
    {
        global $db;

        $sql_delete_keuzedeel_by_id = "DELETE FROM keuzedeel WHERE id=?;";
        $stmt = $db->prepare($sql_delete_keuzedeel_by_id);
        if ($stmt->execute([$id])) {
            return true;

        } else {
            return false;
        }
    }

}