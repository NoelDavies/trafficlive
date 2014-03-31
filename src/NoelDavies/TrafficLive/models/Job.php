<?php
namespace NoelDavies\TrafficLive\Models;

Class Job extends Base_Model {
	protected $fillable = [
		'id',
		'dateCreated',
		'dateModified',
		'lastUpdatedUserId',
		'jobNumber',
		'jobStateType',
		'jobBillingStateType',
		'jobDetailId',
		'jobCompletedDate',
		'internalDeadline',
		'externalDeadline',
		'jobUserCategoryListItemId',
		'appliedCustomRateSetId',
		'clientReference',
		'clientPurchaseOrderValue',
		'billableJob',
		'billedNet',
		'billedTaxOneAmount',
		'billedTaxTwoAmount',
		'externalCode',
		'secondaryExternalCode',
		'freeTags',
		'realisationThreshold',
		'jobTasks',
		'jobThirdPartyCosts',
		'jobExpenses',
		'jobStages',
		'invoices',
		'multicurrencyRate',
		'otherCurrency',
		'multiCurrencyEditMode',
		'multiCurrencySyncMode',
		'externalData',
		'userSpecifiedPercentComplete',
		'userSpecifiedPercentCompleteValue',
		'potentialValue',
		'estimatedSellValue',
		'realisationPercent',
		'timeBillings',
		'realisationPercentageAsBilled',
		'potentialValueOfActuals',
		'multicurrencyEnabled'
	];

	protected $rules = [
		'id'                                => 'required|integer|unique',
		'dateCreated'                       => 'required|date',
		'dateModified'                      => 'date',
		'lastUpdatedUserId'                 => 'integer',
		'jobNumber'                         => 'required',
		'jobStateType'                      => 'required|alpha',
		'jobBillingStateType'               => 'required|alpha',
		'jobDetailId'                       => 'required|integer',
		'jobCompletedDate'                  => 'date',
		'internalDeadline'                  => 'date',
		'externalDeadline'                  => 'date',
		// 'jobUserCategoryListItemId'         => '',
		// 'appliedCustomRateSetId'            => '',
		// 'clientReference'                   => '',
		// 'clientPurchaseOrderValue'          => '',
		'billableJob'                       => '',
		// 'billedNet'                         => '',
		// 'billedTaxOneAmount'                => '',
		// 'billedTaxTwoAmount'                => '',
		// 'externalCode'                      => '',
		// 'secondaryExternalCode'             => '',
		// 'freeTags'                          => '',
		// 'realisationThreshold'              => '',
		// 'jobTasks'                          => '',
		// 'jobThirdPartyCosts'                => '',
		// 'jobExpenses'                       => '',
		// 'jobStages'                         => '',
		// 'invoices'                          => '',
		// 'multicurrencyRate'                 => '',
		// 'otherCurrency'                     => '',
		// 'multiCurrencyEditMode'             => '',
		// 'multiCurrencySyncMode'             => '',
		// 'externalData'                      => '',
		// 'userSpecifiedPercentComplete'      => '',
		// 'userSpecifiedPercentCompleteValue' => '',
		// 'potentialValue'                    => '',
		// 'estimatedSellValue'                => '',
		// 'realisationPercent'                => '',
		// 'timeBillings'                      => '',
		// 'realisationPercentageAsBilled'     => '',
		// 'potentialValueOfActuals'           => '',
		// 'multicurrencyEnabled'              => '',
	];

	// public function details()
	// {
	// 	return $this->hasOne('jobDetail', 'jobDetailId');
	// }

	public function details( )
	{
		return \NoelDavies\TrafficLive\Controllers\JobDetails::getById( $this->jobDetailId );
	}

	public function timeEntries( $startDate, $endDate )
	{
		return \NoelDavies\TrafficLive\Controllers\TimeEntries::getByJobId( $this->id, $startDate, $endDate );
	}

	public function tags( )
	{
		if( !$this->freeTags || !is_array( $this->freeTags ) || !array_key_exists( 0, $this->freeTags ) )
		{
			return null;
		}

		return \NoelDavies\TrafficLive\Controllers\Tags::getById( $this->freeTags[0]['freeTagId']['id'] );
	}
}