<?php
require 'baza.class.php';
require 'virtualnoVrijeme.php';


$prezime = "";
$ime = $prezime;

$virtualnovrijeme = new virtualnoVrijeme();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['postavivirtualno'])){
        $virtualnovrijeme->postaviVrijeme();
        exit();
    }
    if(isset($_POST['dohvativirtualno'])){
        $virtualnovrijeme->dohvatiVrijeme();
        exit();
    }
    if(isset($_POST['koristivirtualno'])){
        echo $virtualnovrijeme->Koristi();
        exit();
    }
    if(isset($_POST['stopvirtualno'])){
        echo $virtualnovrijeme->Stop();
        exit();
    }
}


?>

<!DOCTYPE html>
<html>
<head>
<title>Virtualno vrijeme sustava</title>
<meta charset="utf-8">
</head>
<body>
<?php
echo "Stvarno vrijeme servera: " . date('d.m.Y H:i:s',
        $vrijeme_servera) . "<br>";
echo "Virtualno vrijeme sustava: " . date('d.m.Y H:i:s',
        $vrijeme_sustava) . "<br>";
?>
</body>
</html>
