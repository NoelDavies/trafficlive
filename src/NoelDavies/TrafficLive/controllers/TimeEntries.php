<?php
namespace NoelDavies\TrafficLive\Controllers;

use NoelDavies\TrafficLive\Client;
use NoelDavies\TrafficLive\Models\TimeEntry;

Class TimeEntries {

	private static $entries;

	/**
	 * get all of the time entries
	 *
	 * @version 1.0
	 * @since   1.0
	 * @author  Daniel Noel-Davies
	 *
	 * @return  TimeEntry
	 */
	public static function get( ) {
		$entries = Client::request('timeentries', ['windowSize' => '100']);

		return array_map( function($entry){

			return new TimeEntry($entry);

		}, $entries);
	}


	/**
	 * get all of the time entries between specific dates
	 *
	 * @version 1.
	 * @since   1.0
	 * @author  Daniel Noel-Davies
	 *
	 * @return  TimeEntry on success, null on failure
	 */
	public static function getBetweenDates( $startDate, $endDate )
	{
		// Attempt to fetch the jobs in this job and time stretch
		// try {
			$entries = Client::request( 'timeentries', compact('startDate', 'endDate') );

			$entries = $entries['resultList'];

			if( empty( $entries ) )
			{
				return null;
			}

			return array_map( function($entry){

				return new TimeEntry($entry);

			}, $entries);
		// }

		// catch( \Exception $e )
		// {
			// return null;
		// }
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
	public function getById( $entryId ) {
		$entry = Client::request( 'timeentries/' . $entryId );
		return new TimeEntry( $entry );
	}

	/**
	 * Get time entries by a job id
	 *
	 * @version 1.0
	 * @since   1.0
	 * @author  Daniel Noel-Davies
	 *
	 * @param   integer  $jobId       A id that corresponds to a job within Traffic Live
	 *
	 * @return  Models\Job
	 */
	public static function getByJobId( $jobId, $startDate, $endDate ) {
		// Attempt to fetch the jobs in this job and time stretch
		try {
			$entries = Client::request( 'timeentries', [ 'filter' => 'jobId|IN|[' . $jobId . ']', 'startDate' => $startDate, 'endDate' => $endDate ] );

			return array_map( function($entry){

				return new TimeEntry($entry);

			}, TimeEntries::$entries);
		}

		catch( \Exception $e )
		{
			return false;
		}

	}

}