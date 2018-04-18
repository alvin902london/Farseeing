<?php
App::uses('AppModel', 'Model');
/**
 * PricesWarehouse Model
 *
 * @property Price $Price
 * @property Warehouse $Warehouse
 */
class PricesWarehouse extends AppModel {

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
		'Price' => array(
			'className' => 'Price',
			'foreignKey' => 'price_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Warehouse' => array(
			'className' => 'Warehouse',
			'foreignKey' => 'warehouse_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
