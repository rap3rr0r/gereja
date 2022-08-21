<?php include"dist/conn.php";include"dist/query.php";?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <meta name="description" content="Sistem informasi data umat, keuskupan agung merauke" />
  <meta name="author" content="rap3rr0r">
  
  <title>Login | <?=$app['nama'];?></title>

  <link rel="icon" href="assets/img/<?=$app['logo'];?>" />
  <link rel="stylesheet" href="assets/plugins/login/css/bootstrap.min.css" />
  <link rel="stylesheet" href="assets/plugins/login/css/font-awesome.min.css" />
  <link rel="stylesheet" href="assets/plugins/login/css/style.min.css" />

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-box-body">
    <div class="login-logo" style="padding-top:5px;">
      <img src="assets/img/<?=$app['logo'];?>" width="100" height="100" />
    </div>
    <p class="login-box-msg lead"><?=$app['nama'];?></p>
    <form action="pages/login/act_login.php" method="post">
      <div class="form-group has-feedback">
        <input type="text" name="username" class="form-control" placeholder="Username" required>
        <span class="fa fa-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password" required>
        <span class="fa fa-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8"><a href="#" data-toggle="modal" data-target="#lupabro">Lupa password ?</a></div>
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
        </div>
      </div>
    </form>
  </div>
</div>

<div class="modal fade" id="lupabro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body col-sm-12">
                <div class="text-center">
                    <h3>Lupa Username / Password ?</h3>
                    <p>Silahkan menghubungi Admin dengan menekan tombol <b>"Hubungi"</b> dibawah ini.<br>
                    Tenang, akun Anda akan terjaga oleh kami.</p>
                <a class="btn btn-primary" target="_blank" href="https://bit.ly/2EeenLj"><i class="fa fa-whatsapp"></i> Hubungi</a>
                </div>
            </div>
            <div style='clear:both' class="modal-footer">
                <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-primary"><span aria-hidden="true"><i class=" icon-remove"></i> Tutup</span></button>
            </div>
        </div>
    </div>
</div>

<script src="assets/plugins/login/js/jquery.min.js"></script>
<script src="assets/plugins/login/js/bootstrap.min.js"></script>
</body>
</html>
