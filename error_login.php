<?php
    session_start();
    if(isset($_SESSION['id'])){
        header("Location:mypage.php");
    }
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>マイページ登録</title>
        <link rel="stylesheet" type="text/css" href="error_login.css">
    </head>

    <body>
        <header>
            <img src="4eachblog_logo.jpg">
            <div class="login"><a href="login.php">ログイン</a></div>
        </header>

        <main>
            <form action="mypage.php" method="post" enctype="multipart/form-data">
                <div class="login_form_contents">

                    <div class="error_comments">
                        メールアドレスまたはパスワードが間違っています。
                    </div>

                    <div class="mail">
                        <label>メールアドレス</label><br>
                        <input type="text" class="formbox" size="40" name="mail" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required>
                    </div>

                    <div class="password">
                        <label>パスワード</label><br>
                        <input type="password" class="formbox" size="40" name="password" pattarn="^[a-zA-Z0-9]{6,}$" required>
                    </div>

                    <div class="keep_login">
                        <input type="checkbox" name="keep_login"> ログイン状態を保持する
                    </div>

                    <div class="enter_login">
                        <input type="submit" class="login_button" size="35" value="ログイン">
                    </div>

                </div>
            </form>
        </main>

        <footer>© 2018 InterNous.inc. All rights reserved</footer>

    </body>

</html>