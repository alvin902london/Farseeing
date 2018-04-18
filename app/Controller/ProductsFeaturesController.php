<?php
App::uses('AppController', 'Controller');
/**
 * ProductsFeatures Controller
 *
 * @property ProductsFeature $ProductsFeature
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ProductsFeaturesController extends AppController {

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
		$this->ProductsFeature->recursive = 0;
		$this->set('productsFeatures', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ProductsFeature->exists($id)) {
			throw new NotFoundException(__('Invalid products feature'));
		}
		$options = array('conditions' => array('ProductsFeature.' . $this->ProductsFeature->primaryKey => $id));
		$this->set('productsFeature', $this->ProductsFeature->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ProductsFeature->create();
			if ($this->ProductsFeature->save($this->request->data)) {
				$this->Session->setFlash(__('The products feature has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The products feature could not be saved. Please, try again.'));
			}
		}
		$products = $this->ProductsFeature->Product->find('list');
		$features = $this->ProductsFeature->Feature->find('list');
		$this->set(compact('products', 'features'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->ProductsFeature->exists($id)) {
			throw new NotFoundException(__('Invalid products feature'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ProductsFeature->save($this->request->data)) {
				$this->Session->setFlash(__('The products feature has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The products feature could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ProductsFeature.' . $this->ProductsFeature->primaryKey => $id));
			$this->request->data = $this->ProductsFeature->find('first', $options);
		}
		$products = $this->ProductsFeature->Product->find('list');
		$features = $this->ProductsFeature->Feature->find('list');
		$this->set(compact('products', 'features'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->ProductsFeature->id = $id;
		if (!$this->ProductsFeature->exists()) {
			throw new NotFoundException(__('Invalid products feature'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->ProductsFeature->delete()) {
			$this->Session->setFlash(__('The products feature has been deleted.'));
		} else {
			$this->Session->setFlash(__('The products feature could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->ProductsFeature->recursive = 0;
		$this->set('productsFeatures', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->ProductsFeature->exists($id)) {
			throw new NotFoundException(__('Invalid products feature'));
		}
		$options = array('conditions' => array('ProductsFeature.' . $this->ProductsFeature->primaryKey => $id));
		$this->set('productsFeature', $this->ProductsFeature->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->ProductsFeature->create();
			if ($this->ProductsFeature->save($this->request->data)) {
				$this->Session->setFlash(__('The products feature has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The products feature could not be saved. Please, try again.'));
			}
		}
		$products = $this->ProductsFeature->Product->find('list');
		$features = $this->ProductsFeature->Feature->find('list');
		$this->set(compact('products', 'features'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->ProductsFeature->exists($id)) {
			throw new NotFoundException(__('Invalid products feature'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ProductsFeature->save($this->request->data)) {
				$this->Session->setFlash(__('The products feature has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The products feature could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ProductsFeature.' . $this->ProductsFeature->primaryKey => $id));
			$this->request->data = $this->ProductsFeature->find('first', $options);
		}
		$products = $this->ProductsFeature->Product->find('list');
		$features = $this->ProductsFeature->Feature->find('list');
		$this->set(compact('products', 'features'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->ProductsFeature->id = $id;
		if (!$this->ProductsFeature->exists()) {
			throw new NotFoundException(__('Invalid products feature'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->ProductsFeature->delete()) {
			$this->Session->setFlash(__('The products feature has been deleted.'));
		} else {
			$this->Session->setFlash(__('The products feature could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
