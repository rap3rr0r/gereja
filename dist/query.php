<?php
$app = mysql_fetch_array(mysql_query("SELECT * FROM tb_app"));
$a = mysql_num_rows(mysql_query("SELECT * FROM tb_umat"));
$b = mysql_num_rows(mysql_query("SELECT * FROM tb_keluarga"));
$c = mysql_num_rows(mysql_query("SELECT * FROM tb_keuskupan"));
$d = mysql_num_rows(mysql_query("SELECT * FROM tb_pengurus"));
$e = mysql_num_rows(mysql_query("SELECT * FROM tb_jabatan"));
$f = mysql_num_rows(mysql_query("SELECT * FROM tb_hubungan"));
$g = mysql_num_rows(mysql_query("SELECT * FROM tb_pendidikan"));
$h = mysql_num_rows(mysql_query("SELECT * FROM tb_agama"));
$k = mysql_num_rows(mysql_query("SELECT * FROM tb_status"));