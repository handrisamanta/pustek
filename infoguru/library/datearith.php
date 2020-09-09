<?
class DateArith
{
	public static function DaysInMonth($M, $Y)
	{
		if ($M == 1 || $M == 3 || $M == 5 || $M == 7 || $M == 8 || $M == 10 || $M == 12)
			return 31;
		elseif ($M == 4 || $M == 6 || $M == 9 || $M == 11)  
			return 30;
		else
			if ((abs($Y - 2000) % 4) == 0)
				return 29;
			else
				return 28;
	}
	
	public static function DaysInYear($Y)
	{
		$nDiv4 = floor($Y / 4);
		$nNon4 = $Y - $nDiv4;
		return $nDiv4 * 366 + $nNon4 * 365;
	}
	
	// format dt must be YY-MM-DD HH:MN:SS
	//   second will be ignored
	public static function DateToMinute($dt)
	{
		$pos1 = 0;
		$pos2 = strpos($dt, "-", $pos1);
		$YY =   substr($dt, $pos1, $pos2 - $pos1);
		
		$pos1 = $pos2 + 1;
		$pos2 = strpos($dt, "-", $pos1);
		$MM   = substr($dt, $pos1, $pos2 - $pos1);
	
		$pos1 = $pos2 + 1;
		$pos2 = strpos($dt, " ", $pos1);
		$DD   = substr($dt, $pos1, $pos2 - $pos1);
	
		$pos1 = $pos2 + 1;
		$pos2 = strpos($dt, ":", $pos1);
		$HH   = substr($dt, $pos1, $pos2 - $pos1);
		
		$pos1 = $pos2 + 1;
		$pos2 = strpos($dt, ":", $pos1);
		$MN   = substr($dt, $pos1, $pos2 - $pos1);
		
		$total  = $MN;
		$total += $HH * 60;
		$total += $DD * 24 * 60; 
		for ($i = 1; $i <= $MM; $i++)
			$total += DateArith::DaysInMonth($i, $YY) * 24 * 60;
		$total += DateArith::DaysInYear($YY) * 24 * 60;
		
		return $total;
	}
	
	public static function FormatDigit($digit)
	{
		return strlen($digit) == 2 ? $digit : "0$digit";
	}
	
	public static function TimeDiff($time1, $time2, &$hourDiff, &$minuteDiff, &$secondDiff)
	{
		$hourDiff = 0;
		$minuteDiff = 0;
		$secondDiff = 0;
		
		if (strpos($time1, ":") === FALSE)
			return;
		
		if (strpos($time2, ":") === FALSE)
			return;
		
		$atime1 = split(":", $time1);
		$atime2 = split(":", $time2);
		
		if (count($atime1) == 2)
			$itime1 = array($atime1[0], $atime1[1], 0);
		else
			$itime1 = array($atime1[0], $atime1[1], $atime1[2]);
			
		if (count($atime2) == 2)
			$itime2 = array($atime2[0], $atime2[1], 0);
		else
			$itime2 = array($atime2[0], $atime2[1], $atime2[2]);
			
		if (count($itime1) != 3 || count($itime2) != 3)
			return;
		
		if ($itime1[0] > $itime2[0])
		{
			$tempi = $itime1;
			$itime1 = $itime2;
			$itime2 = $tempi;
		}
		
		$deltam = 0;
		$temp = $itime2[2] - $itime1[2];
		if ($temp < 0)
		{
			$secondDiff = 60 + $temp;
			$deltam = 1;
		}
		else
		{
			$secondDiff = $temp;
		}
		
		$deltah = 0;
		$temp = $itime2[1] - $itime1[1];
		if ($temp < 0)
		{
			$minuteDiff = 60 + $temp;
			$deltah = 1;
		}
		else
		{
			$minuteDiff = $temp;
		}
		$minuteDiff -= $deltam;
		
		$hourDiff = abs($itime2[0] - $itime1[0]);
		$hourDiff -= $deltah;
	}
}
?>