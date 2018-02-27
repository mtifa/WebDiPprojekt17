<?php
require 'baza.class.php';

$json_input = file_get_contents('php://input');
if ($json_input) {
    $_POST = json_decode($json_input, true);
}
$dnevnik = new Dnevnik();


if($_SERVER["REQUEST_METHOD"]=="POST") {
    if(isset($_POST['id_sesije'])) {
        session_id($id_sesije);
        session_start();
        if($id_sesije === "nereganikorisnik"){
            echo 'FALSE';
            exit();
        }
        if(isset($_SESSION['id_sesije'])){
            $vrati = array('korime'=>$_SESSION['korime'],'tipkorisnika'=>$_SESSION['tipkorisnika']);
            echo json_encode($vrati);
        }
        else{
            echo 'FALSE';
        }
    }
    else {
        echo 'FALSE';
    }
}

function getSessionKorIme($korime){
    if(isset($_SESSION['id_sesije'])){
        return $_SESSION['korime'];
    }
    else {
        return false;
    }
}

function getSessionID($input)
{
    return sha1("694200{$input}694200");
}

