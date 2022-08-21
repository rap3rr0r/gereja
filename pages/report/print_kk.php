<?php
ob_start();
include'../../dist/tcpdf/tcpdf.php';

class MYPDF extends TCPDF {
	public function Header() {
        // Logo
        $image_file = K_PATH_IMAGES.'../../assets/img/logo-ka-merauke.jpg';
        $this->Image($image_file, 15, 10, 20, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // ($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false, $alt=false, $altimgs=array())
    }
    public function Footer() {
        // Position at 15 mm from bottom
        // $this->SetY(-15);
        // Set font
        // $this->SetFont('helvetica', 'I', 8);
        // Page number
        // $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages().'    '.'*** '.date ("d-m-Y").' ***', 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

function tgl_indo($tgl) {
    $tanggal = substr($tgl,8,2);
    $bulan = getBulan(substr($tgl,5,2));
    $tahun = substr($tgl,0,4);
    return $tanggal.' '.$bulan.' '.$tahun;     
} 

function getBulan($bln) {
    switch ($bln){
        case 1: return "Jan"; break;
        case 2: return "Feb"; break;
        case 3: return "Mar"; break;
        case 4: return "Apr"; break;
        case 5: return "Mei"; break;
        case 6: return "Jun"; break;
        case 7: return "Jul"; break;
        case 8: return "Agu"; break;
        case 9: return "Sep"; break;
        case 10: return "Okt"; break;
        case 11: return "Nov"; break;
        case 12: return "Des"; break;
    }
}

$pdf = new MYPDF('L', 'mm', 'A4', true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('rap3rr0r');
$pdf->SetTitle('Surat Keluarga');
$pdf->SetSubject('TCPDF');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(12, 12, 12); // left, top, right=-1
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, 20);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// add a page
$pdf->AddPage();
$pdf->SetFont('helvetica', '', '10');

include "../../dist/conn.php";
$tgl_now = date("Y-m-d");
$a = mysql_fetch_array(mysql_query("SELECT * FROM tb_keluarga WHERE id='$_GET[id]'"));
$b = mysql_fetch_array(mysql_query("SELECT * FROM tb_umat WHERE id_keluarga='$a[id]'"));
$c = mysql_fetch_array(mysql_query("SELECT * FROM tb_umat JOIN tb_pengurus ON tb_umat.id=tb_pengurus.id_pengurus WHERE id_pengurus='$_GET[pengurus]'"));
$kk = mysql_fetch_array(mysql_query("SELECT tb_umat.id, tb_umat.nama_umat FROM tb_umat JOIN tb_hubungan ON tb_umat.id_hubungan=tb_hubungan.id WHERE tb_umat.id_keluarga='$a[id]' AND tb_hubungan.nama_hubungan='Kepala Keluarga'"));
$alamat = mysql_fetch_array(mysql_query("SELECT * FROM tb_alamat WHERE id_umat='$b[id]'"));

$html = '<p align="center"><font size="26"><b>KARTU KELUARGA KEUSKUPAN</b></font></p><br>';
$pdf->writeHTML($html, true, false, false, false, '');

$html ='<table width="100%" align="center">
            <tr align="left">
                <td width="50%">
                    <table>
                        <tr><td>Nama Kepala Keluarga</td><td>: <font style="text-transform:uppercase;"><b>'.$kk['nama_umat'].'</b></font></td></tr>
                        <tr><td>Alamat</td><td>: <font style="text-transform:uppercase;">'.$alamat['jln'].'</font></td></tr>
                        <tr><td>RT/RW</td><td>: <font style="text-transform:uppercase;">'.$alamat['rtrw'].'</font></td></tr>
                        <tr><td>Desa/Kelurahan</td><td>: <font style="text-transform:uppercase;">'.$alamat['desa'].'</font></td></tr>
                    </table>
                </td>
                <th width="15%"></th>
                <th width="35%">
                    <table>
                        <tr><td>Kecamatan</td><td>: <font style="text-transform:uppercase;">'.$alamat['kec'].'</font></td></tr>
                        <tr><td>Kabupaten/Kota</td><td>: <font style="text-transform:uppercase;">'.$alamat['kota'].'</font></td></tr>
                        <tr><td>Kode Pos</td><td>: <font style="text-transform:uppercase;">'.$alamat['kode'].'</font></td></tr>
                        <tr><td>Provinsi</td><td>: <font style="text-transform:uppercase;">'.$alamat['prov'].'</font></td></tr>
                    </table>
                </th>
            </tr>';
$html .= '</table>';
$pdf->writeHTML($html, true, false, false, false, '');

$html ='<table width="100%" border="1" cellpadding="2" style="font-size:8pt">
            <tr align="center">
                <th width="2%">No</th>
                <th width="15%">Nama Lengkap</th>
                <th width="15%">NIK</th>
                <th width="10%">Jenis Kelamin</th>
                <th width="11%">Tempat Lahir</th>
                <th width="11%">Tanggal Lahir</th>
                <th width="10%">Agama</th>
                <th width="11%">Pendidikan</th>
                <th width="15%">Pekerjaan</th>
            </tr>
            <tr align="center">
                <td></td>
                <td>(1)</td>
                <td>(2)</td>
                <td>(3)</td>
                <td>(4)</td>
                <td>(5)</td>
                <td>(6)</td>
                <td>(7)</td>
                <td>(8)</td>
            </tr>';
            $no = 1;
            $kel = mysql_query("SELECT * FROM tb_umat WHERE id_keluarga='$_GET[id]' ORDER BY id_hubungan ASC");
            while($list=mysql_fetch_array($kel)) {
                $html .='
                <tr align="center">
                    <td>'.$no++.'</td>
                    <td align="left"><font style="text-transform:uppercase;">'.$list['nama_umat'].'</font></td>
                    <td>'.$list['nik_umat'].'</td>
                    <td>';
                    if($list['jk'] == 'L') {
                        $html.='LAKI-LAKI';
                    } else {
                        $html.='PEREMPUAN';
                    }
                    $html.='</td>
                    <td><font style="text-transform:uppercase;">'.$list['tmp_lhr'].'</font></td>
                    <td><font style="text-transform:uppercase;">'.tgl_indo($list['tgl_lhr']).'</font></td>';
                    $agama = mysql_fetch_array(mysql_query("SELECT * FROM tb_agama WHERE id='$list[agama]'"));
                    $html .='<td><font style="text-transform:uppercase;">'.$agama['nama_agama'].'</font></td>';
                    $pendidikan = mysql_fetch_array(mysql_query("SELECT * FROM tb_pendidikan WHERE id='$list[pendidikan]'"));
                    $html.='<td>'.$pendidikan['nama_pendidikan'].'</td>
                    <td><font style="text-transform:uppercase;">'.$list['pekerjaan'].'</font></td>
                </tr>';
            }
$html .= '</table>';
$pdf->writeHTML($html, true, false, false, false, '');

$html ='<table width="100%" border="1" cellpadding="2" style="font-size:8pt">
            <tr align="center">
                <th width="2%" rowspan="2">N<br>o</th>
                <th width="22%" rowspan="2">Status<br>Pernikahan</th>
                <th width="22%" rowspan="2">Status Hubungan<br>Dalam Keluarga</th>
                <th width="15%" rowspan="2">Kewarga<br>Negaraan</th>
                <th width="39%" colspan="2">Nama Orang Tua</th>
            </tr>
            <tr align="center">
                <th>Ayah</th>
                <th>Ayah</th>
            </tr>
            <tr align="center">
                <td></td>
                <td>(9)</td>
                <td>(10)</td>
                <td>(11)</td>
                <td>(12)</td>
                <td>(13)</td>
            </tr>';
            $no = 1;
            $keL = mysql_query("SELECT * FROM tb_umat WHERE id_keluarga='$_GET[id]' ORDER BY id_hubungan ASC");
            while($lisT=mysql_fetch_array($keL)) {
                $status = mysql_fetch_array(mysql_query("SELECT * FROM tb_status WHERE id='$lisT[id_pernikahan]'"));
                $html .='
                <tr align="center">
                    <td>'.$no++.'</td>
                    <td align="left">'.$status['nama_status'].'</td>';
                    $hub = mysql_fetch_array(mysql_query("SELECT * FROM tb_hubungan WHERE id='$lisT[id_hubungan]'"));
                    $html.='<td align="left"><font style="text-transform:uppercase;">'.$hub['nama_hubungan'].'</font></td>
                    <td>'.$lisT['negara'].'</td>';
                    $ortu = mysql_fetch_array(mysql_query("SELECT * FROM tb_ortu WHERE id_umat='$lisT[id]'"));
                    $html.='<td align="left"><font style="text-transform:uppercase;">'.$ortu['nama_ayah'].'</font></td>
                    <td align="left"><font style="text-transform:uppercase;">'.$ortu['nama_ibu'].'</font></td>
                </tr>';
            }
$html .= '</table>';
$pdf->writeHTML($html, true, false, false, false, '');

$html ='<table width="100%" style="font-size:10pt">
            <tr align="center">
                <td width="40%"></td>
                <td width="30%">KEPALA KELUARGA<br><br><br><br><font style="text-transform:uppercase;"><b><u>'.$kk['nama_umat'].'</u></b></font></td>
                <td width="30%">KEUSKUPAN AGUNG MERAUKE<br><br><br><br><font style="text-transform:uppercase;"><b><u>'.$c['nama_umat'].'</u></b></font></td>
            </tr>';
$html .= '</table>';
$pdf->writeHTML($html, true, false, false, false, '');

//Close and output PDF document
$pdf->Output('Kartu_Keluarga_'.date ("dmY").'.pdf', 'I');
// $name='doc.pdf', $dest=I,D,F
?>