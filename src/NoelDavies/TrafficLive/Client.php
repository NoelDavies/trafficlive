<?php
namespace NoelDavies\TrafficLive;

use Config, Guzzle, Response, Carbon;

Class Client {

	public static $resultCount;
	public static $windowSize;
	public static $currentPage;

	/**
	 * Send a basic request off to Traffic Live
	 *
	 * @version 1.0
	 * @since   1.0
	 * @author  Daniel Noel-Davies
	 *
	 * @param   string  $url       Api URL
	 *
	 * @return  Object
	 */
	public static function request( $url , Array $params = [] ) {

		$request = self::setupClient( $url );

		self::setupRequest( $request, $params );

		$results = self::sendRequest( $request, $url, $params );

		return $results;
	}

	/**
	 * Setup the guzzle client
	 *
	 * @version 1.0
	 * @since   1.0
	 * @author  Daniel Noel-Davies
	 *
	 * @param   string  $url       Api URL
	 *
	 * @return  Object
	 */
	public static function setupClient( $url )
	{
		// Initiate the client with the API url
		$client = new Guzzle\Http\Client(
			Config::get('TrafficLive::api_url')
		);

		// Setup the basic authentication to Traffic Live
		$client->setDefaultOption('auth', array(
			Config::get('TrafficLive::api_email'),
			Config::get('TrafficLive::api_token'),
			'Basic'
		));

		return $client->get( $url );
	}
	
	/**
	 * Setup the guzzle request
	 *
	 * @version 1.0
	 * @since   1.0
	 * @author  Daniel Noel-Davies
	 *
	 * @param   Object  $request       Guzzle Request Object 
	 *
	 * @return  void
	 */
	public static function setupRequest( $request, $params )
	{
		$request->addHeader('Accept', 'application/json');

		// Get the query string
		$query = $request->getQuery();

		// Add params if necessary
		if( !empty( $params ) )
		{
			// and add each param as part of the query string
			foreach ($params as $key => $value) {
				$query->add($key, $value);
			}
		}

		$query->add('windowSize', '500');
	}
	
	/**
	 * Send the request to the server
	 *
	 * @version 1.0
	 * @since   1.0
	 * @author  Daniel Noel-Davies
	 *
	 * @param   Object  $request       Guzzle Request Object 
	 * @param   String  $url           URL to send the request to 
	 * @param   Array   $params        Array of paramters to send with the request 
	 *
	 * @return  Object
	 */
	public static function sendRequest( $request, $url, $params = [] )
	{
		$result = self::getResult( self::getResponse( $request ) );

		// If we don't have all the results, go fetch MOAR!!!
		if ( isset($result['windowSize'] ) && $result['windowSize'] * $result['currentPage'] < $result['maxResults'] )
		{
			$params['currentPage'] = $result['currentPage'] + 1;

			$currentPage           = $result['resultList'];
			$nextPage              = self::request( $url, $params );
			$combinedResults       = array_merge( $currentPage, $nextPage['resultList']);

			return [
				'maxResults'   => $result['maxResults'],
				'resultList'   => $combinedResults,
				'windowSize'   => $result['windowSize'],
				'currentPage'  => $result['currentPage']
			];
		}

		return $result;
	}
	
	/**
	 * Fetch the response from the request
	 *
	 * @version 1.0
	 * @since   1.0
	 * @author  Daniel Noel-Davies
	 *
	 * @param   Object  $request       Guzzle Request Object 
	 *
	 * @return  Object  Guzzle Response
	 */
	public static function getResponse( $request )
	{
		return \Cache::remember( $request->getUrl(), 60, function() use ($request)
		{
			\Debugbar::warning( 'HTTP Request sent to: ' . $request->getUrl());

			// Send the request and store the response
			try
			{
				$response = $request->send();
			}
			// If we get a 503 result, then sleep, and try again to help avoid rate limiting
			catch( \Guzzle\Http\Exception\ServerErrorResponseException $e )
			{
				\Cache::forget($request->getUrl());
				sleep(5);
				$response = self::getResponse( $request );
			}

			return $response;
		});
	}

	public static function getResult( $response )
	{

		if( !is_object( $response ) )
		{
			dd($response);
		}

		return $response->json();
	}
}