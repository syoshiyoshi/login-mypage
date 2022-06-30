<?php
    mb_internal_encoding("utf8");
    session_start();

    if(empty($_POST['from_mypage'])){
        header("Location:error_login.php");
    }

?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>マイページ登録</title>
        <link rel="stylesheet" type="text/css" href="edit_profile.css">
    </head>

    <body>

        <header>
            <img src="4eachblog_logo.jpg">
            <div class="logout"><a href="logout.php">ログアウト</a></div>
        </header>

        <div class="mypage_profile">

            <form action="mypage_update.php" method="post" enctype="multipart/form-data">

                <div class="mypage_profile_contents">
                    <h2>会員登録 確認</h2>
                    <p>こんにちは！　<?php echo $_SESSION['name']; ?>さん</p>

                    <div class="profile_picture">
                        <img src="<?php echo $_SESSION['picture']; ?>">
                        <!-- 写真の再UPするなら以下をベースに考える？ -->
                        <!-- <input type="hidden" name="max_file_size" value="1000000" />
                        <input type="file" size="40" name="picture" value=""> -->
                    </div>

                    <div class="box">
                        <div class="mypage_profile_name">
                            <label>氏名：
                            <input type="text" class="formbox" name="re_name" size="30" value="<?php echo $_SESSION['name']; ?>">
                            </label>
                        </div>
                        <div class="mypage_profile_mail">
                            <label>メール：
                            <input type="text"  class="formbox" name="re_mail" size="30" value="<?php echo $_SESSION['mail']; ?>">
                            </label>
                        </div>
                        <div class="mypage_profile_password">
                            <label>パスワード：
                            <input type="text" class="formbox" name="re_password" size="30" value="<?php echo $_SESSION['password']; ?>">
                            </label>
                        </div>
                    </div>

                    <div class="mypage_profile_comments">
                        <label><textarea rows="8" cols="60" name="re_comments"><?php echo $_SESSION['comments']; ?></textarea></label>
                    </div>

                    <div class="button">
                        <input type="submit" class="update_button" value="この内容に変更する"/>
                    </div>

                </div>
            </form>
        </div>

    </body>

</html>