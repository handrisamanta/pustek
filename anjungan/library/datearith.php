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
}
?>