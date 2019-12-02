<div id="head"></div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
    $("#head").load("../html/head.html");
</script>
<?php
$uid=$name=$company=$email=$comments=$group_id="";
$uid = $_POST['uid'];
$name = $_POST['name'];
$company = $_POST['company'];
$email = $_POST['email'];
$comments = $_POST['comments'];
$group_id = $_POST['group_id'];

include "MysqlUtils.php";
$conn = MysqlUtils::getConn();
$statement = $conn->prepare("update user set name = :name,company=:company,email=:email,comments=:comments,group_id=:group_id where uid = :uid");
$statement->execute(array(':uid' => $uid,':name'=>$name,":company"=>$company,':email'=>$email,':comments'=>$comments,':group_id'=>$group_id));


$sum=$_POST["sum"];
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
$conn = null;
?>
<h5 style="color:cadetblue;">更新成功！</h5>
