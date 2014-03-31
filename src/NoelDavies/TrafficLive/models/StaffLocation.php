<?php
namespace NoelDavies\TrafficLive\Models;

Class StaffLocation extends Base_Model {
	protected $fillable = ['location'];

	protected $rules = [
		'location' => 'required:alpha'
	];

}