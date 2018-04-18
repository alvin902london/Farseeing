<?php
App::uses('AppController', 'Controller');
/**
 * Prices Controller
 *
 * @property Price $Price
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class PricesController extends AppController {

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
		$companies = $this->Price->Company->find('list');
		$features = $this->Price->Product->Feature->find('list');
		$this->set(compact('companies', 'features'));		

		function sort_prices($data) {
			foreach ($data as $key => $row) {
    			$company[$key] = $row['Company']['name'];
   				$date[$key] = $row['Price']['date'];
			}
			//Sort the data with volume descending, edition ascending
			//Add $data as the last parameter, to sort by the common key
			array_multisort($company, SORT_ASC, $date, SORT_DESC, $data);
			return $data;
		}	
			
		//Init Conditions Array
		$conditions = array(); 

		if($this->request->is('post')){
			//Company Filter
			if(!empty($this->request->data['Price']['company_id']) && $this->request->data['Price']['company_id'] != 'Please select'){
				//Match Company
				$conditions[] =  array(
					'Price.company_id LIKE' => $this->request->data['Price']['company_id']
				);
			}	
			//Date Filter
			if(!empty($this->request->data['Price']['date']['year']) && !empty($this->request->data['Price']['date']['month']) && !empty($this->request->data['Price']['date']['day']) && $this->request->data['Price']['date']['year'] != 'Please select' && $this->request->data['Price']['date']['month'] != 'Please select' && $this->request->data['Price']['date']['day'] != 'Please select'){
				//Match Date
				$date = $this->request->data['Price']['date']['year'] . '-' . $this->request->data['Price']['date']['month'] . '-' . $this->request->data['Price']['date']['day'];
				$conditions[] =  array(
					'Price.date LIKE' => $date
				);
			}										
			$this->request->params['named']['page'] = 1;
		}
		$option = array(
        	'limit' => '20',
        	'conditions' => $conditions
        );		

		$this->Price->recursive = 2;
		$this->Paginator->settings = $option;
		$this->set('prices', $this->Paginator->paginate());	
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Price->exists($id)) {
			throw new NotFoundException(__('Invalid price'));
		}
		$options = array('conditions' => array('Price.' . $this->Price->primaryKey => $id));
		$this->set('price', $this->Price->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
	    if (isset($this->params['named']['ref'])) {
	    	$this->set('from', $this->params['named']['ref']);
	    }		

		$companies = $this->Price->Company->find('list');
		$products = $this->Price->Product->find('list');
		$units = $this->Price->Unit->find('list');
		$warehouses = $this->Price->Warehouse->find('list');
		$this->set(compact('companies', 'products', 'units', 'warehouses'));	    

		if ($this->request->is('post')) {

			if (empty($this->request->data['Company']['name'])) {
				unset($this->request->data['Company']);
			} else {
				$revolt = array_search($this->request->data['Company']['name'], $companies);
				if ($revolt) {
					$this->request->data['Price']['company_id'] = $revolt;
					unset($this->request->data['Company']);
				}
				unset($revolt);
			}
			$this->Price->create();
			if ($this->Price->saveAll($this->request->data)) {
				$this->Session->setFlash(__('The price has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The price could not be saved. Please, try again.'));
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
		if (!$this->Price->exists($id)) {
			throw new NotFoundException(__('Invalid price'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Price->save($this->request->data)) {
				$this->Session->setFlash(__('The price has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The price could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Price.' . $this->Price->primaryKey => $id));
			$this->request->data = $this->Price->find('first', $options);
		}
		$companies = $this->Price->Company->find('list');
		$products = $this->Price->Product->find('list');
		$units = $this->Price->Unit->find('list');
		$warehouses = $this->Price->Warehouse->find('list');
		$this->set(compact('companies', 'products', 'units', 'warehouses'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Price->id = $id;
		if (!$this->Price->exists()) {
			throw new NotFoundException(__('Invalid price'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Price->delete()) {
			$this->Session->setFlash(__('The price has been deleted.'));
		} else {
			$this->Session->setFlash(__('The price could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Price->recursive = 0;
		$this->set('prices', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Price->exists($id)) {
			throw new NotFoundException(__('Invalid price'));
		}
		$options = array('conditions' => array('Price.' . $this->Price->primaryKey => $id));
		$this->set('price', $this->Price->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Price->create();
			if ($this->Price->save($this->request->data)) {
				$this->Session->setFlash(__('The price has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The price could not be saved. Please, try again.'));
			}
		}
		$companies = $this->Price->Company->find('list');
		$products = $this->Price->Product->find('list');
		$units = $this->Price->Unit->find('list');
		$warehouses = $this->Price->Warehouse->find('list');
		$this->set(compact('companies', 'products', 'units', 'warehouses'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Price->exists($id)) {
			throw new NotFoundException(__('Invalid price'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Price->save($this->request->data)) {
				$this->Session->setFlash(__('The price has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The price could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Price.' . $this->Price->primaryKey => $id));
			$this->request->data = $this->Price->find('first', $options);
		}
		$companies = $this->Price->Company->find('list');
		$products = $this->Price->Product->find('list');
		$units = $this->Price->Unit->find('list');
		$warehouses = $this->Price->Warehouse->find('list');
		$this->set(compact('companies', 'products', 'units', 'warehouses'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Price->id = $id;
		if (!$this->Price->exists()) {
			throw new NotFoundException(__('Invalid price'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Price->delete()) {
			$this->Session->setFlash(__('The price has been deleted.'));
		} else {
			$this->Session->setFlash(__('The price could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
