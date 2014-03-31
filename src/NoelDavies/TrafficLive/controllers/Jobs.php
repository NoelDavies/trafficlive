<?php
namespace NoelDavies\TrafficLive\Controllers;

use NoelDavies\TrafficLive\Client;
use NoelDavies\TrafficLive\Models\Job;

Class Jobs {

	private static $jobs;

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
		Jobs::$jobs = Client::request('job');
		Jobs::$jobs = Jobs::$jobs['resultList'];

		return array_map( function($job){

			return new Job($job);

		}, Jobs::$jobs);
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
		$job = Client::request( 'job/' . $jobId );
		return new Job( $job );
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
	 * @return  Models\Jobs
	 */
	public static function getByFreeTag( $freeTagId ) {
		$jobs = Client::request( 'job', [ 'filter' => 'freeTags|IN|[' . $freeTagId . ']' ]);
		if( empty( $jobs ) )
			return null;

		return array_map( function($job){

			return new Job($job);

		}, $jobs);
	}
}