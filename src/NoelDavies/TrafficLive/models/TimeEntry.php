<?php
namespace NoelDavies\TrafficLive\Models;

Class TimeEntry extends Base_Model {

	protected $fillable = [
		'id',
		'billable',
		'minutes',
		'taskDescription',
		'taskComplete',
		'timeEntryCost',
		'taskRate'
	];

	protected $rules = [
		'id'              => 'required|integer',
		'billable'        => 'required|boolean',
		'minutes'	      => 'required|integer',
		'taskDescription' => 'string',
		'taskComplete'    => 'required|boolean'
	];

	public function job( )
	{
		return \NoelDavies\TrafficLive\Controllers\Jobs::getById( $this->jobId['id'] );
	}

}