<?
/**[N]**
 * JIBAS Education Community
 * Jaringan Informasi Bersama Antar Sekolah
 * 
 * @version: 3.4 (March 03, 2014)
 * @notes: JIBAS Education Community will be managed by Yayasan Indonesia Membaca (http://www.indonesiamembaca.net)
 * 
 * Copyright (C) 2009 Yayasan Indonesia Membaca (http://www.indonesiamembaca.net)
 * 
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 **[N]**/ ?>
<?
require_once('include/errorhandler.php');
require_once('include/sessionchecker.php');
require_once('include/common.php');
require_once('include/rupiah.php');
require_once('include/config.php');
require_once('include/db_functions.php');

$tanggal1 = "";
if (isset($_REQUEST['tanggal1']))
	$tanggal1 = $_REQUEST['tanggal1'];
	
$tanggal2 = "";
if (isset($_REQUEST['tanggal2']))
	$tanggal2 = $_REQUEST['tanggal2'];
	
$departemen = "";
if (isset($_REQUEST['departemen']))
	$departemen = $_REQUEST['departemen'];

$kategori = "";
if (isset($_REQUEST['kategori']))
	$kategori = $_REQUEST['kategori'];

$idtahunbuku = 0;
if (isset($_REQUEST['idtahunbuku']))
	$idtahunbuku = (int)$_REQUEST['idtahunbuku'];

$koderek = "";
if (isset($_REQUEST['koderek']))
	$koderek = $_REQUEST['koderek'];
	
OpenDb();
$sql = "SELECT nama FROM rekakun WHERE kode='$koderek'";
$result = QueryDb($sql);	
$row = mysql_fetch_array($result);
$rekening = $koderek." - ".$row["nama"];
$urut = "j.nokas";	
if (isset($_REQUEST['urut']))
	$urut = $_REQUEST['urut'];	

$urutan = "ASC";	
if (isset($_REQUEST['urutan']))
	$urutan = $_REQUEST['urutan'];
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="style/style.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style/tooltips.css">
<title>Untitled Document</title>
<script language="javascript" src="script/tooltips.js"></script>
<script language="javascript" src="script/tables.js"></script>
<script language="javascript" src="script/tools.js"></script>
<script language="javascript">
function cetak() {
	var addr = "lapbukubesar_cetak_detail.php?departemen=<?=$departemen?>&tanggal1=<?=$tanggal1?>&tanggal2=<?=$tanggal2?>&kategori=<?=$kategori?>&idtahunbuku=<?=$idtahunbuku?>&koderek=<?=$koderek?>&urut=<?=$urut?>&urutan=<?=$urutan?>";
	newWindow(addr, 'CetakDetail','790','630','resizable=1,scrollbars=1,status=0,toolbar=0');
}
function excel() {
	var addr = "lapbukubesar_excel_detail.php?departemen=<?=$departemen?>&tanggal1=<?=$tanggal1?>&tanggal2=<?=$tanggal2?>&kategori=<?=$kategori?>&idtahunbuku=<?=$idtahunbuku?>&koderek=<?=$koderek?>&urut=<?=$urut?>&urutan=<?=$urutan?>";
	newWindow(addr, 'ExcelDetail','790','630','resizable=1,scrollbars=1,status=0,toolbar=0');
}
function change_urut(urut,urutan) {		
	if (urutan =="ASC"){
		urutan="DESC"
	} else {
		urutan="ASC"
	}
	var addr = "lapbukubesar_content.php?departemen=<?=$departemen?>&tanggal1=<?=$tanggal1?>&tanggal2=<?=$tanggal2?>&kategori=<?=$kategori?>&idtahunbuku=<?=$idtahunbuku?>&koderek=<?=$koderek?>&urut="+urut+"&urutan="+urutan;
	
	document.location.href = addr;
}
</script>
</head>
<body topmargin="0" marginheight="0" >
<br />
<table width="100%" border="0" align="center">
<tr>
	<td valign="top" background="" style="background-repeat:no-repeat; background-attachment:fixed">
    <table width="100%" border="0" height="100%" cellspacing="0" cellpadding="0">
   	<tr>
    	<td><strong><font size="2" color="#990000"><?=$rekening?></font></strong></td>    	
        <td align="right">
        <a href="#" onClick="document.location.reload()"><img src="images/ico/refresh.png" border="0" onMouseOver="showhint('Refresh!', this, event, '50px')"/>&nbsp;Refresh</a>&nbsp;&nbsp;
        <a href="JavaScript:cetak()"><img src="images/ico/print.png" border="0" onMouseOver="showhint('Cetak!', this, event, '50px')"/>&nbsp;Cetak</a>&nbsp;&nbsp;
        <a href="JavaScript:excel()"><img src="images/ico/excel.png" border="0" onMouseOver="showhint('Buka di Ms Excel!', this, event, '50px')"/>&nbsp;Excel</a>&nbsp;
        </td>
    </tr>
    </table>
    <br />
	<table class="tab" id="table" border="1" cellpadding="2" style="border-collapse:collapse" cellspacing="2" width="100%" align="center" bordercolor="#000000">
    <tr height="30">
        <td class="header" width="3%" align="center">No</td>
        <td class="header" width="20%" align="center" onMouseOver="background='style/formbg2agreen.gif';height=30;" onMouseOut="background='style/formbg2.gif';height=30;" background="style/formbg2.gif" style="cursor:pointer;" onClick="change_urut('j.nokas','<?=$urutan?>')">No. Jurnal/Tgl <?=change_urut('j.nokas',$urut,$urutan)?></td>
        <td class="header" width="9%" align="center">Petugas</td>
        <td class="header" width="*" align="center">Transaksi</td>
        <td class="header" width="17%" align="center">Debet</td>
        <td class="header" width="17%" align="center">Kredit</td>
    </tr>
    <?
    OpenDb();
    $sql = "SELECT date_format(j.tanggal, '%d-%b-%Y') AS tanggal, j.petugas, j.transaksi, j.keterangan, j.nokas, jd.debet, jd.kredit FROM jurnal j, jurnaldetail jd WHERE j.replid = jd.idjurnal AND j.idtahunbuku = '$idtahunbuku' AND j.tanggal BETWEEN '$tanggal1' AND '$tanggal2' AND jd.koderek = '$koderek' ORDER BY $urut $urutan, j.petugas";
    $result = QueryDb($sql);
    $cnt = 0;
    $totaldebet = 0;
    $totalkredit = 0;
    while($row = mysql_fetch_array($result)) {
        $totaldebet += $row['debet'];
        $totalkredit += $row['kredit'];
    ?>
    <tr height="25">
        <td valign="top" align="center"><?=++$cnt ?></td>
        <td valign="top" align="center"><strong><?=$row['nokas'] ?></strong><br /><em><?=$row['tanggal'] ?></em></td>
        <td valign="top" align="left"><?=$row['petugas'] ?></td>
        <td valign="top" align="left"><?=$row['transaksi'] ?><br />
        <? if ($row['keterangan'] <> "") { ?>
        <strong>Keterangan: </strong><?=$row['keterangan'] ?>
        <? } ?>
        </td>
        <td valign="top" align="right"><?=FormatRupiah($row['debet']) ?></td>
        <td valign="top" align="right"><?=FormatRupiah($row['kredit']) ?></td>
    </tr>
    <?
    }
    CloseDb();
    ?>
    <tr height="30">
        <td colspan="4" align="center" bgcolor="#999900"><font color="#FFFFFF"><strong>T O T A L</strong></font></td>
        <td align="right" bgcolor="#999900"><font color="#FFFFFF"><strong><?=FormatRupiah($totaldebet) ?></strong></font></td>
        <td align="right" bgcolor="#999900"><font color="#FFFFFF"><strong><?=FormatRupiah($totalkredit) ?></strong></font></td>
    </tr>
    </table>
    <script language='JavaScript'>
	    Tables('table', 1, 0);
    </script>
    </td>
</tr>
</table>
</body>
</html>