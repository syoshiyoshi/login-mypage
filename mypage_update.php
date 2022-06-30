<?php

    mb_internal_encoding("utf8");

    //セッションスタート
    session_start();

    //DB接続
    try{
        $pdo = new PDO("mysql:dbname=lesson01; host=localhost;", "root", "12345");
    }catch(PDOException $e){
        die("<p>申し訳ございません。現在サーバーにアクセスできません。</p>
            <a href = 'http://localhost/php_practice/login_mypage/register.php'>ログイン画面へ</a>"
        );
    }

    //プリペアードステートメントでSQL文の更新
    $stmt = $pdo -> prepare("update login_mypage set name = ?, mail = ?, password = ?, comments = ? where id = ?");

    //bindValueメソッドでパラメータセット
    $stmt -> bindValue(1, $_POST['re_name']);
    $stmt -> bindValue(2, $_POST['re_mail']);
    $stmt -> bindValue(3, $_POST['re_password']);
    // $stmt -> bindValue(4, $_POST['path_filename']);
    $stmt -> bindValue(4, $_POST['re_comments']);
    $stmt -> bindValue(5, $_SESSION['id']);

    //クリエ実行
    $stmt -> execute();

    //更新後情報をSQL文でセット
    $stmt = $pdo -> prepare("select * from login_mypage where id = ?");

    //bindValueメソッドでパラメータセット
    $stmt -> bindValue(1, $_SESSION["id"]);

    $stmt -> execute(); //クリエ実行
    $pdo = NULL;        //DB切断

    //fetch・while文でデータ取得しsessionに代入
    while($row = $stmt -> fetch()){
        $_SESSION['id'] = $row['id'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['mail'] = $row['mail'];
        $_SESSION['password'] = $row['password'];
        $_SESSION['picture'] = $row['picture'];
        $_SESSION['comments'] = $row['comments'];
    }

    //データが取得できずに（empty）sessionがなければ、リダイレクト（エラー画面）
    if(empty($_SESSION['id'])){
        session_destroy();
        header('Location:error_login.php');
    }

    //idがあるならマイページに戻る
    if(isset($_SESSION['id'])){
        header('Location:mypage.php');
    }

?>
