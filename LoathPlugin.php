<?php
namespace Craft;

/**
 * Loath @v1.0.0
 *
 * @author		Selvin Ortiz - http://twitter.com/selvinortiz
 * @package		Loath
 * @category	Unit Testing
 * @copyright	2014 Selvin Ortiz
 * @license		[MIT]
 */

class LoathPlugin extends BasePlugin
{
	/**
	 * This is a good place to load dependencies and register event listeners
	 */
	public function init() {}

	public function getName()
	{
		// Could use Craft::t('Loathing') instead
		return 'Loathing';
	}

	public function getVersion()
	{
		return '1.0.0';
	}

	public function getDeveloper()
	{
		return 'Selvin Ortiz';
	}

	public function getDeveloperUrl()
	{
		return 'http://twitter.com/selvinortiz';
	}

	public function hasCpSection()
	{
		return false;
	}

	public function defineSettings()
	{
		return array();
	}

	/**
	 * This is a good place to run methods that insert data or address skept migrations
	 */
	public function onAfterInstall() {}
}
