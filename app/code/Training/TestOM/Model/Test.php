<?php

namespace Training\TestOM\Model;

/**
 * Class Test
 * @package Training\TestOM\Model
 */
class Test
{

	private $manager;
	private $arrayList;
	private $name;
	private $number;
	private $managerFactory;
	private $managerInterfaceFactory;


	/**
	 * Test constructor.
	 * @param ManagerInterface $manager
	 * @param $name
	 * @param int $number
	 * @param array $arrayList
	 * @param ManagerFactory $managerFactory
	 * @param ManagerInterfaceFactory $managerInterfaceFactory
	 */
	public function __construct(
		\Training\TestOM\Model\ManagerInterface $manager,
		$name,
		int $number,
		array $arrayList = [],
		\Training\TestOM\Model\ManagerFactory $managerFactory
	)
	{
		$this->manager = $manager;
		$this->name = $name;
		$this->arrayList = $arrayList;
		$this->number = $number;
		$this->managerFactory = $managerFactory;
	}

	public function log()
	{
		print_r(get_class($this->manager));
		echo "<br>";
		print_r($this->name);
		echo "<br>";
		print_r($this->number);
		echo "<br>";
		print_r($this->arrayList);

		echo '<br>';
		$managerFactory = $this->managerFactory->create();
		print_r(get_class($managerFactory));

	}
}