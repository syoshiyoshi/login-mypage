<?php
    mb_internal_encoding("utf8");

    $temp_pic_name = $_FILES['picture']['tmp_name'];                            //アップロードされたファイルを取得
    $original_pic_name = $_FILES['picture']['name'];                            //ファイル名を取得
    $path_filename = './profile_image/'.$original_pic_name;                     //DBへ格納するファイル名のアドレス取得
    move_uploaded_file($temp_pic_name, './profile_image/'.$original_pic_name);  //profile_imageフォルダに画像を格納

?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>マイページ登録</title>
        <link rel="stylesheet" type="text/css" href="register_confirm.css">
    </head>

    <body>
        <header>
            <img src="4eachblog_logo.jpg">
        </header>

        <main>
            <div class="confirm_box">
                <div class="confirm_contents">
                    <h2>会員登録 確認</h2>
                    <p>こちらの内容で登録しても宜しいでしょうか？</p>

                    <div class="confirm_name">
                        <label>氏名：<?php echo $_POST['name'];?></label>
                    </div>

                    <div class="confirm_mail">
                        <label>メール：<?php echo $_POST['mail'];?></label>
                    </div>

                    <div class="confirm_password">
                        <label>パスワード：<?php echo $_POST['password'];?></label>
                    </div>

                    <div class="confirm_picture">
                        <label>プロフィール写真：<?php echo $original_pic_name;?></label>
                    </div>

                    <div class="confirm_comments">
                        <label>コメント：<?php echo $_POST['comments'];?></label>
                    </div>

                    <div class="choose">
                        <div class="confirm_button">
                            <form action="register.php">
                                <input type="submit" class="touroku_ng" value="戻って修正する"/>
                            </form>

                            <form action="register_insert.php" method="post">
                                <input type="submit" class="touroku_ok" value="登録する" />
                                <input type="hidden" value="<?php echo $_POST['name']; ?>" name="name">
                                <input type="hidden" value="<?php echo $_POST['mail']; ?>" name="mail">
                                <input type="hidden" value="<?php echo $_POST['password']; ?>" name="password">
                                <input type="hidden" value="<?php echo $path_filename; ?>" name="path_filename">
                                <input type="hidden" value="<?php echo $_POST['comments']; ?>" name="comments">
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </main>

        <footer>© 2018 InterNous.inc. All rights reserved</footer>

    </body>

</html>