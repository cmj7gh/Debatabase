<?php
App::uses('AppController', 'Controller', 'Debate', 'User');
/**
 * Meetings Controller
 *
 * @property Meeting $Meeting
 */
class MeetingsController extends AppController {

	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('index');
    }

	public function index() {
		$this->Meeting->recursive = 0;
		$this->set('meetings', $this->paginate(array('parent_id' => null)));
	}
	
	/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Meeting->id = $id;
		$this->Meeting->recursive = 2;
		if (!$this->Meeting->exists()) {
			throw new NotFoundException(__('Invalid Meeting'));
		}
		$this->set('meeting', $this->Meeting->read(null, $id));
		$combinedMeetings = $this->Meeting->find('all', array('conditions' => array('parent_id' => $id)));
		$pms = $this->User->find('list');
		$mgs = $this->User->find('list');
		$los = $this->User->find('list');
		$mos = $this->User->find('list');
		$this->set(compact('pms', 'mgs', 'los', 'mos', 'combinedMeetings'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if($this->currentUser['User']['office'] != 'president' &&
			$this->currentUser['User']['office'] != 'vicepresident' &&
			$this->currentUser['User']['office'] != 'secretary' &&
			$this->currentUser['User']['office'] != 'webmaster'){
			$this->Session->setFlash(__('You do not have permissions to add meetings'));
			$this->redirect(array('action' => 'index'));
		}else{
			if ($this->request->is('post')) {
				$this->Meeting->create();
				if ($this->Meeting->save($this->request->data)) {
					$this->Session->setFlash(__('The Meeting has been saved'), 'flash_good');
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The Meeting could not be saved. Please, try again.'));
				}
			}
			$meetings = $this->Meeting->find('list');
			$this->set(compact('meetings'));
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
			$this->currentUser['User']['office'] != 'webmaster'){
			$this->Session->setFlash(__('You do not have permissions to edit meetings'));
			$this->redirect(array('action' => 'index'));
		}else{
			$this->Meeting->id = $id;
			if (!$this->Meeting->exists()) {
				throw new NotFoundException(__('Invalid Meeting'));
			}
			if ($this->request->is('post') || $this->request->is('put')) {
				if ($this->Meeting->save($this->request->data)) {
					$this->Session->setFlash(__('The Meeting has been saved'), 'flash_good');
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The Meeting could not be saved. Please, try again.'));
				}
			} else {
				$this->request->data = $this->Meeting->read(null, $id);
			}
			$meetings = $this->Meeting->find('list');
			$this->set(compact('meetings'));
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
			$this->Session->setFlash(__('You do not have permissions to delete meetings'));
			$this->redirect(array('action' => 'index'));
		}else{
			if (!$this->request->is('post')) {
				throw new MethodNotAllowedException();
			}
			$this->Meeting->id = $id;
			if (!$this->Meeting->exists()) {
				throw new NotFoundException(__('Invalid Meeting'));
			}
			if ($this->Meeting->delete()) {
				$this->Session->setFlash(__('Meeting deleted'));
				$this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Meeting was not deleted'));
			$this->redirect(array('action' => 'index'));
		}
	}

}
