<?php

session_start();

?>
<!DOCTYPE html>
<html>
<head>
<title>PRISIJUNGIMAS</title>
<meta charset="utf-8">

<style>
body {
  margin:0;
  background: color #f3ede0;
}  

.pagrindinis {
    background-color: #cbd7d0;
    width:90%;
    height:fit-content;
    margin:auto;
    padding-top:0px;
    padding-bottom: 50px;
}

.mygtukai{


}

.remai {
    border:3px solid lightgray;
    background-color:white;
    padding:40px;
    margin:40px;

}

.antraste {
    text-align: center;
  text-transform: uppercase;
  color: #4f6455;
}

h2 {
    text-align: center;
    color: #b83330;
}


/* navigacija */

ul {
  list-style-type: none;
  margin:0;
  padding-right:3%;
  overflow: hidden;
  background-color: #cbd7d0;

}

li {
  float: right;
  margin:2px;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  background-color: #4f6455;
}

li a:hover {
  background-color: #b83330;
}


  </style>

</head>
<body>

<div class="pagrindinis">

<div class="mygtukai">
<ul>
  <li><a  href="index.html">Home</a></li>
  <!-- <li><a href="#news">News</a></li>
  <li><a href="#contact">Contact</a></li>
  <li><a href="#about">About</a></li> -->
</ul>
</div>

<h1 class="antraste">Prisijunkite prie paskyros</h1>
<div class="remai">
<div class="lentele">

<h2>Suveskite savo duomenis</h2>


<form astion="<?php echo $_SERVER ['PHP_SELF'];?>" method="post">
Vartotojo prisijungimo vardas: <input type="text" name="vardas"><br><br>  
Slaptažodis: <input type="text" name="slaptazodis"><br><br>      

<input type="submit">
</form>

<?php
if($_SERVER['REQUEST_METHOD'] == "POST") {
    $VartVardatas = $_POST['vardas'];
    $vartotojoSlapt = $_POST['slaptazodis'];

    require "dbduomenys.php";


    try {
        $db=new PDO("mysql:host=$serveris;dbname=filmai", $vardas, $slaptazodis);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT ID, vardas, pavarde, tipas, kodSlaptazodis FROM vartotojai WHERE vardas=:vardas1";


        $paruostas = $db->prepare($sql);

        $paruostas->bindParam(":vardas1", $VartVardatas);
        $paruostas->execute();

        $rezultatas = $paruostas->fetchAll(PDO::FETCH_ASSOC);

        $paruostas->execute();

        if(count($rezultatas) > 0) {
            $gautasSlaptazodis = $rezultatas[0]["kodSlaptazodis"];

            if(password_verify($vartotojoSlapt, $gautasSlaptazodis)) {
                 // Sekmingai prisijugta
                $_SESSION['vartotojas'] = $rezultatas[0]['ID'];
                $_SESSION['vardas'] = $rezultatas[0]['vardas'];
                $_SESSION['pavarde'] = $rezultatas[0]['pavarde'];
                $_SESSION['tipas'] = $rezultatas[0]['tipas'];




                if( $_SESSION['tipas'] == "admin") {
                    header("Location:administracija.php");
                } else {
                    header("Location:pagrindinis.php");
                }

            } else {
                echo "Neteisingas slaptažodis arba el. paštas.";
            }
           
        }
    } catch(PDOException $e) {
        echo "Ivyko klaida: " . $e->getMessage();
    }
}

?>



</div>
</div> 
<br><hr><a  style="margin-left:20px;" href="./">Atgal</a> <br>  
</div>
</body>
</html>

