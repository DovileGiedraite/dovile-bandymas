<?php
session_start();
require "dbduomenys.php";

?>

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
    width:90%;
    height:fit-content;
    margin:auto;
    padding-top:0px;
    padding-bottom: 50px;
    

.mygtukai {
padding:20px;

}

.lentele {
Width: 600px;
margin:auto;

}
.remai {
    border:3px solid lightgray;
    background-color:white;
    padding:40px;
    margin:40px;
    border-radius:25px;
}

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

/* paieskos */


* {
  box-sizing: border-box;
}

/* Style the search field */
form.example input[type=text] {
  padding: 10px;
  font-size: 17px;
  border: 1px solid grey;
  float: left;
  max-width: 600px;
  background: #f1f1f1;
}

/* Style the submit button */
form.example button {
  float: left;
  width: 200px;
  padding: 10px;
  background: #4f6455;
  color: white;
  font-size: 17px;
  border: 1px solid grey;
  border-left: none; /* Prevent double borders */
  cursor: pointer;
}

form.example button:hover {
  background: #b83330;
}

/* Clear floats */
form.example::after {
  content: "";
  clear: both;
  display: table;
}


.pasieska{
padding-left:100px;


}
  </style>

</head>
<body>

<div class="pagrindinis">

<div class="mygtukai">
<ul>
  <li><a href="atsijungti.php">Atsijungti</a></li>
  <li><a  href="index.php">Home</a></li>
  
  <li><a href="uzsakyti.php">Užsakyti</a></li>
  <li><a href="megstami.php">Mėgstami filmai</a></li>
</ul>

<div>

<div class="pasieska">


        <form class="example" action="paieska.php" method="get">
  <input type="text" placeholder="Search.." name="search">
  <button type="submit">Ieškoti</button>
</form>

</div>  

<?php

// echo "<br>".$_SESSION['vardas']." ".$_SESSION['pavarde']." Sėkmingai prisijungęs vartotojas";




?>
</div>
</div>

<h1 class="antraste">Užsakomų filmų sąrašas</h1>
<div class="remai">
<!-- <h2>Antraštė</h2> -->
<div class="lentele">

<?php




try {
    $db=new PDO("mysql:host=$serveris;dbname=filmai", $vardas, $slaptazodis);
    $sql="SELECT filmai.ID, pavadinimas, isleidMetai, kurejai.imone 
    FROM filmai JOIN kurejai ON kurejai.ID=filmai.kurejoID;
    ";


    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $rezultatas=$db->query ($sql);
    $objektai=$rezultatas->fetchAll(PDO::FETCH_ASSOC);
    
    // gauti megstamus filmus


//query - selectai, kai norime atsakymu visa duomenu bazes lentele
//exec - kai norime tiesiog vykdyti
   echo"<table>";
   echo "<tr>";
   echo "<th> Unikalus Nr. </th>";
   echo "<th> Filmo pavadinimas </th>";
   echo "<th > Autorius</th>";
   echo "<th > Filmo išleidimo data</th>";
   
   echo "<th> Mėgstamas </th>";
   echo "<th> Užsakyti</th>";
   echo "</tr>";
foreach($objektai as $eilute) {
    echo "<tr>";
    echo "<td>".$eilute['ID']." </td>";
    echo "<td>".$eilute['pavadinimas']." </td>";
    echo "<td>".$eilute['imone']." </td>";
    echo "<td>".$eilute['isleidMetai']." </td>";
   
    

    $megstamasNuoroda="megstPrideti.php?id=".$eilute['ID'];
    echo "<td><a href='$megstamasNuoroda'>Mėgstamas</a></td>";
    $uzsakytasNuoroda="uzsakytiPrideti.php?id=".$eilute['ID'];
    echo "<td><a href='$uzsakytasNuoroda'>Užsakyti</a></td>";
    echo "</tr>";
}

echo "</table>";

}catch (PDOException $e){
  echo "kalida!!!" .$e->getMessage();
}
?>





</div>
</div> 
<br><a  style="margin-left:20px;" href="./">Atgal</a> <br>  
</div>
</body>
</html>

