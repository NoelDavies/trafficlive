<?php
namespace NoelDavies\TrafficLive\Controllers;

use NoelDavies\TrafficLive\Client;
use NoelDavies\TrafficLive\Models\StaffLocation;

Class StaffLocations {

	/**
	 * get all of the StaffLocations
	 *
	 * @version 1.0
	 * @since   1.0
	 * @author  Daniel Noel-Davies
	 *
	 * @return  StaffLocation
	 */
	public static function get( ) {
		$StaffLocations = Client::request('staff/location');
		$StaffLocations = $StaffLocations['resultList'];

		return array_map( function($StaffLocation){

			return new StaffLocation($StaffLocation);

		}, $StaffLocations);
	}

	/**
	 * Get a StaffLocation by it's id
	 *
	 * @version 1.0
	 * @since   1.0
	 * @author  Daniel Noel-Davies
	 *
	 * @param   integer  $StaffLocationId       A id that corresponds to a StaffLocation within Traffic Live
	 *
	 * @return  Models\StaffLocation
	 */
	public function getById( $StaffLocationId ) {
		$StaffLocation = Client::request( 'staff/location/' . $StaffLocationId );
		return new StaffLocation( $StaffLocation );
	}

	/**
	 * get simple list of locations
	 *
	 * @version 1.0
	 * @since   1.0
	 * @author  Daniel Noel-Davies
	 *
	 * @return  array
	 */
	public static function getSimple( ) {
		$staffLocations = Client::request('staff/location');

		$staffLocations = array_map(function($location){
			return $location['name'];
		}, $staffLocations);

		return $staffLocations;
	}

}