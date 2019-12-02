<?php
include "../php/MysqlUtils.php";


//产生固定长度的字符串
function ran_str($length){
    $pattern = '1234567890qwertyuiopasdfghjklzxcvbnm';
    $string='';
    $str_len = strlen($pattern);
    for ($s=0;$s<$length;$s++){
        $string .= $pattern{mt_rand(0,$str_len-1)};
    }
    return $string;
}
//产生符合语义的中文名
function ran_china_name($length){
    $xing = array('赵','钱','孙','李','周','吴','郑','王','冯','程','猪','卫','蒋','沈','韩','杨');
    $ming = array('虎','狼','鼠','鹿','貂','猴','马','狗','狐','熊','牛','狮','猪','羊','鱼','鹰','虫');
    $string=$xing[mt_rand(0,count($xing)-1)];
    for ($s=1;$s<$length;$s++){
        $string .= $ming[mt_rand(0,count($ming)-1)];
    }
    return $string;
}
//产生固定长度的数字
function ran_digit($length){
    $pattern = '1234567890';
    $string='';
    $str_len = strlen($pattern);
    for ($s=0;$s<$length;$s++){
        $string .= $pattern{mt_rand(0,$str_len-1)};
    }
    return $string;
}
//产生固定长度的中文串
function ran_china_str($length){
    $string='';
    for ($s=0;$s<$length;$s++){
        $a=chr(mt_rand(0xB0,0xD0)).chr(mt_rand(0xA1,0xF0));
        $string.=iconv('GB2312','UTF-8',$a);
    }
    return $string;
}
//往group表中添加数据
function produce_group_data($num){
    $conn = MysqlUtils::getConn();
    $gname = '';
    $statement = $conn->prepare("truncate table address_book.group");
    $statement->execute();
    $statement = $conn->prepare("insert into address_book.group (gname) values (:gname)");
    $statement->bindParam(':gname',$gname);
    for ($a=0;$a<$num;$a++){
        $gname = ran_china_str(2);
        $statement->execute();
    }
    $conn = null;
}
//往user表中添加数据
function produce_user_data($num){
    $conn = MysqlUtils::getConn();
    $statement = $conn->prepare("truncate table address_book.user");
    $statement->execute();
    $statement = $conn->prepare("select gid from address_book.group");
    $statement->execute();
    $gids = $statement->fetchAll(PDO::FETCH_ASSOC); //查出数据库group表中的所有gid
    $name=$company=$email=$comments=$group_id='';
    $statement->execute();
    $statement = $conn->prepare("insert into user (name,company,email,group_id,comments) values (:name,:company,:email,:group_id,:comments)");
    $statement->bindParam(':name',$name);
    $statement->bindParam(':company',$company);
    $statement->bindParam(':email',$email);
    $statement->bindParam(':group_id',$group_id);
    $statement->bindParam(':comments',$comments);
    for ($a=0;$a<$num;$a++){
        $name = ran_china_name(3);
        $company = ran_china_str(8);
        $email = ran_str(6).'@'.ran_str(4).'.com';
        $group_id = $gids[mt_rand(0,count($gids)-1)]['gid'];
        $comments = ran_china_str(10);
        $statement->execute();
    }
    $conn = null;
}
//往phone表中添加数据
function produce_phone_data($num){
    $conn = MysqlUtils::getConn();
    $statement = $conn->prepare("truncate table address_book.phone");
    $statement->execute();
    $statement = $conn->prepare("select uid from address_book.user");
    $statement->execute();
    $uids = $statement->fetchAll(PDO::FETCH_ASSOC); //查出数据库group表中的所有gid
    $phone_number = $uid = '';
    $statement = $conn->prepare("insert into phone (uid,phone_number) values (:uid,:phone_number)");
    $statement->bindParam(':uid',$uid);
    $statement->bindParam(':phone_number',$phone_number);
    for ($a=0;$a<$num;$a++){
        $uid = $uids[mt_rand(0,count($uids)-1)]['uid'];
        $phone_number = '1'.ran_digit(10);
        $statement->execute();
    }
    $conn = null;
}

function produce_data($group_num,$user_num,$phone_num){
    produce_group_data($group_num);
    produce_user_data($user_num);
    produce_phone_data($phone_num);
}

produce_data(10,100,300);
