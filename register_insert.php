<?php

    mb_internal_encoding("utf8");

    //DB接続
    try{
        $pdo = new PDO("mysql:dbname=lesson01; host=localhost;", "root", "12345");
    }catch(PDOException $e){
        die("<p>申し訳ございません。現在サーバーにアクセスできません。</p>
            <a href = 'http://localhost/php_practice/login_mypage/register.php'>ログイン画面へ</a>"
        );
    }

    //プリペアードステートメントでSQL文
    $stmt = $pdo -> prepare("insert into login_mypage(name, mail, password, picture, comments) values (?, ?, ?, ?, ?)");

    //bindValueメソッドでパラメータセット
    $stmt -> bindValue(1, $_POST['name']);
    $stmt -> bindValue(2, $_POST['mail']);
    $stmt -> bindValue(3, $_POST['password']);
    $stmt -> bindValue(4, $_POST['path_filename']);
    $stmt -> bindValue(5, $_POST['comments']);

    $stmt -> execute();
    $pdo = NULL;

    header('Location:after_register.html');

?>