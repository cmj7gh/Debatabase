<?php
App::uses('AppController', 'Controller', 'User', 'Alumnus','Meeting');
/**
 * Provies Controller
 *
 * @property Provy $Provy
 */
class ProviesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->paginate = array('limit' => 50);
		$this->Provy->recursive = 0;
		$this->set('provies', $this->paginate(array('is_active' => true, 'User.role' => 'provie')));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Provy->id = $id;
		if (!$this->Provy->exists()) {
			throw new NotFoundException(__('Invalid provie'));
		}
		$rollCallsPresent = $this->Provy->query('Select meetings.id, meetings.parent_id, meetings.title, meetings.value
							 FROM meetings
							 JOIN meetings_users on meetings.id = meetings_users.meeting_id
							 JOIN users on meetings_users.user_id = users.id
							 JOIN provies on provies.user_id = users.id
							 where provies.id = '.$id);
		$proviePointsReceived = $this->Provy->query('Select giver_id, value, reason
							FROM provies_points
							WHERE provy_id = '.$id);
		//die(var_dump($attendedMeetings));
		$this->set('provy', $this->Provy->read(null, $id));
		$this->set('users', $this->Provy->User->find('list'));
		$this->set('allMeetings', $this->Provy->User->Meeting->find('list'));
		$this->set('rollCallsPresent', $rollCallsPresent);
		$this->set('proviePointsReceived', $proviePointsReceived);
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		//if($this->currentUser['User']['office'] == null){
			$this->Session->setFlash(__('You do not have permissions to add provies'));
			$this->redirect(array('action' => 'index'));
		//}else{
			if ($this->request->is('post')) {
				$this->Provy->create();
				if ($this->Provy->save($this->request->data)) {
					$this->Session->setFlash(__('The provy has been saved'), 'flash_good');
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The provy could not be saved. Please, try again.'));
				}
			}
			$users = $this->Provy->User->find('list');
			$debates = $this->Provy->Debate->find('list');
			$lits = $this->Provy->Lit->find('list');
			$this->set(compact('users', 'debates', 'lits'));
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
		if($this->currentUser['User']['office'] != 'president' &&
			$this->currentUser['User']['office'] != 'vicepresident' &&
			$this->currentUser['User']['office'] != 'secretary' &&
			$this->currentUser['User']['office'] != 'webmaster'&&
			$this->currentUser['User']['office'] != 'proviechair'){
			$this->Session->setFlash(__('You do not have permissions to edit provies'));
			$this->redirect(array('action' => 'index'));
		}else{
			$this->Provy->id = $id;
			if (!$this->Provy->exists()) {
				throw new NotFoundException(__('Invalid provy'));
			}
			if ($this->request->is('post') || $this->request->is('put')) {
				if ($this->Provy->save($this->request->data)) {
					$this->Session->setFlash(__('The provie has been saved'), 'flash_good');
					$this->redirect($this->data['_App']['referer']);
				} else {
					$this->Session->setFlash(__('The provie could not be saved. Please, try again.'));
				}
			} else {
				$this->request->data = $this->Provy->read(null, $id);
			}
			$users = $this->Provy->User->find('list');
			$debates = $this->Provy->Debate->find('list');
			$lits = $this->Provy->Lit->find('list');
			$this->set(compact('users', 'debates', 'lits'));
			$this->set('referer', Controller::referer()); 
			$this->set('bigs',$users);
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
			$this->currentUser['User']['office'] != 'webmaster'){
			$this->Session->setFlash(__('Only the President, VP, and Webmaster can delete provies'));
			$this->redirect(array('action' => 'index'));
		}else{
			if (!$this->request->is('post')) {
				throw new MethodNotAllowedException();
			}
			$this->Provy->id = $id;
			if (!$this->Provy->exists()) {
				throw new NotFoundException(__('Invalid provy'));
			}
			$ProvieData = $this->Provy->read(null,$id);
			$this->User->save(
								array(
									'id' => $ProvieData['Provy']['user_id'],
									'user_id' => $id,
									'role' => null
								)
					);
			
			if ($this->Provy->delete()) {
				$this->Session->setFlash(__('Provie deleted'));
				$this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Provie was not deleted'));
			$this->redirect(array('action' => 'index'));
		}
	}
	
	public function signTheRoll($id = null) {
		if($this->currentUser['User']['office'] != 'president' &&
			$this->currentUser['User']['office'] != 'vicepresident' &&
			$this->currentUser['User']['office'] != 'webmaster' &&
			$this->currentUser['User']['office'] != 'secretary'){
			$this->Session->setFlash(__('You do not have permissions to add provies'));
			$this->redirect(array('action' => 'index'));
		}else{
			if ($this->request->is('post')){ 
				//die(var_dump($this->data));
				for($i=0; $i<50; $i++){
					if($this->data['provies_'.$i.'_first_name'] != null){
						$this->User->create();
						$this->User->save(
									array(
										'first_name' => $this->data['provies_'.$i.'_first_name'],
										'last_name' => $this->data['provies_'.$i.'_last_name'],
										'email' => $this->data['provies_'.$i.'_Email'].'@virginia.edu',
										'role' => 'provie'
									)
						);
						$userID = $this->User->getInsertID();
						$this->Provy->create();
						$this->Provy->save(
									array(
										'user_id' => $userID,
										'is_active' => true,
										'inductions_elligible' => false,
										'points' => 0
									)
						);
						$this->User->Alumnus->create();
						$this->User->Alumnus->save(
									array(
										'user_id' => $userID
									)
						);
					}else{break;}
				}
			$this->Session->setFlash(__($i. ' Provies Registered Successfully'));
			$this->redirect(array('action' => 'index'));
			}
		}
	}
	public function givePoints($id = null) {
		if($this->currentUser['User']['office'] == null){
			$this->Session->setFlash(__('You do not have permissions to give provie points'));
			$this->redirect(Controller::referer);
		}else{
			if ($this->request->is('post')) {
				$userID = $this->request->data['Provy']['user_id'];
				//die(var_dump($this->request->data));
				$ThisProvy = $this->Provy->find('first', array('conditions'=>array('Provy.user_id' => $userID)));
				//$ThisProvy['Provy']['points'] = $ThisProvy['Provy']['points'] + $this->request->data['Provy']['points'];
				//die(var_dump($ThisProvy));
				//$this->Provy->id = $ThisProvy['Provy']['id'];
				//$this->Provy->save($ThisProvy['Provy']);
				$result = $this->Provy->query('INSERT INTO provies_points
												(provy_id, giver_id, value, reason, created, modified)
												VALUES
												('.$ThisProvy['Provy']['id'].','.$this->currentUser['User']['id'].','.$this->request->data['Provy']['value'].',\''.$this->request->data['Provy']['reason'].'\',now(),now())');
				$newTotalPoints = $this->Provy->query('SELECT SUM(value)
														FROM provies_points
														WHERE provy_id = ' . $ThisProvy['Provy']['id']);
				//die(var_dump($newTotalPoints));
				$this->Session->setFlash(__('Provie ' . $ThisProvy['User']['display_name'] . ' now has '. $newTotalPoints[0][0]['SUM(value)'] . ' points'),'flash_good');
				//die(var_dump($ThisProvy));
				$this->redirect(array('action'=>'view',$ThisProvy['Provy']['id']));
			}else{
				$users = $this->Provy->User->find('list', array('conditions'=>array('role'=>'provie')));
				$this->set(compact('users'));
			}
		}
	}
	
}
