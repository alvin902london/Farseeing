<?php
App::uses('ProductsFeature', 'Model');

/**
 * ProductsFeature Test Case
 *
 */
class ProductsFeatureTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.products_feature',
		'app.product',
		'app.country',
		'app.brand',
		'app.category',
		'app.group',
		'app.price',
		'app.company',
		'app.unit',
		'app.warehouse',
		'app.prices_warehouse',
		'app.feature'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ProductsFeature = ClassRegistry::init('ProductsFeature');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ProductsFeature);

		parent::tearDown();
	}

}
