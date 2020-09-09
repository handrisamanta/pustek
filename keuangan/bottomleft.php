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
require_once('include/common.php');
require_once('include/sessioninfo.php');
require_once('include/sessionchecker.php');
require_once('include/config.php');
require_once('include/theme.php');
require_once('include/db_functions.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script language="javascript">
function get_fresh(){
document.location.reload();
}
</script>
</head>

<body topmargin="0" leftmargin="0" marginheight="0" marginwidth="0" style="background:url(images/bgmain.jpg)">
<table border="0" cellpadding="0" cellspacing="0" width="56">
<tr height="25">
    <td width="28" background="<?=GetThemeDir() ?>bgmain_06a.jpg">&nbsp;</td>
    <td width="22" background="<?=GetThemeDir() ?>bgmain_17.jpg">&nbsp;</td>
    <td width="6" background="<?=GetThemeDir() ?>bgmain_18a.jpg">&nbsp;</td>
</tr>
<tr height="42">
    <td width="28" background="<?=GetThemeDir() ?>bgmain_21.jpg">&nbsp;</td>
    <td width="28" colspan="2" background="<?=GetThemeDir() ?>bgmain_22a.jpg">&nbsp;</td>
</tr>
</table>
</body>
</html>