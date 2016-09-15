<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ登録</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="bm_list_view.php">データ一覧</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="bm_insert.php">
  <div class="jumbotron">
   <fieldset>
    <legend>ブックマーク登録画面</legend>
     <label>書籍名：<input type="text" name="bookname" ></label><br>
     <label>書籍URL：<input type="text" name="book_url" ></label><br>
     <label>書籍コメント：<input type="text" name="book_cmt" ></label><br>
     <input type="submit" value="送信">
     <br>
     <div id="output"></div>
    </fieldset>
<!--
<script>
$(function() {
    $("#submit").click(function(){
        //入力の取得
        var text1 = $("bookname").val();
        var text2 = $("book_url").val();
        var text3 = $("book_cmt").val();
        
        var checkOK = true;
        if(text1=="")checkOK = false;
        if(text2=="")checkOK = false;
        if(text3=="")checkOK = false;
        
    if(checkOK){
        $("#output").text("送信しました");
        return true;
    }else{
        $("#output").text("全て入力してください。")
        return false;
    }
        
    });  
 } );  
          
</script>
-->
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
