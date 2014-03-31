<?php
namespace NoelDavies\TrafficLive\Models;

Class JobDetail extends Base_Model {

	protected $fillable = [
		'id',
		'version',
		'dateCreated',
		'dateModified',
		'lateUpdatedUserId',
		'jobDescription',
		'name',
		'description',
		'notes',
		'jobContactId',
		'accountManagerId',
		'ownerProjectId',
		'jobTypeListItemId',
		'jobCostType'
	];

	protected $rules = [
		'id'                   => 'required|integer|unique:JobDetail',
		'version'              => 'required|integer',
		'dateCreated'          => 'required|date',
		'dateModified'         => 'date',
		'lastUpdatedUserId'    => 'required|exists:users,id',
		// 'jobDescription'    => null,
		'name'                 => 'required|alpha',
		// 'description'       => null,
		// 'notes'             => null,
		'jobContactId'         => 'required|integer',
		'accountManagerId'     => 'required|integer',
		'ownerProjectId'       => 'required|integer',
		// 'jobTypeListItemId' => null,
		'jobCostType'          => 'required|alpha'
	];

	// public function job()
	// {
	// 	return $this->belongsTo('Job');
	// }
}