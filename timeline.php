<?php
//セッションを使い始めるとき
session_start();

//DBを使い始めるとき
require('dbconnect.php');

//サインインをしていなければ
if(!isset($_SESSION['49_LearnSNS']['id'])){
    //signin.phpへの遷移処理
    header('Location: signin.php');
    exit();
}


$sql = 'SELECT * FROM `users` WHERE `id` = ?';
$data = [$_SESSION['49_LearnSNS']['id']];

//dbh（データベースハンドル）にsqlを準備してもらう
$stmt = $dbh->prepare($sql);
$stmt->execute($data);

// ->アロー演算子
// インスタンスのメンバメソッドを呼び出す
$signin_user = $stmt->fetch(PDO::FETCH_ASSOC);

echo '<pre>';
var_dump($signin_user);
echo '</pre>';

//エラー内容を入れておく配列定義
$errors = [];

//投稿ボタンが押されたら
//=POST送信だったら
if (!empty($_POST)){
    //textareaの値を取り出し
    //$_POSTのキーはtextareaタグのname属性を使う
    $feed = $_POST['feed'];
    //投稿が空じゃない場合（!=）
    if($feed != ''){
    //投稿が空の場合
    }else{
    //エラーを出力する
    //feedが空であるというエラーを入れておく
        $errors['feed'] = 'blank';
    }
}

?>
<!--
    inlude（ファイル名）;
    指定されたファイルが指定された箇所に読み込まれる
    Webサービス内で共通するような場所は他のファイルで定義をして、
    さまざまなページから利用可能にするべき

    requireとincludeの違い
    記述にミスがある場合
    requireはエラー
    includeは警告

    プログラムに記述のミスがある場合にそれが致命的なミスになる場合は
    requreを使用（例えばDBを使えない場合は致命的だから）
    includeを使用（例えばヘッダーのデザインだとかサービス自体にはダメージを与えない）

    includeされたファイル内では呼び出し元の変数が利用できる

    $signin['user']
-->

<?php include('layouts/header.php'); ?>
<body style="margin-top: 60px; background: #E4E6EB;">
    <?php include('navbar.php'); ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-3">
                <ul class="nav nav-pills nav-stacked">
                    <li class="active"><a href="timeline.php?feed_select=news">新着順</a></li>
                    <li><a href="timeline.php?feed_select=likes">いいね！済み</a></li>
                </ul>
            </div>
            <div class="col-xs-9">
                <div class="feed_form thumbnail">
                </div>
                <!-- actionが空の場合は自分自身にアクセス-->
                    <form method="POST" action="">
                        <div class="form-group">
                            <!--
                            textareaは複数行のテキスト
                            input type="text"は一行のテキスト
                            -->
                            <textarea name="feed" class="form-control" rows="3" placeholder="Happy Hacking!" style="font-size: 24px;"></textarea><br>
                            <?php if(isset($errors['feed']) && $errors['feed'] == 'blank'): ?>
                            <p class="text-danger">なんかかいてね</p>
                            <?php endif; ?>
                        </div>
                        <input type="submit" value="投稿する" class="btn btn-primary">
                    </form>
                </div>
                <div class="thumbnail">
                    <div class="row">
                        <div class="col-xs-1">
                            <img src="user_profile_img/misae.png" width="40px">
                        </div>
                        <div class="col-xs-11">
                            <a href="profile.php" style="color: #7f7f7f;">野原みさえ</a>
                            2018-10-14
                        </div>
                    </div>
                    <div class="row feed_content">
                        <div class="col-xs-12">
                            <span style="font-size: 24px;">LearnSNSの開発頑張ろう！</span>
                        </div>
                    </div>
                    <div class="row feed_sub">
                        <div class="col-xs-12">
                            <button class="btn btn-default">いいね！</button>
                            いいね数：
                            <span class="like-count">10</span>
                            <a href="#collapseComment" data-toggle="collapse" aria-expanded="false"><span>コメントする</span></a>
                            <span class="comment-count">コメント数：5</span>
                            <a href="edit.php" class="btn btn-success btn-xs">編集</a>
                            <a onclick="return confirm('ほんとに消すの？');" href="#" class="btn btn-danger btn-xs">削除</a>
                        </div>
                        <?php include('comment_view.php'); ?>
                    </div>
                </div>
                <div aria-label="Page navigation">
                    <ul class="pager">
                        <li class="previous disabled"><a><span aria-hidden="true">&larr;</span> Newer</a></li>
                        <li class="next disabled"><a>Older <span aria-hidden="true">&rarr;</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>
<?php include('layouts/footer.php'); ?>
</html>
