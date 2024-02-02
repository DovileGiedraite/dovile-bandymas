<?php

session_start();
require "dbduomenys.php";


if($_SERVER ['REQUEST_METHOD']=="GET"){
    $VartID=$_SESSION['vartotojas'];
    $FilmID=$_GET['id'];
    
    try {
        $db=new PDO("mysql:host=$serveris;dbname=filmai", $vardas, $slaptazodis);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * from megstami where megstFilmID = $FilmID AND
        megstVartID = $VartID";
        $rezultatas = $db->query($sql);
        $atsakymas = $rezultatas->fetchAll(PDO::FETCH_ASSOC);
        if (count($atsakymas) == 0) {

            $sql="INSERT INTO megstami( megstFilmID, megstVartID) 
            VALUES ($FilmID, $VartID)";
            // echo $sql;
            $db->exec($sql);
            header("Location:megstami.php");

        } else {
            header("Location:pagrindinis.php");

        }
        

        // echo "duomenys apie filmą sėkmingai suvesti";
        // echo "<br><br><a href=administracija.php>Administracijos puslapis</a>";
      }catch (PDOException $e){
        echo "kalida:".$e->getMessage();
        header("Location:pagrindinis.php");

      }
    }
    

?>
