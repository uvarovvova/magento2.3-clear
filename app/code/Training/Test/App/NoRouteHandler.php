<?php

namespace Training\Test\App;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\Router\NoRouteHandlerInterface;

/**
 * Class NoRouteHandler
 * @package Training\Test\App
 */
class NoRouteHandler implements NoRouteHandlerInterface
{
	/**
	 * @param RequestInterface $request
	 * @return bool
	 */
	public function process(RequestInterface $request)
	{
		$moduleName = 'cms';
		$controllerPath = 'index';
		$controllerName = 'index';
		$request->setModuleName($moduleName)
			->setControllerName($controllerPath)
			->setActionName($controllerName);
		return true;
	}
}