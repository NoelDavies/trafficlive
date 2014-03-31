<?php namespace NoelDavies\TrafficLive;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

class TrafficLiveServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('NoelDavies/TrafficLive');

		require_once(dirname(__FILE__) . '/models/Base_Model.php');
		require_once(dirname(__FILE__) . '/models/Job.php');
		require_once(dirname(__FILE__) . '/models/JobDetail.php');
		require_once(dirname(__FILE__) . '/models/StaffLocation.php');
		require_once(dirname(__FILE__) . '/models/StaffEmployee.php');
		require_once(dirname(__FILE__) . '/models/Tag.php');
		require_once(dirname(__FILE__) . '/models/TimeEntry.php');


		AliasLoader::getInstance()->alias('TrafficClient',              'NoelDavies\TrafficLive\Client');
		AliasLoader::getInstance()->alias('TrafficLive_Jobs',           'NoelDavies\TrafficLive\Controllers\Jobs');
		AliasLoader::getInstance()->alias('TrafficLive_JobDetails',     'NoelDavies\TrafficLive\Controllers\JobDetails');
		AliasLoader::getInstance()->alias('TrafficLive_JobTypes',       'NoelDavies\TrafficLive\Controllers\JobTypes');
		AliasLoader::getInstance()->alias('TrafficLive_StaffLocations', 'NoelDavies\TrafficLive\Controllers\StaffLocations');
		AliasLoader::getInstance()->alias('TrafficLive_StaffEmployees', 'NoelDavies\TrafficLive\Controllers\StaffEmployees');
		AliasLoader::getInstance()->alias('TrafficLive_Tags',			'NoelDavies\TrafficLive\Controllers\Tags');
		AliasLoader::getInstance()->alias('TrafficLive_TimeEntries',	'NoelDavies\TrafficLive\Controllers\TimeEntries');
	}

	/**
	 * Register the service provider.
	 *	
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}