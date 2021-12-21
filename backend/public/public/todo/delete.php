<?php

/** auth */

require_once dirname(__FILE__, 4) . '/vendor/autoload.php';

use App\Utils\SessionUtil;
use App\Utils\Common;

SessionUtil::sessionStart();

// ログインチェック
if (!Common::isAuthUser()) {
	header('Location: ../login/login_form.php', true, 301);
	exit;
}

// ログイン情報取得
$login = isset($_SESSION['login']) ? $_SESSION['login'] : null;

?>

<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>削除確認</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
</head>

<body>
	<!-- ナビゲーション -->
	<nav class="navbar navbar-expand-md navbar-dark bg-primary">
		<span class="navbar-brand">TODOリスト</span>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item">
					<a class="nav-link" href="./top.php">作業一覧</a>
				</li>
				<li class="nav-item active">
					<a class="nav-link" href="./entry.php">作業登録 <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<?= Common::h($login['user_name']) ?>さん
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="../login/logout.php">ログアウト</a>
					</div>
				</li>
			</ul>
			<form class="form-inline my-2 my-lg-0" action="./" method="get">
				<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search" value="">
				<button class="btn btn-outline-light my-2 my-sm-0" type="submit">検索</button>
			</form>
		</div>
	</nav>
	<!-- ナビゲーション ここまで -->

	<!-- コンテナ -->
	<div class="container">
		<div class="row my-2">
			<div class="col-sm-3"></div>
			<div class="col-sm-6 alert alert-info">
				下記の項目を削除します。よろしいですか？
			</div>
			<div class="col-sm-3"></div>
		</div>

		<!-- 入力フォーム -->
		<div class="row my-2">
			<div class="col-sm-3"></div>
			<div class="col-sm-6">
				<form action="./delete_action.php" method="post">
					<div class="form-group">
						<label for="item_name">項目名</label>
						<p name="item_name" id="item_name" class="form-control">テストの項目２</p>
					</div>
					<div class="form-group">
						<label for="user_id">担当者</label>
						<p name="user_id" id="user_id" class="form-control">テスト花子</p>
					</div>
					<div class="form-group">
						<label for="expire_date">期限</label>
						<p class="form-control" id="expire_date" name="expire_date">2020-02-19
					</div>
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="finished" name="finished" value="1" checked disabled>
						<label for="finished">完了</label>
					</div>

					<input type="submit" value="削除" class="btn btn-danger">
					<input type="button" value="キャンセル" class="btn btn-outline-primary" onclick="location.href='./';">
				</form>
			</div>
			<div class="col-sm-3"></div>
		</div>
		<!-- 入力フォーム ここまで -->

	</div>
	<!-- コンテナ ここまで -->

	<!-- 必要なJavascriptを読み込む -->
	<script src="../js/jquery-3.4.1.min.js"></script>
	<script src="../js/bootstrap.bundle.min.js"></script>

</body>

</html>
