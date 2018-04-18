<?php
App::uses('AppController', 'Controller');
/**
 * PricesWarehouses Controller
 *
 * @property PricesWarehouse $PricesWarehouse
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class PricesWarehousesController extends AppController {

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
		$this->PricesWarehouse->recursive = 0;
		$this->set('pricesWarehouses', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->PricesWarehouse->exists($id)) {
			throw new NotFoundException(__('Invalid prices warehouse'));
		}
		$options = array('conditions' => array('PricesWarehouse.' . $this->PricesWarehouse->primaryKey => $id));
		$this->set('pricesWarehouse', $this->PricesWarehouse->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->PricesWarehouse->create();
			if ($this->PricesWarehouse->save($this->request->data)) {
				$this->Session->setFlash(__('The prices warehouse has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The prices warehouse could not be saved. Please, try again.'));
			}
		}
		$prices = $this->PricesWarehouse->Price->find('list');
		$warehouses = $this->PricesWarehouse->Warehouse->find('list');
		$this->set(compact('prices', 'warehouses'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->PricesWarehouse->exists($id)) {
			throw new NotFoundException(__('Invalid prices warehouse'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->PricesWarehouse->save($this->request->data)) {
				$this->Session->setFlash(__('The prices warehouse has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The prices warehouse could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('PricesWarehouse.' . $this->PricesWarehouse->primaryKey => $id));
			$this->request->data = $this->PricesWarehouse->find('first', $options);
		}
		$prices = $this->PricesWarehouse->Price->find('list');
		$warehouses = $this->PricesWarehouse->Warehouse->find('list');
		$this->set(compact('prices', 'warehouses'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->PricesWarehouse->id = $id;
		if (!$this->PricesWarehouse->exists()) {
			throw new NotFoundException(__('Invalid prices warehouse'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->PricesWarehouse->delete()) {
			$this->Session->setFlash(__('The prices warehouse has been deleted.'));
		} else {
			$this->Session->setFlash(__('The prices warehouse could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->PricesWarehouse->recursive = 0;
		$this->set('pricesWarehouses', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->PricesWarehouse->exists($id)) {
			throw new NotFoundException(__('Invalid prices warehouse'));
		}
		$options = array('conditions' => array('PricesWarehouse.' . $this->PricesWarehouse->primaryKey => $id));
		$this->set('pricesWarehouse', $this->PricesWarehouse->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->PricesWarehouse->create();
			if ($this->PricesWarehouse->save($this->request->data)) {
				$this->Session->setFlash(__('The prices warehouse has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The prices warehouse could not be saved. Please, try again.'));
			}
		}
		$prices = $this->PricesWarehouse->Price->find('list');
		$warehouses = $this->PricesWarehouse->Warehouse->find('list');
		$this->set(compact('prices', 'warehouses'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->PricesWarehouse->exists($id)) {
			throw new NotFoundException(__('Invalid prices warehouse'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->PricesWarehouse->save($this->request->data)) {
				$this->Session->setFlash(__('The prices warehouse has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The prices warehouse could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('PricesWarehouse.' . $this->PricesWarehouse->primaryKey => $id));
			$this->request->data = $this->PricesWarehouse->find('first', $options);
		}
		$prices = $this->PricesWarehouse->Price->find('list');
		$warehouses = $this->PricesWarehouse->Warehouse->find('list');
		$this->set(compact('prices', 'warehouses'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->PricesWarehouse->id = $id;
		if (!$this->PricesWarehouse->exists()) {
			throw new NotFoundException(__('Invalid prices warehouse'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->PricesWarehouse->delete()) {
			$this->Session->setFlash(__('The prices warehouse has been deleted.'));
		} else {
			$this->Session->setFlash(__('The prices warehouse could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
