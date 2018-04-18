<?php
App::uses('PricesWarehouse', 'Model');

/**
 * PricesWarehouse Test Case
 *
 */
class PricesWarehouseTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.prices_warehouse',
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
		'app.warehouse'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PricesWarehouse = ClassRegistry::init('PricesWarehouse');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PricesWarehouse);

		parent::tearDown();
	}

}
