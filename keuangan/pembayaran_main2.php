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
$idtahunbuku = $_REQUEST['idtahunbuku'];
$idkategori = $_REQUEST['idkategori'];
$idpenerimaan = $_REQUEST['idpenerimaan'];
$departemen = $_REQUEST['departemen'];
?>
<frameset border="1" cols="31%,*" frameborder="1">
	<frame name="siswa" src="pembayaran_siswa.php?idtahunbuku=<?=$idtahunbuku?>&idkategori=<?=$idkategori?>&idpenerimaan=<?=$idpenerimaan?>&departemen=<?=$departemen?>" scrolling="auto" style="border:1; border-right-color:#000000; border-right-style:solid"/>
    	<!--<frame name="content" src="blank_pembayaran.php" scrolling="auto" style="border:1; border-left-color:#000000; border-left-style:solid" />-->
        <frame name="content" src="blank_pembayaran.php" scrolling="auto" />
</frameset><noframes></noframes>