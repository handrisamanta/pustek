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
header("Content-type: image/jpeg");

require_once('../include/config.php');
require_once('../include/db_functions.php');

$replid = (int)$_REQUEST['replid'];
$table = $_REQUEST['table'];
$field = "";
if (isset($_REQUEST['field']))
	$field = $_REQUEST['field'];

if ($replid != 0)
{
	OpenDb();
	
	$query = "SELECT foto FROM $table WHERE replid = $replid";
	$result = QueryDb($query);
	$num = @mysql_num_rows($result);
	
	if ($row = mysql_fetch_array($result)) 
	{
		if ($row['foto']) 
		{
			echo $row['foto'];
		}
		else 
		{
			$filename = "../images/ico/no_image.png";
			$contents = "";
			
			if ($handle = @fopen($filename, "r"))
			{
				$contents = @fread($handle, filesize($filename));
				@fclose($handle);
			}
	
			echo $contents;
		}
	}
	CloseDb();	
}
?>