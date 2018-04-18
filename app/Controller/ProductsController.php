<?php
App::uses('AppController', 'Controller');
/**
 * Products Controller
 *
 * @property Product $Product
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ProductsController extends AppController {

/**
 * Helpers
 *
 * @var array
 */
	public $helpers = array('Text', 'Js', 'Time');

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		//Init Conditions Array
		$conditions = array(); 
		$joins = array();
		$group = null;		
		//Check Name Filter
		if(isset($this->request->data['Product'])){
			//Country Filter
			if(!empty($this->request->data['Product']['country_id']) && $this->request->data['Product']['country_id'] != 'Please select'){
				//Match Country
				$conditions[] =  array(
					'Product.country_id LIKE' => $this->request->data['Product']['country_id']
				);
			}	
			//Brand Filter
			if(!empty($this->request->data['Product']['brand_id']) && $this->request->data['Product']['brand_id'] != 'Please select'){
				//Match Brand
				$conditions[] =  array(
					'Product.brand_id LIKE' => $this->request->data['Product']['brand_id']
				);
			}							
			//Category Filter
			if(!empty($this->request->data['Product']['category_id']) && $this->request->data['Product']['category_id'] != 'Please select'){
				//Match Category
				$conditions[] =  array(
					'Product.category_id LIKE' => $this->request->data['Product']['category_id']
				);
			}		
			//Feature Filter
			if(!empty($this->request->data['Product']['feature_id']) && $this->request->data['Product']['feature_id'] != 'Please select'){
				//Match Feature
				foreach($this->request->data['Product']['feature_id'] as $key => $val) {
					$conditions[] =  array(
						'Feature.id LIKE' => $val
					);
				}

			}
			$this->request->params['named']['page'] = 1;

		}

		/*
		 * Add new item from search query
		 */

		if(isset($this->request->data['ProductAdd'])){
			//Init Conditions Array
			$param = array('action' => 'add');

			//Country Filter
			if(!empty($this->request->data['Product']['country_id']) && $this->request->data['Product']['country_id'] != 'Please select'){
				//Match Country
				$param['country'] = $this->request->data['Product']['country_id'];
			}	
			//Brand Filter
			if(!empty($this->request->data['Product']['brand_id']) && $this->request->data['Product']['brand_id'] != 'Please select'){
				//Match Brand
				$param['brand'] = $this->request->data['Product']['brand_id'];
			}	
			//Category Filter
			if(!empty($this->request->data['Product']['category_id']) && $this->request->data['Product']['category_id'] != 'Please select'){
				//Match Category
				$param['category'] = $this->request->data['Product']['category_id'];
			}
			//Feature Filter
			if(!empty($this->request->data['Product']['feature_id']) && $this->request->data['Product']['feature_id'] != 'Please select'){
				//Match Feature
				$a = array();
				foreach($this->request->data['Product']['feature_id'] as $key => $val) {
					array_push($a, $val);
					$param['feature'] = $a;
				}
			}
			return $this->redirect($param);
		}

		$joins[] = array(
			'table' => 'products_features',
			'alias' => 'ProductsFeature',
			'type' => 'LEFT',
			'conditions' => array(
				'ProductsFeature.product_id = Product.id'
			)
		);	
		$joins[] = array(
			'table' => 'features',
			'alias' => 'Feature',
			'type' => 'LEFT',
			'conditions' => array(
				'ProductsFeature.feature_id = Feature.id'
			)
		);
		$group = array('Product.id');		
		$option = array(
        	'limit' => '100',
        	'joins' => $joins,
        	'group' => $group,
        	'conditions' => $conditions,
        	'order' => array(
        	    'Product.id' => 'asc'
        	)
        );
		$this->Product->recursive = 2;
		$this->Paginator->settings = $option;

		$this->set('products', $this->Paginator->paginate());

		$countries = $this->Product->Country->find('list');
		$companies = $this->Product->Price->Company->find('list');
		$brands = $this->Product->Brand->find('list');
		$categories = $this->Product->Category->find('list');
		$warehouses = $this->Product->Price->Warehouse->find('list');
		$units = $this->Product->Price->Unit->find('list');
		$features = $this->Product->Feature->find('list');
		$this->set(compact('countries', 'companies', 'brands', 'categories', 'grades', 'cuts', 'sizes', 'factories', 'packings', 'warehouses', 'units', 'features'));		

		//sort the prices by companies
		function filter_companies($array, $id) {
			foreach ($array['Price'] as $key => $val) {
				if ($val['company_id'] != $id) {
					unset($array['Price'][$key]);
				}
			} 
			return $array;
		}

		//sort prices of products
		function array_orderby() {
		    $args = func_get_args();
		    $data = array_shift($args);
		    foreach ($args as $n => $field) {
		        if (is_string($field)) {
		            $tmp = array();
		            foreach ($data as $key => $row)
		                $tmp[$key] = $row[$field];
		            $args[$n] = $tmp;
		            }
		    }
		    $args[] = &$data;
		    call_user_func_array('array_multisort', $args);
		    return array_pop($args);
		}

		function sort_price($product_raw) {
			$product_raw['Price'] = array_orderby($product_raw['Price'], 'date', SORT_DESC);
			$product_sorted = $product_raw;
			
			return $product_sorted;
		}

		//find closest
		function cmp_by_optionNumber($a, $b) {
			return $a['abs'] - $b['abs'];
		}

		function find_closest($array) {
			//find closest price to -30 day
			$startPoint = Date('Y-m-d', strtotime('-30 day'));
		    //$count = 0;
		    foreach($array as $key => $day)
		    {
		        //$interval[$count] = abs(strtotime($date) - strtotime($day));
		        $array[$key]['abs'] = abs(strtotime($startPoint) - strtotime($day['date']));
		        //$count++;
		    }
			$old_prices = $array;
			usort($old_prices, 'cmp_by_optionNumber');
			return $old_prices['0'];

		}	

	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Product->exists($id)) {
			throw new NotFoundException(__('Invalid product'));
		}
		$options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
		$this->set('product', $this->Product->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
	    if (isset($this->params['named']['country'])) {
	    	$this->set('country_param', $this->params['named']['country']);
	    }
	    if (isset($this->params['named']['brand'])) {
	    	$this->set('brand_param', $this->params['named']['brand']);
	    }	
	    if (isset($this->params['named']['category'])) {
	    	$this->set('category_param', $this->params['named']['category']);
	    }
	    if (isset($this->params['named']['feature'])) {
	    	$this->set('feature_param', $this->params['named']['feature']);	
	    }
		$countries = $this->Product->Country->find('list');
		$brands = $this->Product->Brand->find('list');
		$categories = $this->Product->Category->find('list');
		$features = $this->Product->Feature->find('list');
		$this->set(compact('countries', 'brands', 'categories', 'features'));		

		if ($this->request->is('post')) {

			/**
			 * Add Product.id
			 */

			//Check date to append
			$today = date('Y-m-d');
			//Find/Set the last product id of the day
			$options = array(
				'conditions' => array(
					'Product.created' => $today
				), 
				'order' => array(
					'Product.id' => 'DESC'
				));
			$last_id_of_the_day = $this->Product->find('first', $options);
			//Set Product id
			if (empty($last_id_of_the_day)) { 
				$id_to_be_added = '1'; 
			} else {
				$last_id_of_the_day_last_3_digit = substr($last_id_of_the_day['Product']['id'], -3);
				$id_to_be_added =  $last_id_of_the_day_last_3_digit + 1;
			}
			//Pad zero
			$id_to_be_added_padded = sprintf("%03d", $id_to_be_added);
			$this->request->data['Product']['id'] = date('ymd') . $id_to_be_added_padded;

			/**
			 * Check inputs for empty or repeating value 
			 */

			if (empty($this->request->data['Country']['name'])) {
				unset($this->request->data['Country']);
			} else {
				$revolt = array_search($this->request->data['Country']['name'], $countries);
				if ($revolt) {
					$this->request->data['Product']['country_id'] = $revolt;
					unset($this->request->data['Country']);
				}
				unset($revolt);
			}

			if (empty($this->request->data['Brand']['name'])) {
				unset($this->request->data['Brand']);
			} else {
				$revolt = array_search($this->request->data['Brand']['name'], $brands);
				if ($revolt) {
					$this->request->data['Product']['brand_id'] = $revolt;
					unset($this->request->data['Brand']);
				}
				unset($revolt);
			}
			if (empty($this->request->data['Category']['name'])) {
				unset($this->request->data['Category']);
			} else {
				$revolt = array_search($this->request->data['Category']['name'], $categories);
				if ($revolt) {
					$this->request->data['Product']['category_id'] = $revolt;
					unset($this->request->data['Category']);
				}
				unset($revolt);
			}

			foreach ($this->request->data['Feature']['Feature'] as $key => $value) {
				if (empty($value)) {
					unset($this->request->data['Feature']['Feature'][$key]);
				}
			}

			foreach ($this->request->data['New'] as $key => $value) {
				if (empty($value['name'])) {
					unset($this->request->data['New'][$key]);
				} else {
					$revolt = array_search($value['name'], $features);
					if ($revolt) {
						$value['name'] = $revolt;
						unset($this->request->data['New'][$key]);
					}
					unset($revolt);
				}
			}

			if (empty($this->request->data['Feature']['Feature'])) {
				unset($this->request->data['Feature']['Feature']);
			}

			if (empty($this->request->data['New'])) {
				unset($this->request->data['New']);
			} else {

				/**
				 * Save features
				 */

				$this->Product->Feature->create();
				if ($this->Product->Feature->saveAll($this->request->data['New'])) {
					$this->Session->setFlash(__('The feature has been saved.'));

					foreach ($this->request->data['New'] as $key => $value) {
						$options = array(
							'conditions' => array(
								'Feature.name' => $this->request->data['New'][$key]['name']
							)
						);				
						$new_feature = $this->Product->Feature->find('first', $options);
						$this->request->data['Feature']['Feature'][$key] = $new_feature['Feature']['id'];
					}
					unset($this->request->data['New']);	
				}

			}

			/**
			 * Save product
			 */

			$this->Product->create();
			if ($this->Product->saveAll($this->request->data)) {
				$this->Session->setFlash(__('The product has been saved.'), 'session_flash_link', array(
					'link_text' => 'Add price',
					'link_url' => array(
						'controller' => 'prices',
						'action' => 'add',
						'ref' => $this->request->data['Product']['id']
					)
				));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Product->exists($id)) {
			throw new NotFoundException(__('Invalid product'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Product->save($this->request->data)) {
				$this->Session->setFlash(__('The product has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
			$this->request->data = $this->Product->find('first', $options);
		}
		$countries = $this->Product->Country->find('list');
		$brands = $this->Product->Brand->find('list');
		$categories = $this->Product->Category->find('list');
		$features = $this->Product->Feature->find('list');
		$this->set(compact('countries', 'brands', 'categories', 'features'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Product->id = $id;
		if (!$this->Product->exists()) {
			throw new NotFoundException(__('Invalid product'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Product->delete()) {
			$this->Session->setFlash(__('The product has been deleted.'));
		} else {
			$this->Session->setFlash(__('The product could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Product->recursive = 0;
		$this->set('products', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Product->exists($id)) {
			throw new NotFoundException(__('Invalid product'));
		}
		$options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
		$this->set('product', $this->Product->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Product->create();
			if ($this->Product->save($this->request->data)) {
				$this->Session->setFlash(__('The product has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product could not be saved. Please, try again.'));
			}
		}
		$countries = $this->Product->Country->find('list');
		$brands = $this->Product->Brand->find('list');
		$categories = $this->Product->Category->find('list');
		$features = $this->Product->Feature->find('list');
		$this->set(compact('countries', 'brands', 'categories', 'features'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Product->exists($id)) {
			throw new NotFoundException(__('Invalid product'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Product->save($this->request->data)) {
				$this->Session->setFlash(__('The product has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
			$this->request->data = $this->Product->find('first', $options);
		}
		$countries = $this->Product->Country->find('list');
		$brands = $this->Product->Brand->find('list');
		$categories = $this->Product->Category->find('list');
		$features = $this->Product->Feature->find('list');
		$this->set(compact('countries', 'brands', 'categories', 'features'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Product->id = $id;
		if (!$this->Product->exists()) {
			throw new NotFoundException(__('Invalid product'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Product->delete()) {
			$this->Session->setFlash(__('The product has been deleted.'));
		} else {
			$this->Session->setFlash(__('The product could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
