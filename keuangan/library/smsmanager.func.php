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
function GetPhoneList($jenis, $nis)
{
    $phonelist = array();
    if ($jenis == 'SISPAY')
        $sql = "SELECT IF(s.hportu IS NULL, '', TRIM(s.hportu)),
                       IF(s.info1 IS NULL, '', TRIM(s.info1)),
                       IF(s.info2 IS NULL, '', TRIM(s.info2))
                  FROM jbsakad.siswa s
                 WHERE nis = '$nis'";
    else
        $sql = "SELECT IF(cs.hportu IS NULL, '', TRIM(cs.hportu)),
                       IF(cs.info1 IS NULL, '', TRIM(cs.info1)),
                       IF(cs.info2 IS NULL, '', TRIM(cs.info2))
                  FROM jbsakad.calonsiswa cs
                 WHERE nopendaftaran = '$nis'";
    //echo "$sql<br>";                        
    $res = QueryDb($sql);
    if (mysql_num_rows($res) > 0)
    {
        $row = mysql_fetch_row($res);
        $temp = array($row[0], $row[1], $row[2]);
        $j = 0;
        for($i = 0; $i < count($temp); $i++)
        {
            $phone = trim($temp[$i]);
            if (strlen($phone) < 5)
                continue;
            if (substr($phone, 0, 1) == "#")
                continue;
            
            $phonelist[$j] = $phone;
            $j++;
        }
    }
    
    return $phonelist;
}

function CreateSMSPaymentInfo($jenis, $departemen, $nis, $nama, $tanggal, $besar, $pembayaran, &$success)
{
    $success = true;
    
    $sql = "SELECT format
              FROM jbsfina.formatsms
             WHERE jenis = '$jenis'
               AND departemen = '$departemen'";
    //echo "$sql<br>";                        
    $formatsms = FetchSingle($sql);
    if (strlen(trim($formatsms)) == 0)
        return;
    //echo "$formatsms<br>";
    
    $phonelist = GetPhoneList($jenis, $nis);
    if (count($phonelist) == 0)
        return;
    
    $sql = "SELECT replid
              FROM jbsakad.departemen
             WHERE departemen = '$departemen'";
    //echo "$sql<br>";                        
    $deptid = (int)FetchSingle($sql);
    
    $idsmsgeninfo = 0;
    $sql = "SELECT COUNT(replid)
              FROM jbssms.smsgeninfo
             WHERE tanggal = CURDATE()
               AND tipe = 0
               AND info LIKE '[$jenis.$deptid]%'";
    //echo "$sql<br>";                          
    $ndata = (int)FetchSingle($sql);
    if ($ndata == 0)
    {
        $info = $jenis == 'SISPAY' ? "Siswa" : "Calon Siswa";
        
        $sql = "INSERT INTO jbssms.smsgeninfo
                   SET tanggal = CURDATE(), tipe = 0,
                       info = '[$jenis.$deptid] Pengiriman Otomatis SMS Informasi Pembayaran $info departemen $departemen',
                       pengirim = 'KEU.$deptid'";
        //echo "$sql<br>";                              
        QueryDbTrans($sql, $success);
        
        $sql = "SELECT LAST_INSERT_ID()";
        $idsmsgeninfo = (int)FetchSingle($sql);
    }
    else
    {
        $sql = "SELECT replid
                  FROM jbssms.smsgeninfo
                 WHERE tanggal = CURDATE()
                   AND tipe = 0
                   AND info LIKE '[$jenis.$deptid]%'";
        //echo "$sql<br>";                          
        $idsmsgeninfo = (int)FetchSingle($sql);           
    }
    
    if (!$success)
        return;
    
    for($i = 0; $success && $i < count($phonelist); $i++)
    {
        $phone = $phonelist[$i];
        
        $sms = $formatsms;
        $sms = str_replace("{NIS}", $nis, $sms);
        $sms = str_replace("{NAMA}", $nama, $sms);
        $sms = str_replace("{TANGGAL}", $tanggal, $sms);
        $sms = str_replace("{BESAR}", $besar, $sms);
        $sms = str_replace("{PEMBAYARAN}", $pembayaran, $sms);
        
        $sql = "INSERT INTO jbssms.outbox 
                   SET UpdatedInDB = NOW(), InsertIntoDB = NOW(), SendingDateTime = NOW(),
                       Text = '$sms', DestinationNumber = '$phone', Coding = '8bit', UDH = NULL,
                       Class = -1, TextDecoded = '', MultiPart = 'false', RelativeValidity = -1, SenderID = 'JIBAS.KEU', 
                       SendingTimeOut = '0000-00-00 00:00:00', DeliveryReport = 'default', CreatorID = 'JIBAS.KEU',
                       idsmsgeninfo = '$idsmsgeninfo', status = 0";
        //echo "$sql<br>";               
        QueryDbTrans($sql, $success);
        
        $sql = "INSERT INTO jbssms.outboxhistory
                   SET InsertIntoDB = NOW(),
                       SendingDateTime = NOW(),
                       Text = '$sms',
                       DestinationNumber = '$phone',
                       idsmsgeninfo = '$idsmsgeninfo',
                       status = 0,
                       SenderID = 'JIBAS.KEU'";
        //echo "$sql<br>";               
        QueryDbTrans($sql, $success);               
    }
    //exit();
}
?>