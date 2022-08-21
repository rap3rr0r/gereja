<?php
ob_start();
include'../../dist/tcpdf/tcpdf.php';

class MYPDF extends TCPDF {
	public function Header() {
        // Logo
        //$image_file = K_PATH_IMAGES.'logo_example.jpg';
        //$this->Image($image_file, 10, 10, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Header
        //$html = '<p align="center"></p>';
		//$this->writeHTMLCell($w = 0, $h = 0, $x = '', $y = 10, $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = 'top', $autopadding = true);
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
        case 1: return "Januari"; break;
        case 2: return "Februari"; break;
        case 3: return "Maret"; break;
        case 4: return "April"; break;
        case 5: return "Mei"; break;
        case 6: return "Juni"; break;
        case 7: return "Juli"; break;
        case 8: return "Agustus"; break;
        case 9: return "September"; break;
        case 10: return "Oktober"; break;
        case 11: return "November"; break;
        case 12: return "Desember"; break;
    }
}

$pdf = new MYPDF('L', 'mm', 'A4', true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('rap3rr0r');
$pdf->SetTitle('Surat Nikah');
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
$pdf->SetMargins(25, 22, 12); // left, top, right=-1
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
$pdf->SetFont('bellmt', '', '');

include "../../dist/conn.php";
$tgl_now = date("Y-m-d");
$query = mysql_fetch_array(mysql_query("SELECT * FROM tb_keuskupan WHERE id='$_GET[id]'"));
$query2 = mysql_fetch_array(mysql_query("SELECT * FROM tb_surat_nikah WHERE id_nikah='$_GET[id]'"));
$pria = mysql_fetch_array(mysql_query("SELECT * FROM tb_nikah WHERE id_nikah='$_GET[id]' and status='Pria'"));
$wanita = mysql_fetch_array(mysql_query("SELECT * FROM tb_nikah WHERE id_nikah='$_GET[id]' and status='Wanita'"));
$peng = mysql_fetch_array(mysql_query("SELECT * FROM tb_umat JOIN tb_pengurus ON tb_umat.id=tb_pengurus.id_pengurus WHERE tb_pengurus.id_pengurus='$_GET[pengurus]'"));

$html ='<table width="100%" align="center">
            <tr align="left">
                <td width="40%">
                    <table>
                        <tr><td style="font-size:12"><b>KEUSKUPAN AGUNG MERAUKE</b></td></tr>
                        <tr><td style="font-size:10;font-family:centaur">Buku: '.$query2['buku'].', No: '.$query2['no_surat'].'</td></tr>
                        <tr><td style="font-size:10;font-family:centaur">Tahun '.$query2['tahun'].'<br></td></tr>
                    </table>
                </td>
                <th width="25%"></th>
                <th width="35%">
                    <table>
                        <tr><td style="font-size:12"><b>KUTIPAN DARI BUKU PERKAWINAN</b></td></tr>
                        <tr><td style="font-size:10;font-family:centaur">Pada gereja: '.$query2['gereja'].'</td></tr>
                        <tr><td style="font-size:10;font-family:centaur">di '.$query2['tempat'].'<br></td></tr>
                    </table>
                </th>
            </tr>';
$html .= '</table>';
$pdf->writeHTML($html, true, false, false, false, '');
// $html, $ln=true, $fill=false, $reseth=false, $cell=false, $align=''

$pdf->SetFont('candarab', '', '');
$html = '<p align="center"><font size="20"><b>T E S T I M O N I U M&nbsp; M A T R I M O N I I<br />
            ( S U R A T&nbsp; N I K A H )</b></font></p>';
$pdf->writeHTML($html, true, false, false, false, '');

$pdf->AddFont('centaur','','centaur.php');
$pdf->SetFont('centaur', '', '');
$html = '<p align="center" style="font-size:10">Ego subscriptor attestor<br />
            <span style="text-decoration:overline">Yang bertanda tangan di bawah ini memberikan kesaksian</span></p><br />';
$pdf->writeHTML($html, true, false, false, false, '');

$html ='<table width="100%" style="font-size:10">
            <tr><td width="12%">q u o d<br><span style="text-decoration:overline">bahwa </span></td><td align="center" width="75%" style="vertical-align:middle;"><font style="text-transform:uppercase;">'.$query['m_pria'].'</font></td></tr>
            </table>';
$pdf->writeHTML($html, true, false, false, false, '');

$html ='<table width="100%" style="font-size:10;padding:2px 0;">
            <tr><td width="12%">c. p. s.<br><span style="text-decoration:overline">anak laki-laki dari</span></td><td align="center" width="75%" style="vertical-align:middle"><b>'.$pria['ayah'].'</b> dan <b>'.$pria['ibu'].'</b></td></tr>
            </table>';
$pdf->writeHTML($html, true, false, false, false, '');

$html = '<p align="center" style="font-size:10">rite matrimomio junctum esse<br />
            <span style="text-decoration:overline">telah menikah menurut hukum Gereja Katolik</span></p><br />';
$pdf->writeHTML($html, true, false, false, false, '');

$html ='<table width="100%" style="font-size:10;padding:2px 0;">
            <tr><td width="12%">c u m<br><span style="text-decoration:overline">dengan </span></td><td align="center" width="75%" style="vertical-align:middle;"><font style="text-transform:uppercase;">'.$query['m_wanita'].'</font></td></tr>
            </table>';
$pdf->writeHTML($html, true, false, false, false, '');

$html ='<table width="100%" style="font-size:10;padding:2px 0;">
            <tr>
                <td width="12%">c. p. s.<br><span style="text-decoration:overline">anak perempuan dari</span></td>
                <td width="75%" align="center" rowspan="2" style="vertical-align:middle"><b>'.$wanita['ayah'].'</b> dan <b>'.$wanita['ibu'].'</b></td>
            </tr>
        </table>';
$pdf->writeHTML($html, true, false, false, false, '');

$html ='<table width="100%" style="font-size:10;padding:2px 0;">
            <tr>
                <td width="6%">die<br><span style="text-decoration:overline">tanggal </span></td>
                <td width="30%">'.tgl_indo($query['tgl_nikah']).'</td>
                <td width="15%">in eccl./et loci<br><span style="text-decoration:overline">di gereja/dan di tempat</span></td>
                <td width="44%">'.$query2['gereja'].'&nbsp;'.$query2['tempat'].'</td>
            </tr>
        </table>';
$pdf->writeHTML($html, true, false, false, false, '');

$html ='<table width="100%" style="font-size:10;padding:2px 0;">
            <tr><td width="20%">Dispensasi super impedimentum<br><span style="text-decoration:overline">Diberi dispensasi atas halangan </span></td><td width="80%" style="vertical-align:middle;">'.$_GET['dispensasi'].'</td></tr>
            </table>';
$pdf->writeHTML($html, true, false, false, false, '');

$html ='<table width="100%" style="font-size:10;padding:2px 0;">
            <tr>
            <td width="8%">Testes<br><span style="text-decoration:overline">Saksi-saksi </span></td>
            <td width="35%" style="vertical-align:middle;"><font style="text-transform:uppercase;">1). '.$pria['wali1'].'</font></td>
            <td width="12%">C o r a m<br><span style="text-decoration:overline">Di hadapan Imam</span></td>
            <td width="45%" style="vertical-align:middle;">'.$query2['imam'].'</td></tr>
            </table>';
$pdf->writeHTML($html, true, false, false, false, '');

$html ='<table width="100%" style="font-size:10">
            <tr>
                <td width="8%">&nbsp;</td>
                <td width="35%" style="vertical-align:middle;"><font style="text-transform:uppercase;">2). '.$wanita['wali1'].'</font></td>
                <td width="25%">Concordat cum suo Originali<br><span style="text-decoration:overline">Sesuai dengan buku asli</span></td>
                <td width="32%" style="vertical-align:middle;">Quod attestor<br><span style="text-decoration:overline">Yang memberikan salinan ini</span></td>
            </tr>
        </table>';
$pdf->writeHTML($html, true, false, false, false, '');

$html ='<table width="100%" style="font-size:10;padding:40px 0px 0px;">
            <tr>
                <td width="50%">Merauke, '.tgl_indo($tgl_now).'</td>
                <td width="50%" align="center">'.$peng['nama_umat'].'</td>
            </tr>
        </table>';
$pdf->writeHTML($html, true, false, false, false, '');

//Close and output PDF document
$pdf->Output('Surat_Nikah_'.date ("dmY").'.pdf', 'I');
// $name='doc.pdf', $dest=I,D,F
?>