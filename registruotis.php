
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

<h1 class="antraste">Susikurkite savo paskyrą</h1>
<div class="remai">
<div class="lentele">

<h2>Teisingai užpildykite visas grafas</h2>

<form astion="<?php echo $_SERVER ['PHP_SELF'];?>" method="post">

Vartotojo vardas: <input type="text" name="vardas"><br><br> 
Vartotojo pavarde: <input type="text" name="pavarde"><br><br> 
 
<label for="tipas"><b>Vartotojos tipas: </b></label>
  <select id="tipas" name="tipas">
  <option selected="selected" value="">- - -</option>
    <option value="admin">Administratorius</option>
    <option value="vartotot">Vartotojas</option>
    
   </select>

<br><br>


Slaptažodis: <input type="password" name="slapt"><br><br>      

<input type="submit" value="Pateikti">
</form>

<?php
require "dbduomenys.php";

if($_SERVER ['REQUEST_METHOD']=="POST"){
  $pVardas=$_POST['vardas'];
  $pPavarde=$_POST['pavarde'];
  $tipas=$_POST['tipas'];
  $VartSlaptazodis=$_POST['slapt'];

 
  $uzkoduotasslapt=password_hash($VartSlaptazodis, PASSWORD_DEFAULT);
  try {
    $db=new PDO("mysql:host=$serveris;dbname=filmai", $vardas, $slaptazodis);
   
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql="INSERT INTO vartotojai ( vardas, pavarde, tipas, kodSlaptazodis) 
    VALUES ('$pVardas','$pPavarde','$tipas','$uzkoduotasslapt');";
     
    $db->exec($sql);
   
    echo "<br>Registracija sėkminga<br> <br>";
    echo "<a href=prisijungti.php>Prisijunkite</a>"; 
  }catch (PDOException $e){
    echo "kalida:".$e->getMessage();
  }
}
?>

</div>
</div> 
<br><hr><a  style="margin-left:20px;" href="./">Atgal</a> <br>  
</div>
</body>
</html>

