
<!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8' />
	<title>新規登録ページ</title>
	
	<meta keywords='flowupLabels, placeholder, plugin, javascript, jquery' />
	<meta description='flowupLabels.js augments the labels in your HTML forms to behave like placeholders, but with a twist.' />
	
	<!-- Load the CSS -->
	<link href='http://fonts.googleapis.com/css?family=Cantarell:400,700' rel='stylesheet' type='text/css'>
    <link href="css/main_login.css" rel='stylesheet' type='text/css'>
    <link href="css/jquery.FlowupLabels.css" rel='stylesheet' type='text/css'>
    
</head>

<body>

	<div id='formContainer'>
    	<div id='formHeader'>
			<h3>サービスアカウントの作成</h3>
		</div>
		<form id='formBody' class='FlowupLabels' action="insert.php" method="post">
			<p class='rf_notice'>
				名前とユーザーIDとパスワードを入力してください。
			</p>
      
			<div class='fl_wrap'>
				<label class='fl_label' for='rf_name'>名前:</label>
				<input class='fl_input' type='text' id='rf_name' name="name" />
			</div>

			<div class='fl_wrap'>
				<label class='fl_label' for='rf_email'>ユーザーID:</label>
				<input class='fl_input' type='text' id='rf_email' name="lid" />
			</div>
			
			<div class='fl_wrap'>
				<label class='fl_label' for='rf_company'>パスワード:</label>
				<input class='fl_input' type='password' id='rf_company' name="lpw"/>
			</div>
			<p>
				<input class='rf_submit' type='submit' value='新規登録' />
			</p>
		</form>
	</div>
	

	
	
	<!-- Load the JS -->
	<script src='js/jquery.min.js'></script>
	<script src='js/jquery.FlowupLabels.js'></script>
	<script src='js/main.js'></script>
</body>
</html>

	