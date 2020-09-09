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
class CInfoSiswa
{
	private $nis;
	private $nama;
	private $reporttype;
    
    public function __construct()
    {
		if (isset($_REQUEST["nis"]))
		{
			$_SESSION["infosiswa.nis"] = $_REQUEST["nis"];
			$_SESSION["infosiswa.name"] = $this->getSiswaName($_REQUEST["nis"]);	
		}
		
		if (isset($_REQUEST['reporttype']))
		{
			$_SESSION['infosiswa.reporttype'] = $_REQUEST['reporttype'];
		}
		else
		{
			if (!isset($_SESSION['infosiswa.reporttype']))
				$_SESSION['infosiswa.reporttype'] = "PROFIL";
		}
		
		$this->nis = $_SESSION['infosiswa.nis'];
      $this->nama = $_SESSION['infosiswa.name'];
		$this->reporttype = $_SESSION['infosiswa.reporttype'];
    }
	
	public function ShowIdentity()
	{
		echo "<font style='font-size:17px; font-weight:bold; color:#666;'>";
        echo $this->nis;
        echo " - ";
        echo $this->nama;
        echo "</font>";
	}
    
    public function ShowReportComboBox()
    {
        echo "<br><br>";
        echo "Laporan : ";
        echo "<select id='reporttype' name='reporttype' onchange='GetReportContent()'>";
        echo "<option value='PROFIL' " . StringIsSelected($this->reporttype, "PROFIL") . ">Data Pribadi</option>";
		echo "<option value='KEUANGAN' " . StringIsSelected($this->reporttype, "KEUANGAN") . ">Keuangan</option>";
        echo "<option value='PRESENSIHARIAN' " . StringIsSelected($this->reporttype, "PRESENSIHARIAN") . ">Presensi Harian</option>";
		echo "<option value='PRESENSIPELAJARAN' " . StringIsSelected($this->reporttype, "PRESENSIPELAJARAN") . ">Presensi Pelajaran</option>";
        echo "<option value='NILAI' " . StringIsSelected($this->reporttype, "NILAI") . ">Nilai</option>";
		echo "<option value='RAPOR' " . StringIsSelected($this->reporttype, "RAPOR") . ">Rapor</option>";
		echo "<option value='PERPUSTAKAAN' " . StringIsSelected($this->reporttype, "PERPUSTAKAAN") . ">Perpustakaan</option>";
        echo "</select>";
		echo "<input type='button' class='but' style='color:red' value='LOGOUT' onclick='is_Logout()'>";
		echo "<input type='button' class='but' style='color:blue' value='REFRESH' onclick='GetReportContent()'>";
    }
    
    private function getSiswaName($nis)
	{
		$sql = "SELECT nama FROM siswa WHERE nis = '$nis'";
		$result = QueryDb($sql);
		$row = @mysql_fetch_array($result);
		return $row['nama'];
	}
	
	public function ShowReportContent()
	{
		if ($this->reporttype == "PROFIL")
			require_once("infosiswa.profile.php");
		elseif ($this->reporttype == "KEUANGAN")
			require_once("infosiswa.keuangan.php");
		elseif ($this->reporttype == "PRESENSIHARIAN")
			require_once("infosiswa.presensiharian.php");
		elseif ($this->reporttype == "PRESENSIPELAJARAN")
			require_once("infosiswa.presensipelajaran.php");
		elseif ($this->reporttype == "NILAI")
			require_once("infosiswa.nilai.php");
		elseif ($this->reporttype == "RAPOR")
			require_once("infosiswa.rapor.php");
		elseif ($this->reporttype == "PERPUSTAKAAN")
			require_once("infosiswa.perpustakaan.php");
		elseif ($this->reporttype == "CATSISWA")
			require_once("infosiswa.catatansiswa.php");
		elseif ($this->reporttype == "CATPPEL")
			require_once("infosiswa.catatanpelajaran.php");
		elseif ($this->reporttype == "CATPHAR")
			require_once("infosiswa.catatanharian.php");			
	}
}