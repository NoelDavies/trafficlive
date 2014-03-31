<?php
namespace NoelDavies\TrafficLive\Models;

Class JobType extends Base_Model {

	protected $fillable = [
		'id',
		'version',
		'dateCreated',
		'dateModified',
		'description',
		'value',
		'isDefault',
		'colorCode'
	];

	protected $rules = [
		'id'           => 'required|integer',
		'version'      => 'integer',
		'dateCreated'  => 'required|date',
		'dateModified' => 'date',
		'description'  => 'required|alpha',
		'value'        => 'string',
		// 'isDefault'    => 'required|bool',
		'colorCode'	   => 'required|integer'
	];

}