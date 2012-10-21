<?php

/**
 * System service is used for internal system helpers & to retrieve system level information
 *
 * @service system
 * @package api
 * @subpackage services
 */
class SystemService extends KalturaBaseService 
{
	
	protected function partnerRequired($actionName)
	{
		if ($actionName == 'ping' || $actionName == 'getServerTime') {
			return false;
		}
		return parent::partnerRequired($actionName);
	}
	
	/**
	 *
	 * 
	 * @action ping
	 * @return bool Always true if service is working
	 */
	function pingAction()
	{
		return true;
	}
	
	/**
	 *
	 * 
	 * @action getServerTime
	 * @return int Return current server timestamp
	 */
	function getServerTimeAction()
	{
		return time();
	}
}