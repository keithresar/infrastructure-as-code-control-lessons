<?php

class TimeUtils
{
	/* Returns fuzzy time as either:

			seconds ago
			n minutes
			n hours
			specific month/day
	*/


    public static function SecondsToHoursMinutesLongHand($seconds)
    {
        $hours = floor($seconds/3600);
        $minutes = round(($seconds%3600)/60);

        $time_fields = array();
        if ($hours>1)  $time_fields[] = $hours.' hour';
        else if ($hours==1)  $time_fields[] = $hours.' hour';
        if ($minutes>1)  $time_fields[] = $minutes.' minute';
        else if ($minutes==1)  $time_fields[] = $minutes.' minute';

        return(join(" ",$time_fields));
    }


    public static function MinutesToHoursMinutesLongHand($minutes) { return(TimeUtils::SecondsToHoursMinutesLongHand($minutes*60)); }


	public static function FuzzyTimeSMD($time)
	{
		$delta = time()-$time;

		switch (true)  {
			/* future */
			case ($delta<-3600*25):
				return(date('M j',$time));
				break;
			case ($delta<-3600):
				return("in ".(round($delta/3600*-1)." hours"));
				break;
			case ($delta<-61):
				return("in ".(round($delta/60*-1)." minutes"));
				break;
			case ($delta<-60):
				return("seconds from now");
				break;

			/* past */
			case ($delta<60):
				return("seconds ago");
				break;
			case ($delta<3600):
				return((round($delta/60)." minutes ago"));
				break;
			case ($delta<3600*24):
				return((round($delta/3600)." hours ago"));
				break;
			case ($delta<3600*24*180):
				return(date('M j',$time));
				break;
			default:
				return(date('M j, Y',$time));
				break;
		};
	}


	public static function FuzzyTimeDelta($delta)
	{
		switch (true)  {
			case ($delta<60):
				return("seconds");
				break;
			case ($delta<3600):
				return((round($delta/60)." minutes"));
				break;
			case ($delta<3600*24):
				return((round($delta/3600)." hours"));
				break;
			case ($delta<3600*24*180):
				return((round($delta/(3600*24))." days"));
				break;
			default:
				return((round($delta/(3600*730))." months"));
				break;
		};
	}


	public static function TimezoneDropdownName($class="",$name="tz",$default=false)
	{
        require_once("functions/forms.php");

	    $query = "select mysql_name,
	                     description,
	                     sort_order
	               from timezones
	                order by sort_order";
	    $qr = MysqliQuery($query);
	
	    while ($result = mysqli_fetch_array($qr))  {
	        $array[] = $result["mysql_name"];
	        $array[] = $result["description"];
	    }
	
        if ($default)  $tz = $default;
        else if (array_key_exists("tz",$_REQUEST))  $tz = $_REQUEST["tz"];
        else if (array_key_exists("tz",$_SESSION))  $tz = $_SESSION["tz"];
        else  $tz = "";

	    return(FormDropDown($name,$tz,$array,$class));
	}


	public static function TimezoneDropdownOffset($class="",$name="tz_offset",$default=false)
	{
        require_once("functions/forms.php");

	    $query = "select mysql_name,
	                     description,
	                     sort_order
	               from timezones
	                order by sort_order";
	    $qr = MysqliQuery($query);
	
        $dateTime = new DateTime(); 
	    while ($r = mysqli_fetch_object($qr))  {
            $dateTime->setTimeZone(new DateTimeZone($r->mysql_name)); 
	        $array[] = $dateTime->format('Z')/3600;
	        $array[] = $r->description;
	    }
	
	    return(FormDropDown($name,$tz,$array,$class));

	}


	public static function TimezoneObject()
	{
	    $query = "select mysql_name,
	                     description,
	                     sort_order
	               from timezones
	                order by sort_order";
	    $qr = MysqliQuery($query);
	
        $obj = array();
        $dateTime = new DateTime(); 
	    while ($r = mysqli_fetch_object($qr))  {
            $dateTime->setTimeZone(new DateTimeZone($r->mysql_name)); 
            $obj[$r->mysql_name] = array(
                'name' => $r->mysql_name,
                'offset' => $dateTime->format('Z')/3600,
                'abbreviation' => $dateTime->format('T'),
            );
	    }
	
	    return($obj);
	}

}


?>
