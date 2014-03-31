<?php
namespace NoelDavies\TrafficLive\Models;

Class Tag extends Base_Model {
	protected $fillable = [
		'id',
		'name'
	];

	protected $rules = [
		'id'                                => 'required|integer|unique',
		'name'		                        => 'required|text',
	];

	public function jobs( )
	{
		return \NoelDavies\TrafficLive\Controllers\Jobs::getByFreeTag( $this->id );
	}
}