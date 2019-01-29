<?php
session_start();
//セッションを利用するための必須ルール
//PHPファイルの先頭に書くこと

//1.$errorsの定義
$errors = [];
//入れ物だけ用意している状態

//check.phpから戻ってきた場合の処理
//POST送信の場合は$_POST、GET送信の場合は$_GETというスーパーグローバル変数が使える
if(isset($_GET['action']) && $_GET['action'] == 'rewrite'){
	//$_POSTに擬似的に値を代入する
	//バリデーションを働かせるため
	$_POST['input_name'] = $_SESSION['49_LearmSNS']['name'];
	$_POST['input_email'] = $_SESSION['49_LearnSNS']['email'];
	$_POST['input_password'] = $_SESSION['49_LearnSNS']['password'];

	//check.phpが空の場合、check.phpへ再遷移してもらう
	$errros['rewrite'] = true;
}

//空チェック
//1.エラーだった場合になんのエラーかを保持する$errorsを定義
//2.送信されたデータと空文字を比較
//3.一致する場合は$errorsにnameをキーにblankという値を保持
//4.エラーがある場合、エラーメッセージを表示

//if(!empty)以降で、POST送信だった場合の状況を定義してしまっていて、エラーが出てしまうので、いったん中に空白を入れる。

$name = '';
$email = '';

//POSTかどうか（単純にアクセスするのはGET送信）
if(!empty($_POST)){
	$name = $_POST['input_name'];
	$email = $_POST['input_email'];
	$password = $_POST['input_password'];
	if($name == ''){
		$errors['name'] = 'blank';
	}
	if($email == ''){
		$errors['email'] = 'blank';
	}
	//パスワードの文字数を数える
	//hogehogeと入力した場合には$countには8が入る
	$count = strlen($password);
	if($password == ''){
		$errors['password'] = 'blank';
	}elseif($count < 4 || 16 < $count){
		$errors['password'] = 'length';
	}
	//$_FILES[キー]['name']; ファイル名
	//$_FILES[キー]['tmp_name']; ファイルデータそのもの
	$file_name='';
	if(!isset($_GET['action'])){
		$file_name = $_FILES['input_img_name']['name'];
	}
	if(!empty())
}




?>