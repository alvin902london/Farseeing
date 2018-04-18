<?php
App::uses('Unit', 'Model');

/**
 * Unit Test Case
 *
 */
class UnitTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.unit',
		'app.price',
		'app.company',
		'app.product',
		'app.country',
		'app.brand',
		'app.category',
		'app.group',
		'app.feature',
		'app.products_feature',
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
		$this->Unit = ClassRegistry::init('Unit');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Unit);

		parent::tearDown();
	}

}
