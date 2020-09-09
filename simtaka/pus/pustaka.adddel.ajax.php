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
require_once('../inc/config.php');
require_once('../inc/db_functions.php');
require_once('../inc/common.php');
require_once('../inc/sessioninfo.php');
require_once('pustaka.adddel.func.php');

$op = $_REQUEST['op'];
if ($op == "setnewstatus")
{
    $iddp = $_REQUEST['iddp'];
    $newaktif = $_REQUEST['newaktif'];
    
    OpenDb();
    $sql = "UPDATE jbsperpus.daftarpustaka
               SET aktif = '$newaktif'
             WHERE replid = '$iddp'";
    QueryDb($sql);
    CloseDb();
    
    http_response_code(200);
    echo GetActive($iddp, $newaktif);
}
elseif ($op == "delpustaka")
{
    $iddp = $_REQUEST['iddp'];
        
    OpenDb();
    $sql = "SELECT p.katalog
              FROM jbsperpus.pustaka p, jbsperpus.daftarpustaka dp
             WHERE p.replid = dp.pustaka
               AND dp.replid = '$iddp'";
    $res = QueryDb($sql);
    $row = mysql_fetch_row($res);
    $idkatalog = $row[0];
    
    $sql = "UPDATE jbsperpus.katalog
               SET counter = counter - 1
             WHERE replid = '$idkatalog'";
    QueryDb($sql);
    
    $sql = "DELETE jbsperpus.daftarpustaka
             WHERE replid = '$iddp'";
    QueryDb($sql);
    CloseDb();
    
    http_response_code(200);
    echo GetActive($iddp, $newaktif);
}
?> 