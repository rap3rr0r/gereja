<?php
session_start();
if(!isset($_SESSION['username'])) {
    die("<script>window.alert('Oops! Access Ditolak. Anda harus melakukan login dahulu.');
        location=('./')</script>");
}
if($_SESSION['hak_akses']!="1") {
    die("<script>window.alert('Oops! Access Failed, Anda Tidak Memiliki akses.');
        location=('./')</script>");
}

include "dist/conn.php";
include "dist/libb.php";
include "dist/query.php";

$user = mysql_fetch_array(mysql_query("SELECT * FROM tb_user WHERE id='$_SESSION[id]'"));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="description" content="Sistem informasi data umat, keuskupan agung merauke" />
    <meta name="author" content="rap3rr0r">

    <title>Halaman Admin | <?=$app['nama'];?></title>

    <link rel="icon" href="assets/img/<?=$app['logo'];?>" />
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" href="assets/css/theme.css" />
    <link rel="stylesheet" href="assets/css/MoneAdmin.css" />
    <link rel="stylesheet" href="assets/plugins/Font-Awesome/css/font-awesome.css" />

    <link rel="stylesheet" href="assets/plugins/dataTables/dataTables.bootstrap.css" />
    <link rel="stylesheet" href="assets/css/jquery-ui.css" />
    <link rel="stylesheet" href="assets/plugins/uniform/themes/default/css/uniform.default.css" />
    <link rel="stylesheet" href="assets/plugins/inputlimiter/jquery.inputlimiter.1.0.css" />
    <link rel="stylesheet" href="assets/plugins/chosen/chosen.min.css" />
    <link rel="stylesheet" href="assets/plugins/datepicker/css/datepicker.css" />
    <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css" />
    <link rel="stylesheet" href="assets/plugins/login/css/font-awesome.min.css" />
    <link rel="stylesheet" href="assets/css/bootstrap-fileupload.min.css" />
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="padTop53">
    <div id="loader-wrapper">
        <div id="loader"></div>
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
  </div>
    <div id="wrap">
        <div id="top">
            <nav class="navbar navbar-inverse navbar-fixed-top" style="padding-top:10px;background-color:#008d4c;">
                <a data-original-title="Show/Hide Menu" data-placement="bottom" data-tooltip="tooltip" class="accordion-toggle btn btn-default btn-sm visible-xs" data-toggle="collapse" href="#menu" id="menu-toggle"><i class="icon-align-justify"></i></a>
                <header style="padding: 3px 0px 0px 10px">
                    <a href="home.php" class="navbar-brand">
                    <img src="assets/img/<?=$app['logo'];?>" width="25" style="padding-bottom:10px;" /> <strong style="font-size:22pt;color:#eee;"><?=$app['nama'];?></strong></a>
                </header>
                <div style="padding-left:30px" class="navbar-right hidden-xs">
                    <a href="#" class="toggle-fullscreen" title="Full Screen"><strong style="color:#eee;font-size:12pt;"><i class="icon-fullscreen"></i>&nbsp;&nbsp;</strong></a>
                    <a href="#" data-toggle="modal" data-target="#keluar" title="Keluar"><strong style="color:#eee;font-size:14pt;"><i class="icon-signout"></i> Keluar&nbsp;&nbsp;</strong></a>
                </div>
            </nav>
        </div>
        <div id="left">
            <div class="media user-media well-small">
                <a class="user-link" href="?page=profil">
                    <img class="media-object img-thumbnail user-img" alt="User Picture" src="assets/img/<?= $user['avatar']; ?>" width="64" />
                </a>
                <br />
                <div class="media-body">
                    <h5 class="media-heading"> <?= $user['username']; ?></h5>
                    <ul class="list-unstyled user-info">                        
                        <li><a class="btn btn-success btn-xs btn-circle" style="width: 10px;height: 12px;"></a> Online</li>                
                    </ul>
                </div>
                <br />
            </div>
            <ul id="menu" class="collapse">                
                <li class="panel"><a href="home.php"><i class="icon-dashboard"></i> Dashboard</a></li>
                <li><a href="?page=umat"><i class="icon-user"></i> Data Umat<span class="label label-default"><?=$a;?></span></a>
                </li>
                <li class="panel">
                    <a href="#" data-parent="menu" data-toggle="collapse" class="accordion-toggle" data-target="#DDL1-nav">
                        <i class="icon-th-list"></i> Data Keluarga<span class="pull-right"><i class="icon-angle-left"></i></span>
                    </a>
                    <ul class="collapse" id="DDL1-nav">
                        <li><a href="?page=keluarga"><i class="icon-angle-right"></i> Daftar Keluarga<span class="label label-primary pull-right" style="margin-right:20px"><?=$b;?></span></a></li>
                        <li><a href="?page=kepemilikan"><i class="icon-angle-right"></i> Data Kepemilikan</a></li>
                    </ul>
                </li>
                <li><a href="?page=keuskupan"><i class="icon-calendar"></i> Data Keuskupan<span class="label label-success"><?=$c;?></span></a></li>
                <li><a href="?page=pengurus"><i class="icon-exchange"></i> Data Pengurus<span class="label label-danger"><?=$d;?></span></a></li>
                <li class="panel">
                    <a href="#" data-parent="menu" data-toggle="collapse" class="accordion-toggle" data-target="#DDL2-nav">
                        <i class="icon-print"></i> Cetak Surat<span class="pull-right"><i class="icon-angle-left"></i></span>
                    </a>
                    <ul class="collapse" id="DDL2-nav">
                        <li><a href="?page=cetak-kk"><i class="icon-angle-right"></i> Kartu Keluarga</a></li>
                        <li><a href="?page=cetak-sb"><i class="icon-angle-right"></i> Surat Baptis Umat</a></li>
                        <li><a href="?page=cetak-sb"><i class="icon-angle-right"></i> Surat Baptis Keuskupan</a></li>
                        <li><a href="?page=cetak-sn"><i class="icon-angle-right"></i> Surat Nikah</a></li>
                    </ul>
                </li>
                <li class="panel">
                    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#DDL3-nav">
                        <i class=" icon-gear"></i> Data Manajemen<span class="pull-right"><i class="icon-angle-left"></i></span>
                    </a>
                    <ul class="collapse" id="DDL3-nav">
                        <li><a href="?page=agama"><i class="icon-th-large"></i> Agama<span class="label label-primary pull-right" style="margin-right:20px"><?=$h;?></a></li>
                        <li><a href="?page=jabatan"><i class="icon-briefcase"></i> Jabatan<span class="label label-success pull-right" style="margin-right:20px"><?=$e;?></a></li>
                        <li><a href="?page=pendidikan"><i class="icon-tags"></i> Pendidikan<span class="label label-warning pull-right" style="margin-right:20px"><?=$g;?></a></li>
                        <li><a href="?page=status"><i class="icon-list-ul"></i> Status Keluarga<span class="label label-danger pull-right" style="margin-right:20px"><?=$f;?></a></li>
                        <li><a href="?page=status-nikah"><i class="icon-th"></i> Status Nikah<span class="label label-primary pull-right" style="margin-right:20px"><?=$k;?></a></li>
                    </ul>
                </li>
                <li class="panel">
                    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#DDL4-nav">
                        <i class=" icon-gear"></i> Pengaturan<span class="pull-right"><i class="icon-angle-left"></i></span>
                    </a>
                    <ul class="collapse" id="DDL4-nav">
                        <li><a href="?page=aplikasi"><i class="icon-angle-right"></i> Aplikasi</a></li>
                        <li><a href="?page=profil"><i class="icon-angle-right"></i> Profil</a></li>
                    </ul>
                </li>
                <li><a href="#" data-toggle="modal" data-target="#keluar"><i class="icon-signout"></i> Keluar</a></li>
            </ul>
        </div>
        <div id="content">
            <?php 
                $page = (isset($_GET['page']))? $_GET['page'] : "main";
                switch ($page) {
                    case 'umat' : include "pages/umat/data_umat.php"; break;
                    case 'add-umat' : include "pages/umat/add_umat.php"; break;
                    case 'edit-umat' : include "pages/umat/edit_umat.php"; break;
                    case 'lihat-umat' : include "pages/umat/detail_umat.php"; break;

                    case 'keluarga' : include "pages/keluarga/data_keluarga.php"; break;
                    case 'kepemilikan' : include "pages/keluarga/data_kepemilikan.php"; break;
                    case 'lihat-keluarga' : include "pages/keluarga/detail_keluarga.php"; break;
                    case 'add-kepemilikan' : include "pages/keluarga/add_kepemilikan.php"; break;
                    case 'edit-kepemilikan' : include "pages/keluarga/edit_kepemilikan.php"; break;
                    case 'detail-kepemilikan' : include "pages/keluarga/detail_kepemilikan.php"; break;

                    case 'keuskupan' : include "pages/keuskupan/data_keuskupan.php"; break;
                    case 'add-keuskupan' : include "pages/keuskupan/add_keuskupan.php"; break;
                    case 'add-surat' : include "pages/keuskupan/add_keuskupan.php"; break;
                    case 'lihat-keuskupan' : include "pages/keuskupan/detail_keuskupan.php"; break;

                    case 'pengurus' : include "pages/pengurus/data_pengurus.php"; break;

                    case 'cetak-kk' : include "pages/cetak/data_kk.php"; break;
                    case 'cetak-sb' : include "pages/cetak/data_sb.php"; break;
                    case 'cetak-sn' : include "pages/cetak/data_sn.php"; break;

                    case 'agama' : include "pages/manajemen/data_agama.php"; break;
                    case 'jabatan' : include "pages/manajemen/data_jabatan.php"; break;
                    case 'pendidikan' : include "pages/manajemen/data_pendidikan.php"; break;
                    case 'status' : include "pages/manajemen/data_status.php"; break;
                    case 'status-nikah' : include "pages/manajemen/data_status_nikah.php"; break;

                    case 'aplikasi' : include "pages/pengaturan/aplikasi.php"; break;
                    case 'profil' : include "pages/pengaturan/profil.php"; break;

                    case 'logout' : include "pages/login/act_logout.php"; break;            
                    default : include "dashboard.php"; break;
                }
            ?>
        </div>
    </div>

    <div class="col-sm-12">
        <div class="modal fade" id="keluar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><i class="icon-signin"></i> Konfirmasi</h4>
                    </div>
                    <div class="modal-body">
                       <form action="?page=logout" method="POST" role="form">
                            <div class="form-group text-center">
                                <p>Anda yakin akan keluar ?</p>
                                <button type="submit" class="btn btn-warning">Keluar</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                            </div>                   
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="footer">
        <p style="color: #3b3d38;font-weight: bold;"><?=date("Y");?> &copy; <?=$app['nama'];?>. Made with <img src="assets/img/love.gif" width="25"></i></p>
    </div>

    <script src="assets/js/jquery-2.0.3.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/modernizr-2.6.2-respond-1.1.0.min.js"></script>

    <script src="assets/plugins/select2/js/select2.full.min.js"></script>
    <script src="assets/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="assets/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script src="assets/js/jquery-ui.min.js"></script>
    <script src="assets/plugins/uniform/jquery.uniform.min.js"></script>
    <script src="assets/plugins/inputlimiter/jquery.inputlimiter.1.3.1.min.js"></script>
    <script src="assets/plugins/chosen/chosen.jquery.min.js"></script>
    <script src="assets/plugins/tagsinput/jquery.tagsinput.min.js"></script>
    <script src="assets/js/jquery.validVal.min.js"></script>
    <script src="assets/plugins/datepicker/js/bootstrap-datepicker.js"></script>
    <script src="assets/js/jquery.autosize.min.js"></script>
    <script src="assets/plugins/jasny/js/bootstrap-inputmask.js"></script>
    <script src="assets/js/formsInit.js"></script>
    <script src="assets/js/notifications.js"></script>
    <script src="assets/plugins/jasny/js/bootstrap-fileupload.js"></script>
    <script src="assets/js/plugins.js"></script>

    <script type="text/javascript">
        $('.select2').select2()

        $(document).on("click", ".open-AddBookDialog", function () {
            var myBookId = $(this).data('id');
            var myBookId1 = $(this).data('id1');
            var myBookId2 = $(this).data('id2');
            var myBookId3 = $(this).data('id3');
            var myBookId4 = $(this).data('id4');
            var myBookId5 = $(this).data('id5');
            var myBookId6 = $(this).data('id6');
            $(".modal-body #bookId").val( myBookId );
            $(".modal-body #bookId1").val( myBookId1 );
            $(".modal-body #bookId2").val( myBookId2 );
            $(".modal-body #bookId3").val( myBookId3 );
            $(".modal-body #bookId4").val( myBookId4 );
            $(".modal-body #bookId5").val( myBookId5 );
            $(".modal-body #bookId6").val( myBookId6 );
            var id = $(this).data('id');
            $('#myModal').data('id', id).modal('show');
        });
         
         $(function () {
            Notifications(); 
        });

        $(document).ready(function () {
            $('#dataTables-example').dataTable();
         });

        $(function () {
            formInit();
        });
    </script>
</body>
</html>
