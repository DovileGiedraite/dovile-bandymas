
<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
<meta charset="utf-8">

<style>
body {
  margin:0;
  background: color #f3ede0;
}  

.pagrindinis {
    background-color: #cbd7d0;
    width:100%;
    height:fit-content;
    margin:auto;
    padding-top:0px;
    padding-bottom: 50px;
}

.mygtukai{
padding-top:20px;

}

.remai {
    border:3px solid lightgray;
    background-color:white;
    padding:40px;
    margin:40px;
    margin-left:10%;
    margin-right:10%;
    border-radius:25px;

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

.lentele {
  width:700px;
  margin:auto;


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

a {
    color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  background-color: #4f6455;

}

  table, th, td {
    width:fit-content;
    height: 60px;
  border: 1px solid black;
  border-collapse: collapse;
  padding: 5px;
  text-align: center;
}




  </style>

</head>
<body>

<div class="pagrindinis">

<div class="mygtukai">
<ul>
  <li><a  href="pagrindinis.php">Vartotojų puslapis</a></li>
  <li><a href="filmai.php">Įkelti filmus</a></li>
  <li><a href="atsijungti.php">Atsijungti</a></li>
  <!-- <li><a href="#about">About</a></li> -->
</ul>
</div>

<h1 class="antraste">ADMINISTRACIJOS PUSLAPIS</h1>
<div class="remai">
<h2>Filmų lentelė</h2>
<div class="lentele">



<?php
require "dbduomenys.php";

try {
    $db=new PDO("mysql:host=$serveris;dbname=filmai", $vardas, $slaptazodis);
    $sql="SELECT filmai.ID, pavadinimas, isleidMetai, kurejai.imone 
    FROM filmai JOIN kurejai ON kurejai.ID=filmai.kurejoID;
    ";
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $rezultatas=$db->query ($sql);
    $objektai=$rezultatas->fetchAll(PDO::FETCH_ASSOC);
    
//query - selectai, kai norime atsakymu visa duomenu bazes lentele
//exec - kai norime tiesiog vykdyti
   echo"<table>";
   echo "<tr>";
   echo "<th> Unikalus Nr. </th>";
   echo "<th> Filmo pavadinimas </th>";
   echo "<th > Autorius</th>";
   echo "<th > Filmo išleidimo data</th>";
   
   echo "<th> Trinti </th>";
   echo "<th> Redaguoti</th>";
   echo "</tr>";
foreach($objektai as $eilute) {
    echo "<tr>";
    echo "<td>".$eilute['ID']." </td>";
    echo "<td>".$eilute['pavadinimas']." </td>";
    echo "<td>".$eilute['imone']." </td>";
    echo "<td>".$eilute['isleidMetai']." </td>";
   
    

    $trinimoNuoroda="trinti.php?id=".$eilute['ID'];
    echo "<td><a href='$trinimoNuoroda'>Trinti</a></td>";
    $redagavimoNuoroda="redaguoti.php?id=".$eilute['ID'];
    echo "<td><a href='$redagavimoNuoroda'>Redaguoti</a></td>";
    echo "</tr>";
}

echo "</table>";

}catch (PDOException $e){
  echo "kalida!!!" .$e->getMessage();
}
?>



</div>
</div> 
<br><br><a  style="margin-left:20px;" href="./">Atgal</a> <br>  
</div>
</body>
</html>

