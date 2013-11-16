<?php
App::uses('AppController', 'Controller', 'User', 'Provy');
/**
 * Lits Controller
 *
 * @property Lit $Lit
 */
class LitsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Lit->recursive = 0;
		$this->set('lits', $this->paginate());
		$users = $this->Lit->User->find('list');
		$this->set(compact('users'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Lit->id = $id;
		if (!$this->Lit->exists()) {
			throw new NotFoundException(__('Invalid lit'));
		}
		$this->set('lit', $this->Lit->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($meetingId = null) {
		if($this->currentUser['User']['office'] != 'president' &&
			$this->currentUser['User']['office'] != 'vicepresident' &&
			$this->currentUser['User']['office'] != 'secretary' &&
			$this->currentUser['User']['office'] != 'webmaster' &&
			$this->currentUser['User']['office'] != 'proviechair'){
			$this->Session->setFlash(__('You do not have permissions to add lits'));
			$this->redirect(array('action' => 'index'));
		}else{
			if ($this->request->is('post')) {
				$this->Lit->create();
				if ($this->Lit->save($this->request->data)) {
					$provie = $this->Provy->find('first', array('conditions' => array('Provy.user_id' => $this->request->data['Lit']['user_id'])));
					$this->Provy->id = $provie['Provy']['id'];
					if($this->Provy->exists()){
						$this->Provy->save(array('lit_id' => $this->Lit->id));
					}
					$this->Session->setFlash(__('The lit has been saved'), 'flash_good');
					if($meetingId != null){
						$this->redirect(array('controller' => 'meetings', 'action' => 'view', $meetingId));
					}else{
						$this->redirect(array('action' => 'index'));
					}
				} else {
					$this->Session->setFlash(__('The lit could not be saved. Please, try again.'));
				}
			}
			$meetings = $this->Lit->Meeting->find('list');
			$users = $this->Lit->User->find('list', array('conditions' => array('role !=' => null)));
			$this->set(compact('meetings', 'users', 'meetingId'));
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
		if($this->currentUser['User']['office'] != 'president' &&
			$this->currentUser['User']['office'] != 'vicepresident' &&
			$this->currentUser['User']['office'] != 'secretary' &&
			$this->currentUser['User']['office'] != 'webmaster' &&
			$this->currentUser['User']['office'] != 'proviechair'){
			$this->Session->setFlash(__('You do not have permissions to edit lits'));
			$this->redirect(array('action' => 'index'));
		}else{
			$this->Lit->id = $id;
			if (!$this->Lit->exists()) {
				throw new NotFoundException(__('Invalid lit'));
			}
			if ($this->request->is('post') || $this->request->is('put')) {
				if ($this->Lit->save($this->request->data)) {
					$this->Session->setFlash(__('The lit has been saved'), 'flash_good');
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The lit could not be saved. Please, try again.'));
				}
			} else {
				$this->request->data = $this->Lit->read(null, $id);
			}
			$meetings = $this->Lit->Meeting->find('list');
			$users = $this->Lit->User->find('list', array('conditions' => array('role !=' => null)));
			$this->set(compact('meetings', 'users'));
		}
	}

/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if($this->currentUser['User']['office'] != 'president' &&
			$this->currentUser['User']['office'] != 'vicepresident' &&
			$this->currentUser['User']['office'] != 'secretary' &&
			$this->currentUser['User']['office'] != 'webmaster'){
			$this->Session->setFlash(__('You do not have permissions to add debates'));
			$this->redirect(array('action' => 'index'));
		}else{
			if (!$this->request->is('post')) {
				throw new MethodNotAllowedException();
			}
			$this->Lit->id = $id;
			if (!$this->Lit->exists()) {
				throw new NotFoundException(__('Invalid lit'));
			}
			if ($this->Lit->delete()) {
				$this->Session->setFlash(__('Lit deleted'));
				$this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Lit was not deleted'));
			$this->redirect(array('action' => 'index'));
		}
	}
}
