<?php
namespace App\Helpers;

class CdpProjectHelper 
{
    /**
     * Validate Ten Day Children Breakup.
     *
	 * @param  int  $package
     * @return boolean
     */
    public static function isValidTenDayChildrenBreakup($package)
    {
		$breakup = array_sum(request()->only(['beginner_children_no', 'primary_children_no', 'junior_children_no', 'inter_children_no', 'senior_children_no']));
		
		return $package == $breakup;
	}
	
    /**
     * Validate Ten Day Children Attending.
     *
	 * @param  int  $package
     * @return boolean
     */
    public static function isValidTenDayChildrenAttending($package)
    {
		$attending = array_sum(request()->only(['christian_children', 'non_christian_children']));
		//var_dump($package == $attending);
		return $package == $attending;
	}
}
