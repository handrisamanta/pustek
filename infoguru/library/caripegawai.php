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
require_once('../include/common.php');
require_once('../include/config.php');
require_once('../include/theme.php');
require_once('../include/db_functions.php');

$flag = 0;
if (isset($_REQUEST['flag']))
	$flag = (int)$_REQUEST['flag'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="../style/style.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>JIBAS SIMAKA [Cari Pegawai]</title>
<script language="javascript" src="../script/string.js"></script>
<script language="javascript" src="../script/tables.js"></script>
<script language="javascript">
/*function validate() {
	var nama = '' + document.getElementById('nama').value;
	var nip = '' + document.getElementById('nip').value;
	nama = trim(nama);
	nip = trim(nip);
	
	return (nama.length != 0) || (nip.length != 0);
}*/

function pilih(nip, nama) {
	opener.acceptPegawai(nip, nama);
	window.close();
}
</script>
</head>

<body topmargin="0" leftmargin="0" marginheight="0" marginwidth="0" style="background-color:#FFFFFF" onload="document.getElementById('nama').focus()">
	<table border="0" width="102%" cellpadding="2" cellspacing="2" align="center" >
	<tr height="25">
		<td class="header" colspan="2" align="center">Cari Pegawai</td>
	</tr>
	<form name="main">
	<input type="hidden" name="flag" id="flag" value="<?=$flag ?>" />
	<tr>
    	<td>
		<strong>NIP</strong> <input type="text" name="nip" id="nip" value="<?=$_REQUEST['nip'] ?>" size="20" />&nbsp;
        <strong>Nama</strong> <input type="text" name="nama" id="nama" value="<?=$_REQUEST['nama'] ?>" size="40" />&nbsp;
     	<input type="submit" class="but" name="Submit" id="Submit" value="Cari" />        
       	</td>
    </tr>
	</form>	
	<tr>
		<td align="center" >
	<br />
<?
OpenDb();
if (isset($_REQUEST['Submit'])) { 

	$nama = $_REQUEST['nama'];
	$nip = $_REQUEST['nip'];

	if ((strlen($nama) > 0) && (strlen($nip) > 0))
		$sql = "SELECT nip, nama FROM jbssdm.pegawai WHERE aktif = 1 AND nama LIKE '%$nama%' AND nip LIKE '%$nip%' AND nip NOT IN (SELECT login FROM jbsuser.hakakses WHERE MODUL='INFOGURU') ORDER BY nama"; 
	else if (strlen($nama) > 0)
		$sql = "SELECT nip, nama FROM jbssdm.pegawai WHERE aktif = 1 AND nama LIKE '%$nama%' AND nip NOT IN (SELECT login FROM jbsuser.hakakses WHERE MODUL='INFOGURU')ORDER BY nama"; 
	else if (strlen($nip) > 0)
		$sql = "SELECT nip, nama FROM jbssdm.pegawai WHERE aktif = 1 AND nip LIKE '%$nip%' AND nip NOT IN (SELECT login FROM jbsuser.hakakses WHERE MODUL='INFOGURU')ORDER BY nama"; 
	else if ((strlen($nama) == 0) || (strlen($nip) == 0)) 
		$sql = "SELECT nip, nama FROM jbssdm.pegawai WHERE aktif = 1 AND nip NOT IN (SELECT login FROM jbsuser.hakakses WHERE MODUL='INFOGURU')ORDER BY nama";		
} else {
	$sql = "SELECT nip, nama FROM jbssdm.pegawai WHERE aktif = 1 AND nip NOT IN (SELECT login FROM jbsuser.hakakses WHERE MODUL='INFOGURU')ORDER BY nama"; 
}
$result = QueryDb($sql);	
CloseDb();
$jum = mysql_num_rows($result);

if ($jum > 0) {
?>
<table width="100%" id="table" class="tab" align="center" cellpadding="2" cellspacing="0" border="1" >
<tr height="30">
	<td class="header" width="7%" align="center">No</td>
    <td class="header" width="15%" align="center">N I P</td>
    <td class="header" align="center">Nama</td>
    <td class="header" width="10%">&nbsp;</td>
</tr>
<?

$cnt = 0;
while($row = mysql_fetch_row($result)) { ?>
<tr>
	<td align="center" onclick="pilih('<?=$row[0]?>', '<?=$row[1]?>')" style="cursor:pointer" title="Klik untuk memilih guru"><?=++$cnt ?></td>
    <td align="center" onclick="pilih('<?=$row[0]?>', '<?=$row[1]?>')" style="cursor:pointer" title="Klik untuk memilih guru"><?=$row[0] ?></td>
    <td onclick="pilih('<?=$row[0]?>', '<?=$row[1]?>')" style="cursor:pointer" title="Klik untuk memilih guru"><?=$row[1] ?></td>
    <td align="center" onclick="pilih('<?=$row[0]?>', '<?=$row[1]?>')" style="cursor:pointer" title="Klik untuk memilih guru">
    <input type="button" name="pilih" class="but" id="pilih" value="Pilih" onclick="pilih('<?=$row[0]?>', '<?=$row[1]?>')" />
    </td>
</tr>


<? 
	} ?>
	</table>
<script language="javascript">
	Tables('table', 1, 0);
</script>
<? } else { ?>
	<strong><font color="red">Tidak ditemukan adanya data</font></strong><br /><br />    
<? } ?>
</td></tr>
<tr height="35">
	<td colspan="4" align="center">
    <input type="button" class="but" name="tutup" id="tutup" value="Tutup" onclick="window.close()" /></td>
</tr>
</table>


</body>
</html>