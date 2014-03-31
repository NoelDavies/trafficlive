<?php
namespace NoelDavies\TrafficLive\Controllers;

use NoelDavies\TrafficLive\Client;
use NoelDavies\TrafficLive\Models\StaffEmployee;

Class StaffEmployees {

	/**
	 * get all of the StaffEmployees
	 *
	 * @version 1.0
	 * @since   1.0
	 * @author  Daniel Noel-Davies
	 *
	 * @return  StaffEmployees
	 */
	public static function get( ) {
		$StaffEmployees = Client::request('staff/employee');
		$StaffEmployees = $StaffEmployees['resultList'];

		return array_map( function($StaffEmployees){

			return new StaffEmployee($StaffEmployees);

		}, $StaffEmployees);
	}

	/**
	 * Get a StaffEmployees by it's id
	 *
	 * @version 1.0
	 * @since   1.0
	 * @author  Daniel Noel-Davies
	 *
	 * @param   integer  $StaffEmployeesId       A id that corresponds to a StaffEmployees within Traffic Live
	 *
	 * @return  Models\StaffEmployees
	 */
	public function getById( $StaffEmployeeId ) {
		$StaffEmployees = Client::request( 'staff/employee/' . $StaffEmployeesId );
		return new StaffEmployee( $StaffEmployees );
	}

}