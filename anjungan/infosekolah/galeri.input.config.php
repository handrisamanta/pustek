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
$allowedPictType = array('.jpg', '.jpeg', '.png', '.gif', '.bmp');
$maxCoverWidth = 220;
$maxCoverHeight = 180;
$maxPictWidth = 800;
$maxPictHeight = 600;
$maxPictQuality = 90;
$maxNotesLength = 2000;
$maxCommentLength = 1000;
$previewTextLength = 480;
$employeeMaxFileSize = 50; // MB
$studentMaxFileSize = 1; // MB

function CreateGalleryInputConfigJavaScript()
{
    global $allowedPictType, $allowedDocType, $maxNotesLength, $maxCommentLength;

	$content = "";    
   
    $item = "";
    for($i = 0; $i < count($allowedPictType); $i++)
    {
        if ($item != "")
            $item .= ", ";
        $item .= "'" . $allowedPictType[$i] . "'";    
    }
    $content .= "var galinp_AllowedPictType = [$item];\r\n";
    $content .= "var galinp_MaxNotesLength = $maxNotesLength;\r\n";
	$content .= "var galinp_MaxCommentLength = $maxCommentLength;\r\n";
	
	file_put_contents('galeri.input.config.js', $content);
}

function GetAllowedPictType()
{
    global $allowedPictType;
    
    $item = "";
    for($i = 0; $i < count($allowedPictType); $i++)
    {
        if ($item != "")
            $item .= ", ";
        $item .= $allowedPictType[$i];    
    }
    
    return $item;
}

function GetAllowedDocType()
{
    global $allowedDocType;
     
    $item = "";
    for($i = 0; $i < count($allowedDocType); $i++)
    {
        if ($item != "")
            $item .= ", ";
        $item .= $allowedDocType[$i];    
    }
    
    return $item;
}
?>