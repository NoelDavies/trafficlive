<?php
namespace NoelDavies\TrafficLive\Controllers;

use NoelDavies\TrafficLive\Client;
use NoelDavies\TrafficLive\Models\Tag;
use NoelDavies\TrafficLive\Models\Job;

Class Tags {

	private static $tags;

	/**
	 * get all of the tags
	 *
	 * @version 1.0
	 * @since   1.0
	 * @author  Daniel Noel-Davies
	 *
	 * @return  Tag
	 */
	public static function get( ) {
		$tags = Client::request('tag');
		$tags = $tags['resultList'];

		$cacheName = sprintf('TrafficLive-Tags-%d-%d', date('n'), date('Y'));

		return array_map( function($tag){

			return new Tag($tag);

		}, $tags);
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
	public static function getById( $tagId ) {
		$job = Client::request( 'tag/' . $tagId );
		return new Job( $job );
	}

}