<?php
App::uses('Feature', 'Model');

/**
 * Feature Test Case
 *
 */
class FeatureTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.feature',
		'app.product',
		'app.country',
		'app.brand',
		'app.category',
		'app.group',
		'app.price',
		'app.products_feature'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Feature = ClassRegistry::init('Feature');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Feature);

		parent::tearDown();
	}

}
