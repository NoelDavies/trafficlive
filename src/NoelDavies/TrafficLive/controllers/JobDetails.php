<?php
namespace NoelDavies\TrafficLive\Controllers;

use NoelDavies\TrafficLive\Client;
use NoelDavies\TrafficLive\Models\JobDetail;

Class JobDetails {

	/**
	 * get all of the jobs
	 *
	 * @version 1.0
	 * @since   1.0
	 * @author  Daniel Noel-Davies
	 *
	 * @return  Job
	 */
	public static function get( ) {
		$jobdetails = Client::request('jobdetail');
		$jobdetails = $jobdetails['resultList'];

		return array_map( function($jobdetail){

			return new JobDetail($jobdetail);

		}, $jobdetails);
	}

	/**
	 * Get a job by it's id
	 *
	 * @version 1.0
	 * @since   1.0
	 * @author  Daniel Noel-Davies
	 *
	 * @param   integer  $jobId       A id that corresponds to a job within Traffic Live
	 *
	 * @return  Models\Job
	 */
	public static function getById( $jobId ) {
		$jobDetail = Client::request( 'jobdetail/' . $jobId );
		return new JobDetail( $jobDetail );
	}

	/**
	 * get a list of jobs by their location id
	 *
	 * @version 1.0
	 * @since   1.0
	 * @author  Daniel Noel-Davies
	 *
	 * @param   object  $staffLocation       StaffLocation object
	 *
	 * @return  Collection of JobDetail objects
	 */
	public function getByLocationId( TrafficLive_StaffLocation $location ) {
		dd($location);	
	}

}