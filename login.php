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
        <link rel="stylesheet" type="text/css" href="login.css">
    </head>

    <body>
        <header>
            <img src="4eachblog_logo.jpg">
            <div class="login"><a href="login.php">ログイン</a></div>
        </header>

        <main>
            <form action="mypage.php" method="post" enctype="multipart/form-data">
                <div class="login_form_contents">

                    <div class="mail">
                        <label>メールアドレス</label><br>
                        <input type="text" class="formbox" size="40" name="mail"
                         value="<?php if(!empty($_COOKIE['keep_login'])){
                            echo $_COOKIE['mail'];
                            } else {
                                echo "";
                            };
                            ?>" >
                    </div>

                    <div class="password">
                        <label>パスワード</label><br>
                        <input type="password" class="formbox" size="40" name="password"
                         value="<?php if(!empty($_COOKIE['keep_login'])){
                            echo $_COOKIE['password'];
                          } else {
                              echo "";
                            } ?>" >
                    </div>

                    <div class="keep_login">
                        <input type="checkbox" class="formbox" size="40"
                         name="keep_login" value="keep_login"
                         <?php if(isset($_COOKIE['keep_login'])){
                            echo "checked = 'checked'";
                         }
                        ?>>ログイン状態を保持する
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