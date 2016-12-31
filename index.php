<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>あなたの買い物を迷わせないIoT | Spice Shelf</title>
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="viewport" content="width=640">
	<meta name="format-detection" content="telephone=no">
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/sp2.css">
  <link rel="stylesheet" type="text/css" href="css/sp3.css">

	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="js/function.js"></script>
	<script type="text/javascript" src="js/flipsnap.min.js"></script>
	<script type="text/javascript" src="js/sp.js"></script>
	<script src='js/jquery.min.js'></script>
	<script src='js/jquery.FlowupLabels.js'></script>
	<script src='js/main.js'></script>
</head>
	<body>
		<header>
			<h1><a href="index.php"><img src="images/logo.png" height="35" width="190" alt="Design Company"></h1>
			<nav>
				<ul>
					<li><a href="about.php"><img src="images/gn01b.png" height="15" width="75" alt="PROFILE"></a></li>
					<li><a href="login.php"><img src="images/gn02b.png" height="15" width="75" alt="WORKS"></a></li>
					<li><a href="touroku.php"><img src="images/gn03b.png" height="15" width="75" alt="RECRUIT"></a></li>
					<li><a href="info.php"><img src="images/gn05b.png" height="15" width="70" alt="ACCESS"></a></li>
				</ul>
			</nav>
		</header>

<div class="box">
   <div class="wrapper">
		<span class=js-board></span><span>%</span>
    <div class="box1"><img src="images/oil2.png" width="280" height="420" alt="oil" onmouseover="this.src='images/oil3.png'","this.innerHTML='<span class=js-board></span><span>%</span>'"  onmouseout="this.src='images/oil2.png'">

		</div>

    <div class="box2"><img src="images/pepper2.png" width="280" height="259" alt="pepper" onmouseover="this.src='images/pepper1.png'" onmouseout="this.src='images/pepper2.png'"></div>

    <div class="box3"><img src="images/suger2.png" width="280" height="259" alt="suger" onmouseover="this.src='images/suger1.png'" onmouseout="this.src='images/suger2.png'"></div>

    <div class="box4"><img src="images/soruce2.png" width="280" height="420" alt="pepper" onmouseover="this.src='images/soruce1.png'" onmouseout="this.src='images/soruce2.png'"></div>
  </div>
</div>
</body>

<footer>
<p><img src="images/copyy.png" width="405" height="40" alt="Copyright 2015 Sweet*Time All rights reserved."/></p>
</footer>
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="https://cdn.mlkcca.com/v0.6.0/milkcocoa.js"></script>
<script>
$(function(){
		var milkcocoa = new MilkCocoa('zooiv4gg5gp.mlkcca.com');
		var chatDataStore = milkcocoa.dataStore('esp8266/tout');
		var history = milkcocoa.dataStore('esp8266/tout').history();
		history.sort('DESC'); //ASC昇順、DESC降順
		//history.size(1);//表示されていく数
		history.size(1);
		history.limit(5);
		var i = 0;
		history.on('data', function(data) {
					data.forEach(function(d){
						console.log('d:', d);
						//残量を表示する
						$('.js-board').eq(i++).html(JSON.stringify(d.value));
						var firstgram = "200";
						var nowgram = d.value.v;
						var resultgram = 100;
						// alert(resultgram);
						$(".ttl").append(resultgram);
					});
		});
 history.run();
  });
      </script>
