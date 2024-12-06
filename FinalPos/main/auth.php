<?php
$username="root";
$password="";
$database="point_of_sales";

try{
  $pdo=new PDO ("mysql:host=localhost;dbname=$database",$username,$password);
  //set the PDO error mode to exception
  $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 
}catch(PDOException $e){
  echo json_encode(['status'=>'error','message'=>$e->getMessage()]);
}



?>

