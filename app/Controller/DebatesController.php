<?php
App::uses('AppController', 'Controller', 'Meeting', 'User', 'Provy');
/**
 * Debates Controller
 *
 * @property Debate $Debate
 */
class DebatesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Debate->recursive = 0;
		$this->set('debates', $this->paginate());
		$debaters = $this->Debate->Debater->find('list');
		$members = $this->Debate->Debater->User->find('list');
		$this->set(compact('members','debaters'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Debate->id = $id;
		$this->Debate->recursive = 2;
		if (!$this->Debate->exists()) {
			throw new NotFoundException(__('Invalid debate'));
		}
		$debaters = $this->Debate->Debater->find('list');
		$users = $this->Debate->Debater->User->find('list');
		$this->set('debate', $this->Debate->read(null, $id));
		$this->set(compact('debaters','users'));
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
			$this->Session->setFlash(__('You do not have permissions to add debates'));
			$this->redirect(array('action' => 'index'));
		}else{
			if ($this->request->is('post')) {
				//die(var_dump($this->request->data));
				$this->Debate->create();
				if ($this->Debate->save($this->request->data)) {
					$debateId = $this->Debate->getInsertId();
					foreach($this->request->data['debaters'] as $debater){
						$this->Debate->Debater->create();
						$this->Debate->Debater->save(array(
							'debate_id'=>$debateId,
							'user_id'=>$debater['user_id'],
							'role'=>$debater['role']
						)							
						);
						$provie = $this->Provy->find('first', array('conditions' => array('Provy.user_id' => $debater['user_id'])));
						//die(var_dump($provie));
						if($provie){
							$this->Provy->id = $provie['Provy']['id'];
							if($this->Provy->exists()){
								$this->Provy->save(array('debate_id' => $debateId));
							}
						}
					}

					
					$this->Session->setFlash(__('The debate has been saved'), 'flash_good');
					if($meetingId != null){
						$this->redirect(array('controller' => 'meetings', 'action' => 'view', $meetingId));
					}else{
						$this->redirect(array('action' => 'index'));
					}
				} else {
					$this->Session->setFlash(__('The debate could not be saved. Please, try again.'));
				}
			}
			$meetings = $this->Debate->Meeting->find('list');
			$users = $this->Debate->Debater->User->find('list', array('conditions' => array('role !=' => null)));
			$Allusers = $this->Debate->Debater->User->find('list',array(
				'fields' => array('User.id', 'User.display_name'),'conditions' => array('role !=' => null)));
			$this->set(compact('meetings', 'meetingId','users','Allusers'));
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
			$this->Session->setFlash(__('You do not have permissions to edit debates'));
			$this->redirect(array('action' => 'index'));
		}else{
			$this->Debate->id = $id;
			if (!$this->Debate->exists()) {
				throw new NotFoundException(__('Invalid debate'));
			}
			if ($this->request->is('post') || $this->request->is('put')) {
				if ($this->Debate->save($this->request->data)) {
					$this->Session->setFlash(__('The debate has been saved'), 'flash_good');
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The debate could not be saved. Please, try again.'));
				}
			} else {
				$this->request->data = $this->Debate->read(null, $id);
			}
			$meetings = $this->Debate->Meeting->find('list');
			$debaters = $this->Debate->Debater->find('all',array('conditions'=>array('debate_id' => $id)));
			$users = $this->Debate->Debater->User->find('list');
			$this->set(compact('meetings', 'debaters','users','id'));
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
			$this->Session->setFlash(__('You do not have permissions to delete debates'));
			$this->redirect(array('action' => 'index'));
		}else{
			if (!$this->request->is('post')) {
				throw new MethodNotAllowedException();
			}
			$this->Debate->id = $id;
			if (!$this->Debate->exists()) {
				throw new NotFoundException(__('Invalid debate'));
			}
			if ($this->Debate->delete()) {
				$this->Session->setFlash(__('Debate deleted'));
				$this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Debate was not deleted'));
			$this->redirect(array('action' => 'index'));
		}
	}
	
	public function removeDebater($id = null) {
		if($this->currentUser['User']['office'] != 'president' &&
			$this->currentUser['User']['office'] != 'vicepresident' &&
			$this->currentUser['User']['office'] != 'secretary' &&
			$this->currentUser['User']['office'] != 'webmaster' &&
			$this->currentUser['User']['office'] != 'proviechair'){
			$this->Session->setFlash(__('You do not have permissions to remove Debaters from a Debate'));
			$this->redirect(array('action' => 'index'));
		}else{
			//if (!$this->request->is('post')) {
			//	throw new MethodNotAllowedException();
			//}
			$this->Debate->Debater->id = $id;
			if (!$this->Debate->Debater->exists()) {
				throw new NotFoundException(__('Invalid debater'));
			}
			if ($this->Debate->Debater->delete()) {
				$this->Session->setFlash(__('Debater deleted'));
				$this->redirect(Controller::referer());
			}
			$this->Session->setFlash(__('Debate was not deleted'));
			$this->redirect(Controller::referer());
		}
	}
	
	public function addDebater($id = null) {
		//die("got this far");
		if($this->currentUser['User']['office'] != 'president' &&
			$this->currentUser['User']['office'] != 'vicepresident' &&
			$this->currentUser['User']['office'] != 'secretary' &&
			$this->currentUser['User']['office'] != 'webmaster' &&
			$this->currentUser['User']['office'] != 'proviechair'){
			$this->Session->setFlash(__('You do not have permissions to add Debaters to a Debate'));
			$this->redirect(array('action' => 'index'));
		}else{
			if (!$this->request->is('post')) {
				throw new MethodNotAllowedException();
			}
			if($this->request->data['Debate']['role'] == null || $this->request->data['Debate']['user_id'] == null){
				$this->Session->setFlash(__('You must select a member and a role'));
				$this->redirect(array('action' => 'edit',$id));
			}else{
				$this->Debate->Debater->create();
				if($this->Debate->Debater->save(
					array(
						'role'=>$this->request->data['Debate']['role'],
						'user_id'=>$this->request->data['Debate']['user_id'],
						'debate_id'=>$id
					)
				)){
					$this->Session->setFlash(__('Debater added'), 'flash_good');
					$this->redirect(array('action' => 'edit',$id));
				}
			}
		}
	}
}
