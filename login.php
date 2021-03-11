<?php session_start(); ?>

<?php
	//customerセッション変数を破棄
	unset($_SESSION['site_user']);
	//MySQLデータベースに接続する
	require 'db_conect.php';
	//SQL文を作る（プレースホルダを使った式）
	$sql = "select * from site_user where email = :email and password = :password";
	//プリペアードステートメントを作る
	$stm = $pdo->prepare($sql);
	//プリペアードステートメントに値をバインドする
	$stm->bindValue(':email',$_POST['email'],PDO::PARAM_STR);
	$stm->bindValue(':password',$_POST['password'],PDO::PARAM_STR);
	//SQL文を実行する
	$stm->execute();
	//結果の取得（連想配列で受け取る）
	$result = $stm->fetchAll(PDO::FETCH_ASSOC);
	//customerセッションの設定
	foreach ($result as $row) {
		$_SESSION['site_user'] = [
			'email' => $row['email'], 
			'password' => $row['password']
		];
	}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>ログイン画面</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<?php
	if (isset($_SESSION['site_user'])) {
		echo 'ログインに成功しました。';
	} else {
		echo 'ログイン名またはパスワードが違います。';
	}
	?>
</body>

</html>