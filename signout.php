<?php
session_start();

//サインアウト処理
//1.セッションを空にする
//SESSION変数の破棄
//セッションの中の要素を、空で上書きする

//ブラウザのセッションを空にする
$_SESSION = [];
//サーバー内のセッションを空にする
session_destroy();

//2.サインイン画面に遷移する
header("Location: signin.php");
exit();
