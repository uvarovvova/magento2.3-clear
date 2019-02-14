<?php

namespace Training\Test\App;

use Magento\Framework\App\Request\ValidatorInterface as RequestValidator;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\App\RouterList;
use Magento\Framework\App\Response\Http;
use Magento\Framework\App\RouterListInterface;
use Magento\Framework\Message\ManagerInterface as MessageManager;
use Psr\Log\LoggerInterface;
use Magento\Framework\App\RequestInterface;

/**
 * Class FrontController
 * @package Training\Test\App
 */
class FrontController extends \Magento\Framework\App\FrontController
{
	/**
	 * @var \Magento\Framework\App\RouterList
	 */
	protected $routerList;

	/**
	 * @var \Magento\Framework\App\Response\Http
	 */
	protected $response;

	/**
	 * @var \Psr\Log\LoggerInterface
	 */
	private $logger;


	public function __construct(
		RouterListInterface $routerList,
		ResponseInterface $response,
		RequestValidator $requestValidator = null,
		MessageManager $messageManager = null,
		LoggerInterface $logger = null
	)
	{
		$this->routerList = $routerList;
		$this->response = $response;
		$this->logger = $logger;
		parent::__construct($routerList, $response, $requestValidator, $messageManager, $logger);
	}


	public function dispatch(RequestInterface $request)
	{
		$availableRouts = "";
		foreach ($this->_routerList as $router) {
			$availableRouts .= get_class($router) . "\r\n";

		}
//		$this->logger->info('22');
		var_dump($availableRouts);
//		exit;
		return parent::dispatch($request);
	}
}