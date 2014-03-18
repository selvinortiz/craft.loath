<?php
namespace Craft;

use \Mockery as m;

class LoathServiceTest extends BaseTest
{
	protected $config;
	protected $service;

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
		$this->loadServices();
	}

	public function testGetHatredDefinition()
	{
		// Should call Craft::t() and actually translate the definition
		$this->assertNotEquals('Mocked Craft::t() was called.', $this->service->getHatredDefinition());

		// Should call \Loath\Mocks\Craft::t() and return a stubbed string
		$this->assertEquals('Mocked Craft::t() was called.', $this->service->getHatredDefinition('\\Loathing\\Mocks\\Craft'));
	}

	public function testGetSafeOutput()
	{
		$html = '<p>Unit testing (ro|su)cks.</p>';
		$this->assertTrue($this->service->getSafeOutput($html) instanceof \Twig_Markup);
		$this->assertEquals($html, (string) $this->service->getSafeOutput($html));
	}

	protected function loadDependencies()
	{
		$dir = __DIR__;
		$map = array(
			'\\Loathing\\Mocks\\Craft'	=> '/mocks/Craft.php',
		);

		foreach ($map as $classPath => $filePath)
		{
			if (!class_exists($classPath))
			{
				require_once $dir.$filePath;
			}
		}
	}

	protected function loadServices()
	{
		require_once __DIR__ . '/../services/LoathingService.php';

		$this->service = new LoathService();
	}
}
