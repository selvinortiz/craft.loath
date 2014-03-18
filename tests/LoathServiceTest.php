<?php
namespace Craft;

use \Mockery as m;

class LoathServiceTest extends BaseTest
{
	protected $config;

	public function setUp()
	{
		$this->config = m::mock('Craft\ConfigService');
		$this->config->shouldReceive('getIsInitialized')->andReturn(true);
		$this->config->shouldReceive('usePathInfo')->andReturn(true)->byDefault();

		$this->config->shouldReceive('get')->with('devMode')->andReturn(true)->byDefault();
		$this->config->shouldReceive('get')->with('usePathInfo')->andReturn(true)->byDefault();
		$this->config->shouldReceive('get')->with('cpTrigger')->andReturn('admin')->byDefault();
		$this->config->shouldReceive('get')->with('pageTrigger')->andReturn('p')->byDefault();
		$this->config->shouldReceive('get')->with('actionTrigger')->andReturn('action')->byDefault();
		$this->config->shouldReceive('get')->with('translationDebugOutput')->andReturn(false)->byDefault();

		$this->config->shouldReceive('getLocalized')->with('loginPath')->andReturn('login')->byDefault();
		$this->config->shouldReceive('getLocalized')->with('logoutPath')->andReturn('logout')->byDefault();
		$this->config->shouldReceive('getLocalized')->with('setPasswordPath')->andReturn('setpassword')->byDefault();

		$this->config->shouldReceive('getCpLoginPath')->andReturn('login')->byDefault();
		$this->config->shouldReceive('getCpLogoutPath')->andReturn('logout')->byDefault();
		$this->config->shouldReceive('getCpSetPasswordPath')->andReturn('setpassword')->byDefault();
		$this->config->shouldReceive('getResourceTrigger')->andReturn('resource')->byDefault();

		$this->setComponent(craft(), 'config', $this->config);
		$this->loadDependencies();
	}

	/**
	 * @Note
	 * 
	 * Getting model properties via $model->property works but...
	 * if you use $model->getAttribute('property') you code becomes more testable
	 */
	public function testGetTranslatedDefinition()
	{
		// The actual service with a translator dependency
		$service			= new LoathService('\\Loath\\Mocks\\Craft');

		// The actual model which can be easily mocked as well
		$model				= new LoathModel;
		$model->word		= 'Hatred';
		$model->definition	= 'Intense dislike or ill will.';
		
		// A mocked model to illustrate how it can be done
		$mockedModel		= m::mock('Craft\LoathModel');
		$mockedModel->shouldReceive('validate')->andReturn(true);
		$mockedModel->shouldReceive('getAttribute')->with('definition')->andReturn('Intense dislike or ill will.');

		// Using the actual model
		$this->assertEquals('Mocked Craft::t() was called.', $service->getTranslatedDefinition($model));

		// Using the mocked model
		$this->assertEquals('Mocked Craft::t() was called.', $service->getTranslatedDefinition($mockedModel));
	}

	public function testGetSafeOutput()
	{
		$html		= '<p>Unit testing (ro|su)cks.</p>';
		$service	= new LoathService;

		$this->assertTrue($service->getSafeOutput($html) instanceof \Twig_Markup);
		$this->assertEquals($html, (string) $service->getSafeOutput($html));
	}

	protected function loadDependencies()
	{
		$dir = __DIR__;
		$map = array(
			'\\Craft\\LoathModel'	=> '/../models/LoathModel.php',
			'\\Craft\\LoathService'	=> '/../services/LoathService.php',
			'\\Loath\\Mocks\\Craft'	=> '/mocks/Craft.php',
		);

		foreach ($map as $classPath => $filePath)
		{
			if (!class_exists($classPath, false))
			{
				require_once $dir.$filePath;
			}
		}
	}
}
