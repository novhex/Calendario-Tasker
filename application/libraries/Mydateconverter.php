<?php
defined("BASEPATH") or exit("Error!");

/**
* 
*/
class Mydateconverter{

	public function __construct(){

	}

	public function convertDate($str){
		$full_date="";
		$current_month = substr($str, 4,3);
		$current_date = substr($str,7,3);
		$current_year = substr($str, 10,5);


		$full_date =  $current_year."-".$this->determineMonthNum($current_month)."-".$current_date;

		return str_replace(" ", "", $full_date);

	}

	public function determineMonthNum($str){
		$month_num="";
		switch($str){
				case 'Jan':
					$month_num="01";
					return $month_num;
				break;

				case 'Feb':
					$month_num="02";
					return $month_num;
				break;

				case 'Mar':
					$month_num="03";
					return $month_num;
				break;
				
				case 'Apr':
					$month_num="04";
					return $month_num;
				break;

				case 'May':
					$month_num="05";
					return $month_num;
				break;

				case 'Jun':
					$month_num="06";
					return $month_num;
				break;
				

				case 'Jul':
					$month_num="07";
					return $month_num;
				break;

				case 'Aug':
					$month_num="08";
					return $month_num;
				break;

				case 'Sep':
					$month_num="09";
					return $month_num;
				break;
				
				case 'Oct':
					$month_num="10";
					return $month_num;
				break;

				case 'Nov':
					$month_num="11";
					return $month_num;
				break;

				case 'Dec':
					$month_num="12";
					return $month_num;
				break;
							
				
		}
	

	}

}