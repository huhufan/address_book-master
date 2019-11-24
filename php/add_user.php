<?php
$name=$company=$email=$group_id=$comments="";

const servername = "119.23.106.49";
const dbname = "address_book";
const username = "root";
const password = "mysql1998";
$conn = new PDO("mysql:host=" . servername . ";dbname=" . dbname, username, password);
$conn->beginTransaction();
$statement = $conn->prepare("insert into user (name,company,email,group_id,comments) values (:name,:company,:email,:group_id,:comments)");


$name=$_POST["name"];
$company=$_POST["company"];
$email=$_POST["email"];
$group_id=$_POST["group_id"];
$comments=$_POST["comments"];

$statement->execute(array(':name'=>$name,':company'=>$company,':email'=>$email,':group_id'=>$group_id,':comments'=>$comments));
$uid = $conn->lastInsertId();

$sum=$_POST["number"];
$str = 'phone';
$phone_number = '';
$statement = $conn->prepare("insert into phone(uid,phone_number) values(:uid,:phone_number)");
$statement->bindParam(':uid',$uid);
$statement->bindParam(':phone_number',$phone_number);
for ($n=1;$n<=$sum;$n++){
  if (!empty($_POST[$str.$n])){
      $phone_number = $_POST[$str.$n];
      $statement->execute();
  }
}


$conn->commit();
?>
<div id="head"></div>
<div id="user_details" style="color: darkcyan">添加成功！</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
    $("#head").load("/address_book-master/html/head.html");
</script>
