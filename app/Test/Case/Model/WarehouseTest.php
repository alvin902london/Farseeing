<?php
App::uses('Warehouse', 'Model');

/**
 * Warehouse Test Case
 *
 */
class WarehouseTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.warehouse',
		'app.price',
		'app.company',
		'app.product',
		'app.country',
		'app.brand',
		'app.category',
		'app.group',
		'app.feature',
		'app.products_feature',
		'app.unit',
		'app.prices_warehouse'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Warehouse = ClassRegistry::init('Warehouse');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Warehouse);

		parent::tearDown();
	}

}
