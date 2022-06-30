<?php
    mb_internal_encoding("utf8");
    session_start();

    if(empty($_SESSION['id'])){

        try{
            $pdo = new PDO("mysql:dbname=lesson01;host=localhost;", "root","12345");
        } catch(PDOException $e){
            die("<p>申し訳ございません。現在サーバーが混み合っており一時的にアクセスできません。<br>しばらくしてから再度ログインをしてください。</p>
            <a href = 'http://localhost/php_practice/login_mypage/register.php'>ログイン画面へ</a>"
            );
        }

        //プリペアードステートメントでSQL文（dbとpostデータを照合。selectとwhere）
        $stmt = $pdo -> prepare("select * from login_mypage where mail = ? && password = ?");

        //bindValueメソッドでパラメータセット
        $stmt -> bindValue(1, $_POST["mail"]);
        $stmt -> bindValue(2, $_POST["password"]);

        //execute
        $stmt -> execute();
        $pdo = NULL;    //DBから切断

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
            header("Location:error_login.php");
        }

        //ログイン状態保持にチェックありの場合は、$SESSION['keep_login']に$_POST['keep_login']を代入
        if(!empty($_POST['keep_login'])){
            $_SESSION['keep_login'] = $_POST['keep_login'];
        }
    }

    if(!empty($_SESSION['id']) && !empty($_SESSION['keep_login'])){             //$_SESSION['id']と$_SESSION['keep_login']が共にあるなら
        setcookie('mail', $_SESSION['mail'], time() + 60*60*24*7);              //$_COOKIE['mail']に$_SESSION['mail']を１週間格納
        setcookie('password', $_SESSION['password'], time() + 60*60*24*7);      //$_COOKIE['password']に$_SESSION['password]を１週間格納
        setcookie('keep_login', $_SESSION['keep_login'], time() + 60*60*24*7);  //$_COOKIE['keep_login']に$_SESSION['keep_login']を１週間格納
    } else if(empty($_SESSION['keep_login'])){                                  //$_SESSION['keep_login']が空のとき
        setcookie('mail','', time() -1);
        setcookie('password', '', time() -1);
        setcookie('keep_login', '', time() -1);                                 //クッキーの各要素を削除（過去の時間を指定）
    }

?>

<!DOCTYPE HTML>
<html lang="ja">

    <head>
        <meta charset="UTF-8">
        <title>マイページ登録</title>
        <link rel="stylesheet" type="text/css" href="mypage.css">
    </head>

    <body>

        <header>
            <img src="4eachblog_logo.jpg">
            <div class="logout"><a href="logout.php">ログアウト</a></div>
        </header>

        <div class="mypage_profile">
            <div class="mypage_profile_contents">
                <h2>会員登録 確認</h2>
                <p>こんにちは！　<?php echo $_SESSION['name']; ?>さん</p>

                <div class="profile_picture">
                    <img src="<?php echo $_SESSION['picture']; ?>">
                </div>

                <div class="box">
                    <div class="mypage_profile_name">
                        <label>氏名：<?php echo $_SESSION['name']; ?></label>
                    </div>
                    <div class="mypage_profile_mail">
                        <label>メール：<?php echo $_SESSION['mail']; ?></label>
                    </div>
                    <div class="mypage_profile_password">
                        <label>パスワード：<?php echo $_SESSION['password']; ?></label>
                    </div>
                </div>

                <div class="mypage_profile_comments">
                    <label><?php echo $_SESSION['comments']; ?></label>
                </div>

                <div class="button">
                    <form action="edit_profile.php" method="post" class="form_center">
                        <input type="hidden" value="<?php echo rand(1,100); ?>" name="from_mypage">
                        <input type="submit" class="edit_button" value="編集する"/>
                    </form>
                </div>


            </div>
        </div>

    </body>

</html>