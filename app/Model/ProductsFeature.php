<?php
App::uses('AppModel', 'Model');
/**
 * ProductsFeature Model
 *
 * @property Product $Product
 * @property Feature $Feature
 */
class ProductsFeature extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'product_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Feature' => array(
			'className' => 'Feature',
			'foreignKey' => 'feature_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
