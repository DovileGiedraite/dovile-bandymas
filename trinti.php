<?php

require "dbduomenys.php";

if($_SERVER ['REQUEST_METHOD']=="GET"){
$id=$_GET['id'];

  try {
    $db=new PDO("mysql:host=$serveris;dbname=filmai", $vardas, $slaptazodis); 
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql="DELETE FROM filmai 
    where id=$id";
    $db->exec($sql);
    // echo "<a href=vartotojoPsl.php>Grįžti</a>";
  header("Location:administracija.php");
  }catch (PDOException $e){
    echo "kalida:".$e->getMessage();
  }
}
?>
</body>
</html>
