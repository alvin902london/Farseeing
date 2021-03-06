<?php
App::uses('Price', 'Model');

/**
 * Price Test Case
 *
 */
class PriceTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
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
		'app.warehouse',
		'app.prices_warehouse'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Price = ClassRegistry::init('Price');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Price);

		parent::tearDown();
	}

}
