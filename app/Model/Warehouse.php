<?php
App::uses('AppModel', 'Model');
/**
 * Warehouse Model
 *
 * @property Price $Price
 */
class Warehouse extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Price' => array(
			'className' => 'Price',
			'joinTable' => 'prices_warehouses',
			'foreignKey' => 'warehouse_id',
			'associationForeignKey' => 'price_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		)
	);

}
