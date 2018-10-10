<?php

$username='abc';

$pdo=new PDO("mysql:host=localhost;dbname=hxsd;charset=utf8;port=3306","root","1234");

$sql="select id from userS where username=:username";

$stmt=$pdo->prepare($sql);

$data=[':username'=>$username];

$stmt->execute($data);
//统计受影响行数
$stmt->rowCount();

$result=$stmt->fetchAll(PDO::FETCH_ASSOC);

try{
    $username='abc';

    $pdo=new PDO("mysql:host=localhost;dbname=hxsd;charset=utf8;port=3306","root","1234");

    $sql="select id from userS where username=:username";

    $stmt=$pdo->prepare($sql);

    $data=[':username'=>$username];

    $stmt->execute($data);
//统计受影响行数
    $stmt->rowCount();

    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
}catch(PDOException $e){
    $e->getMessage();
}