<?php
namespace NoelDavies\TrafficLive\Models;

Class Base_Model {

	// Variable to hold the current Object
	private $data = [];

	/**
	 * @version 1.0
	 * @since   1.0
	 * @author  Daniel Noel-Davies
	 *
	 * @param   string  $var       Parameter Description
	 *
	 * @return  
	 */
	public function __construct( $object ) {

		// Loop through each key and set it
		foreach( $object as $key => $val )
		{
			$this->data[$key] = $val;
		}
	}

	public function __set( $name, $value ){
		$this->data[$name] = $value;
	}

	public function __get( $name ){
		return $this->data[$name];
	}
}