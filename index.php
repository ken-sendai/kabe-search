<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>かべサーチ</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <!-- 環境変数からAPIキー取得 -->
    <?php
      $api_key = apache_getenv('GCSE_API_KEY');
      $engine_id = apache_getenv('GCSE_ID');
    ?>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>

    <script type="text/javascript" id="script" src="js/search.js"
      data-api-key='<?php echo json_encode($api_key); ?>'
      data-engine-id='<?php echo json_encode($engine_id); ?>'>
    </script>

  </head>

  <body>
  <nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">かべサーチ</a>
    </div>

  </div><!-- /.container-fluid -->
  </nav>


<!-- 検索フォーム -->
  <div class="container">
    <h2>キーワードで壁紙を検索！</h2>
    <form id="form" class="form-group">
      <input type="text" name="query" class="form-control">
      <select name="size" class="btn-group">
        <option value=" 5120 2880">iMac Retina 27inch  (5120×2880)</option>
        <option value=" 4096 2304">iMac Retina 21.5inch  (4096×2304)</option>
        <option value=" 1920 1080" selected>iMac 21.5inch  (1920×1080)</option>
        <option value=" 2880 1800">Macbook Pro Retina 15inch  (2880×1800)</option>
        <option value=" 2560 1600">Macbook Pro Retina 13inch  (2560×1600)</option>
        <option value=" 1280 800">Macbook Pro 13inch  (1280×800)</option>
        <option value=" 2304 1440">Macbook Retina  (2304×1440)</option>
        <option value=" 1440 900">Macbook Air 13inch  (1440×900)</option>
        <option value=" 1366 768">Macbook Air 11inch  (1366×768)</option>
        <option value=" 2732 2048">iPad Pro 12.9inch  (2732×2048)</option>
        <option value=" 2048 1536">iPad Pro 9.7inch ・ iPad air 2  (2048×1536)</option>
        <option value=" 2048 1536">iPad mini 4 ・ 2  (2048×1536)</option>
        <option value=" 1920 1080">iPhone 6s Plus ・ 6 Plus  (1920×1080)</option>
        <option value=" 1334 750">iPhone 6s ・ 6  (1334×750)</option>
        <option value=" 1136 640">iPhone SE  (1136×640)</option>
      </select>
      <input type="submit" class="btn btn-default" value="検索">
    </form>
  </div>

  <!-- 検索結果 -->
  <div class="container">
    <div id="img_field" class="row">
      <!-- ここにimgをajaxで表示 (<img src='URL' , id="modal_up", class='col-lg-3 modalbutton' data-toggle='modal', data-target='#myModal' data-pageUrl= page_url>) -->

    </div>
  </div>

  <!-- モーダル -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title">プレビュー</h4>
        </div>

        <div class="modal-body">
          <!-- 画像URL -->
        </div>

        <div class="modal-footer">
          <!-- 提供サイトURL -->
        </div>

      </div>
    </div>
  </div>

  <!-- 「前へ」「次へ」 -->
  <footer>
    <div class="container">
      <button id="prev" class="btn btn-default">前へ</button>
      <button id="next" class="btn btn-default">次へ</button>
    </div>
  </footer>


  </body>
</html>