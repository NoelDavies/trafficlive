<?php
namespace NoelDavies\TrafficLive\Controllers;

use NoelDavies\TrafficLive\Client;
use NoelDavies\TrafficLive\Models\JobType;

Class JobTypes {
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
		$types = Client::request('listitem/JOB_TYPE_LIST');
		$types = $types['resultList'];

		$types = array_map( function( $type ){
			return new JobType($type);
		}, $types );

		return $types;
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
	public function getById( $jobId ) {
		$job = Client::request( 'job/' . $jobId );
		return new Job( $job );
	}

}