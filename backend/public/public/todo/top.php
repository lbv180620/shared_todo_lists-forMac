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

# ログイン成功メッセージの初期化
$success_msg = isset($_SESSION['success']) ? $_SESSION['success']['msg'] : null;
unset($_SESSION['success']);

?>

<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>作業一覧</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<style>
		/* ボタンを横並びにする */
		form {
			display: inline-block;
		}

		/* 打消し線を入れる */
		tr.del>td {
			text-decoration: line-through;
		}

		/* ボタンのセルは打消し線を入れない */
		tr.del>td.button {
			text-decoration: none;
		}
	</style>
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
				<li class="nav-item active">
					<a class="nav-link" href="./top.php">作業一覧 <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="./entry.php">作業登録</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<?= Common::h($login['user_name']) ?>さん
					</a>
					<!-- <ul class="dropdown-menu" aria-labelledby="さんnavbarDropdown">
						<div class="dropdown-divider"></div>
						<li><a class="dropdown-item" href="../login/logout.php">ログアウト</a></li>
					</ul> -->
					<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
						<li><a class="dropdown-item" href="#">Action</a></li>
						<li><a class="dropdown-item" href="#">Another action</a></li>
						<li>
							<form action="../login/logout.php" method="post" onsubmit="return checkSubmit()" style="display: inline;">
								<button type="submit" class="btn btn-danger dropdown-item">ログアウト</button>
							</form>
						</li>
					</ul>
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

		<!-- サクセスメッセージアラート -->
		<?php if (isset($success_msg)) : ?>
			<div class="row my-2">
				<div class="col-sm-3"></div>
				<div class="col-sm-6 alert alert-success alert-dismissble fade show">
					<button class="close" data-dismiss="alert">&times;</button>
					<p><?= Common::h($success_msg) ?></p>
				</div>
				<div class="col-sm-3"></div>
			</div>
		<?php endif ?>

		<table class="table table-striped table-hover table-sm my-2">
			<thead>
				<tr>
					<!-- item_name -->
					<th scope="col">項目名</th>
					<!-- family_name + first_name -->
					<th scope="col">担当者</th>
					<!-- registration_date -->
					<th scope="col">登録日</th>
					<!-- expiration_date -->
					<th scope="col">期限日</th>
					<!-- finished_date -->
					<th scope="col">完了日</th>
					<!-- ボタン -->
					<th scope="col">操作</th>
				</tr>
			</thead>

			<tbody>
				<tr class="text-danger">
					<td class="align-middle">
						テストの項目
					</td>
					<td class="align-middle">
						テスト花子 </td>
					<td class="align-middle">
						2020-01-13 </td>
					<td class="align-middle">
						2020-02-12 </td>
					<td class="align-middle">
						未 </td>
					<td class="align-middle button">
						<form action="./complete.php" method="post" class="my-sm-1">
							<input type="hidden" name="item_id" value="1">
							<button class="btn btn-primary my-0" type="submit">完了</button>
						</form>
						<form action="edit.php" method="post" class="my-sm-1">
							<input type="hidden" name="item_id" value="1">
							<input class="btn btn-primary my-0" type="submit" value="修正">
						</form>
						<form action="delete.php" method="post" class="my-sm-1">
							<input type="hidden" name="item_id" value="1">
							<input class="btn btn-primary my-0" type="submit" value="削除">
						</form>
					</td>
				</tr>
				<tr class="del">
					<td class="align-middle">
						テストの項目２ </td>
					<td class="align-middle">
						テスト太郎 </td>
					<td class="align-middle">
						2020-02-13 </td>
					<td class="align-middle">
						2020-02-19 </td>
					<td class="align-middle">
						2020-02-13 </td>
					<td class="align-middle button">
						<form action="./complete.php" method="post" class="my-sm-1">
							<input type="hidden" name="item_id" value="2">
							<button class="btn btn-primary my-0" type="submit">完了</button>
						</form>
						<form action="edit.php" method="post" class="my-sm-1">
							<input type="hidden" name="item_id" value="2">
							<input class="btn btn-primary my-0" type="submit" value="修正">
						</form>
						<form action="delete.php" method="post" class="my-sm-1">
							<input type="hidden" name="item_id" value="2">
							<input class="btn btn-primary my-0" type="submit" value="削除">
						</form>
					</td>
				</tr>
				<tr>
					<td class="align-middle">
						テストの項目３ </td>
					<td class="align-middle">
						テスト花子 </td>
					<td class="align-middle">
						2020-02-13 </td>
					<td class="align-middle">
						2020-02-24 </td>
					<td class="align-middle">
						未 </td>
					<td class="align-middle button">
						<form action="./complete.php" method="post" class="my-sm-1">
							<input type="hidden" name="item_id" value="3">
							<button class="btn btn-primary my-0" type="submit">完了</button>
						</form>
						<form action="edit.php" method="post" class="my-sm-1">
							<input type="hidden" name="item_id" value="3">
							<input class="btn btn-primary my-0" type="submit" value="修正">
						</form>
						<form action="delete.php" method="post" class="my-sm-1">
							<input type="hidden" name="item_id" value="3">
							<input class="btn btn-primary my-0" type="submit" value="削除">
						</form>
					</td>
				</tr>
				<tr>
					<td class="align-middle">
						テストの項目４ </td>
					<td class="align-middle">
						テスト太郎 </td>
					<td class="align-middle">
						2020-02-13 </td>
					<td class="align-middle">
						2020-03-03 </td>
					<td class="align-middle">
						未 </td>
					<td class="align-middle button">
						<form action="./complete.php" method="post" class="my-sm-1">
							<input type="hidden" name="item_id" value="4">
							<button class="btn btn-primary my-0" type="submit">完了</button>
						</form>
						<form action="edit.php" method="post" class="my-sm-1">
							<input type="hidden" name="item_id" value="4">
							<input class="btn btn-primary my-0" type="submit" value="修正">
						</form>
						<form action="delete.php" method="post" class="my-sm-1">
							<input type="hidden" name="item_id" value="4">
							<input class="btn btn-primary my-0" type="submit" value="削除">
						</form>
					</td>
				</tr>
				<tr>
					<td class="align-middle">
						テストの項目５ </td>
					<td class="align-middle">
						テスト太郎 </td>
					<td class="align-middle">
						2020-02-13 </td>
					<td class="align-middle">
						2020-04-01 </td>
					<td class="align-middle">
						未 </td>
					<td class="align-middle button">
						<form action="./complete.php" method="post" class="my-sm-1">
							<input type="hidden" name="item_id" value="5">
							<button class="btn btn-primary my-0" type="submit">完了</button>
						</form>
						<form action="edit.php" method="post" class="my-sm-1">
							<input type="hidden" name="item_id" value="5">
							<input class="btn btn-primary my-0" type="submit" value="修正">
						</form>
						<form action="delete.php" method="post" class="my-sm-1">
							<input type="hidden" name="item_id" value="5">
							<input class="btn btn-primary my-0" type="submit" value="削除">
						</form>
					</td>
				</tr>
			</tbody>
		</table>


	</div>
	<!-- コンテナ ここまで -->

	<script>
		function checkSubmit() {
			if (window.confirm('ログアウトしますか?')) {
				return true;
			} else {
				return false;
			}
		}
	</script>

	<!-- 必要なJavascriptを読み込む -->
	<script src="../js/jquery-3.4.1.min.js"></script>
	<script src="../js/bootstrap.bundle.min.js"></script>

</body>

</html>
