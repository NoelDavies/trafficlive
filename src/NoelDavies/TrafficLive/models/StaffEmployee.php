<?php
namespace NoelDavies\TrafficLive\Models;

Class StaffEmployee extends Base_Model {

	protected $fillable = [
		'id',
		'dateCreated',
		'locationId',
		'departmentId',
		'ownerCompanyId',
		'active',
		'userId',
		'userName'
	];

	protected $rules = [
		'id'             => 'required|unique|integer',
		'dateCreated'    => 'required|date',
		'locationId'     => 'required|integer',
		'departmentId'   => 'required|integer',
		'ownerCompanyId' => 'required|integer',
		// 'active'      => '',
		'userId'         => 'required|integer',
		'userName'       => 'required|email'
	];

	public function Jobs()
	{
		return $this->BelongsToMany('Job');
	}

	public function location()
	{
		return $this->hasOne('StaffLocation', 'locationId');
	}

}