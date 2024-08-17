<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTime;
use DatePeriod;
use DateInterval;

class CommanModel extends Model
{
    use HasFactory;
  
    public static function dateData($date){
		$month = date('m', strtotime($date));
		$year = date('Y', strtotime($date));
		$day_in_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);
		return ['fdate'=>$year."-".$month."-1", 'ldate'=>$year."-".$month."-".$day_in_month, 'day_in_month'=>$day_in_month ];
		
		// $date1=date_create($from_date);
		// $date2=date_create($to_date);
		// $diff=date_diff($date1, $date2);
		// $total_days = $diff->format("%a")+1;
		// $from_days = cal_days_in_month(CAL_GREGORIAN, date('m', strtotime($from_date)), date('Y',strtotime($from_date)) );
	}
    public static function countDateOf2Dates($start, $end){
		$start = strtotime($start);
		$end = strtotime($end);
    	// var_dump($start);die;
		return ceil(abs((($end+86400) - $start) / 86400));
	}
    /*public static function getDatesOf2Dates($start, $end){
		$period = new DatePeriod(
		    new DateTime($start),
		    new DateInterval('P1D'),
		    new DateTime($end)
		);
		echo "<pre>";
		print_r($period);die;
	}*/
	public static function getDatesFromRange($start, $end, $format = 'Y-m-d') {
      
        // Declare an empty array
        $array = array();
          
        // Variable that store the date interval
        // of period 1 day
        $interval = new DateInterval('P1D');
      
        $realEnd = new DateTime($end);
        $realEnd->add($interval);
      
        $period = new DatePeriod(new DateTime($start), $interval, $realEnd);
      
        // Use loop to store date into array
        foreach($period as $date) {                 
            $array[] = $date->format($format); 
        }
      
        // Return the array elements
        return $array;
    }
}
