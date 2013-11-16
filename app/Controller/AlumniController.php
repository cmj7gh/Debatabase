<?php
App::uses('AppController', 'Controller', 'User');
/**
 * Alumni Controller
 *
 * @property Alumnus $Alumnus
 */
class AlumniController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->paginate = array('limit' => 50);
		$this->Alumnus->recursive = 0;
		$this->set('alumni', $this->paginate(array('User.role' => 'alum')));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Alumnus->id = $id;
		if (!$this->Alumnus->exists()) {
			throw new NotFoundException(__('Invalid alumnus'));
		}
		$this->set('alumnus', $this->Alumnus->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		//if($this->currentUser['User']['office'] == null){
			$this->Session->setFlash(__('You do not have permissions to add alumni'));
			$this->redirect(array('action' => 'index'));
		//}else{
			if ($this->request->is('post')) {
				$this->Alumnus->create();
				if ($this->Alumnus->save($this->request->data)) {
					$this->Session->setFlash(__('The alumnus has been saved'), 'flash_good');
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The alumnus could not be saved. Please, try again.'));
				}
			}
			$users = $this->Alumnus->User->find('list');
			$this->set(compact('users'));
		//}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		//alumni can edit themselves
		if(($this->currentUser['User']['office'] != 'alumnichair') && ($this->currentUser['User']['office'] != 'president') && ($this->currentUser['User']['office'] != 'webmaster') && ($this->currentUser['Alum']['Alumnus']['id'] != $id)){
			$this->Session->setFlash(__('You do not have permissions to edit alumni'));
			$this->redirect(array('action' => 'index'));
		}else{
			$this->Alumnus->id = $id;
			if (!$this->Alumnus->exists()) {
				throw new NotFoundException(__('Invalid alumnus'));
			}
			if ($this->request->is('post') || $this->request->is('put')) {
				if ($this->Alumnus->save($this->request->data)) {
					$this->Session->setFlash(__('The alumnus has been saved'), 'flash_good');
					$this->redirect($this->data['_App']['referer']);
				} else {
					$this->Session->setFlash(__('The alumnus could not be saved. Please, try again.'));
				}
			} else {
				$this->request->data = $this->Alumnus->read(null, $id);
			}
			$users = $this->Alumnus->User->find('list');
			$this->set(compact('users'));
			$this->set('referer', Controller::referer()); 
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
		//if($this->currentUser['User']['office'] == null){
			$this->Session->setFlash(__('You do not have permissions to delete alumni'));
			$this->redirect(array('action' => 'index'));
		/*}else{
			if (!$this->request->is('post')) {
				throw new MethodNotAllowedException();
			}
			$this->Alumnus->id = $id;
			if (!$this->Alumnus->exists()) {
				throw new NotFoundException(__('Invalid alumnus'));
			}
			if ($this->Alumnus->delete()) {
				$this->Session->setFlash(__('Alumnus deleted'));
				$this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Alumnus was not deleted'));
			$this->redirect(array('action' => 'index'));
		}*/
	}	
}
