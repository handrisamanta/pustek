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
$videoid = $_REQUEST['videoid'];
?>
<input type='hidden' id='vided_VideoId' value='<?=$videoid?>'>
Silahkan login terlebih dahulu untuk mengubah video ini.<br>
Notes ini hanya dapat diubah oleh pemilik video.<br>
<table>
<tr>
    <td width='100' align='right'>Login</td>
    <td align='left'><input type='text' id='vided_Login' class='inputbox' size='12' maxlength='25'></td>
</tr>
<tr>
    <td align='right'>Password</td>
    <td align='left'><input type='password' id='vided_Password' class='inputbox' size='12' maxlength='25'></td>
</tr>    
</table>