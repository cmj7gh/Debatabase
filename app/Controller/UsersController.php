<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {

	public $uses = array('Provy', 'User', 'Meeting');

	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('register', 'netbadge', 'login', 'index');
		//$this->Auth->fields = array(
        //    'username' => 'email',
        //    'password' => 'password'
        //);
    }

	public function login() {
		if($this->request->is('post')) {        //Only run on POST; GET requests simply load the view.
            if ($this->Auth->login()) {
                if($this->Auth->user()) {
                    echo("login successful");
					$this->after_login();
                } else {
                    //$this->redirect($this->Auth->redirect());
					$this->redirect(array('controller'=>'pages', 'action'=>'welcome'));
                }
            } else {
				//debug("something went wrong!");
				$this->Session->setFlash(__('Invalid username or password, try again'));
            }
        }
	}
	
	public function after_login() {
		//echo("got here!");
        //$id = $this->Auth->user('id');

        //Controller::loadModel('Coach');

        // set Find the associated Coach
        //$linkedCoach = $this->Coach->find('first', array('conditions' => array('Coach.user_id' => $id)));
		$user = $this->Session->read('Auth.User');
		if($user['role'] == 'provie'){
			$provie = $this->Provy->find('first', array('conditions' => array('Provy.user_id' => $user['id'])));
			$this->redirect(array('controller'=>'provies', 'action'=>'view', $provie['Provy']['id']));
		}else if($user['office'] != null){
			$this->redirect(array('controller'=>'pages', 'action'=>'officer_home'));
		}else if($user['role'] == 'member'){
			$this->redirect(array('controller'=>'pages', 'action'=>'member_home'));
		}else if($user['role'] == 'alum'){
			$this->redirect(array('controller'=>'pages', 'action'=>'alum_home'));
		}else{
			$this->Session->setFlash(__('You have successfully logged in, but your profile is not yet complete. Please complete this biographical information then email cmj7gh@virginia.edu to complete your registration.'), 'flash_good');
			$this->redirect(array('controller'=>'users', 'action'=>'edit', $user['id']));
		}
    }
	
	public function logout() {
		$this->Session->setFlash(__('You have successfully logged out.'), 'flash_good');
		$this->redirect($this->Auth->logout());
		//$this->redirect(array('controller'=>'pages', 'action'=>'welcome'));
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->paginate = array('User'=>array('limit' => 50,'order'=>array('display_name'=>'asc'),'conditions'=>array('role' => 'member')));
		//, 'conditions'=>array('role' => 'member')
		// 'order'=>array('display_name'=>'desc'),
		$this->User->recursive = 0;
		$this->set('users', $this->paginate('User'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->set('user', $this->User->read(null, $id));
		$this->set('debates', $this->User->Debater->find('all',array('conditions'=>array('user_id'=>$id))));
		$meetings = $this->User->Meeting->find('list');
		$this->set(compact('meetings'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if($this->currentUser['User']['office'] != 'president' &&
			$this->currentUser['User']['office'] != 'vicepresident' &&
			$this->currentUser['User']['office'] != 'webmaster'){
			$this->Session->setFlash(__('You do not have permissions to add users'));
			$this->redirect(array('action' => 'index'));
		}else{
			if ($this->request->is('post')) {
				$this->User->create();
				$UserData = $this->request->data;
				$UserData['User']['email'] = $this->request->data['User']['email'] . '@virginia.edu';
				if ($this->User->save($UserData)) {
					$userID = $this->User->getInsertID();
						$this->Provy->create();
						$this->Provy->save(
									array(
										'user_id' => $userID,
										'is_active' => false,
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
					$this->Session->setFlash(__('The user has been saved'), 'flash_good');
					$this->redirect($this->data['_App']['referer']);
				} else {
					$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
				}
			}
			$meetings = $this->User->Meeting->find('list');
			$this->set(compact('meetings'));
			$this->set('referer', Controller::referer()); 
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
			$this->currentUser['User']['office'] != 'webmaster' && 
			($id != $this->currentUser['User']['id'])){
			$this->Session->setFlash(__('You do not have permissions to edit users.'));
			$this->redirect(array('action' => 'index'));
		}else{
			$this->User->id = $id;
			if (!$this->User->exists()) {
				throw new NotFoundException(__('Invalid user'));
			}
			if ($this->request->is('post') || $this->request->is('put')) {
				if ($this->User->save($this->request->data)) {
					$this->Session->setFlash(__('The user has been saved'), 'flash_good');
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
				}
			} else {
				$this->request->data = $this->User->read(null, $id);
			}
			$meetings = $this->User->Meeting->find('list');
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
			$this->currentUser['User']['office'] != 'webmaster'){
			$this->Session->setFlash(__('You do not have permissions to delete users'));
			$this->redirect(array('action' => 'index'));
		}else{
			if (!$this->request->is('post')) {
				throw new MethodNotAllowedException();
			}
			$this->User->id = $id;
			if (!$this->User->exists()) {
				throw new NotFoundException(__('Invalid user'));
			}
			if ($this->User->delete()) {
				$this->Session->setFlash(__('User deleted'));
				$this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('User was not deleted'));
			$this->redirect(array('action' => 'index'));
		}
	}
	

	public function netbadge() {
	  if ( !isset($_COOKIE['REMOTE_AUTH']) ) {
	    $this->Session->setFlash(__('This only works with netbadge (aka pubcookie).'));
	    $this->redirect($this->Auth->redirect()); // somewhere else $B!D (B
	  }
	  $uniqid = $_COOKIE['REMOTE_AUTH'];
	  setcookie("REMOTE_AUTH","",0,"/~energy");
	  
	  $search = $this->User->Authentication->find('first', array('conditions'=>array('value'=>$uniqid,'valid'=>1)));
	  $this->set('who',$search['User']['email']);
	  // log in user
	  if ($this->Auth->login($search['User']))
	    $this->Session->setFlash(__('Successful netbadge login'), 'flash_good');
	  else
	    $this->Session->setFlash(__('Something went wrong with netbage...'));
		
		if($search['User']['role'] == 'provie'){
			$provie = $this->Provy->find('first', array('conditions' => array('Provy.user_id' => $search['User']['id'])));
			$this->redirect(array('controller'=>'provies', 'action'=>'view', $provie['Provy']['id']));
		}else if($search['User']['office'] != null){
			$this->redirect(array('controller'=>'pages', 'action'=>'officer_home'));
		}else if($search['User']['role'] == 'member'){
			$this->redirect(array('controller'=>'pages', 'action'=>'member_home'));
		}else if($search['User']['role'] == 'alum'){
			$this->redirect(array('controller'=>'pages', 'action'=>'alum_home'));
		}
	}
	
	public function takeAttendance($roll_id = null) {
		if($this->currentUser['User']['office'] != 'president' &&
			$this->currentUser['User']['office'] != 'vicepresident' &&
			$this->currentUser['User']['office'] != 'webmaster' &&
			$this->currentUser['User']['office'] != 'secretary'){
				$this->Session->setFlash(__('You do not have permission to do that'));
				$this->redirect(Controller::referer());
		}else{
			if ($this->request->is('post') || $this->request->is('put')) {
				//die(var_dump($this->request->data));
				if(isset($roll_id)){
					//then we're updating a previous rollcall...
					$this->Meeting->save(
						array(
							'id' => $roll_id,
							'value' => $this->request->data['SubMeetingValue'],
							'title' => $this->request->data['SubMeetingTitle']
						)
					);
					$meetingID = $roll_id;
					$pId = $this->Meeting->query("Select parent_id
														FROM meetings
														where id=" . $roll_id);
					$parentID = $pId['0']['meetings']['parent_id'];
					$this->Meeting->query("Delete 
										FROM  meetings_users 
										WHERE meeting_id = ".$roll_id);
				}else if($this->request->data['meeting_id'] == null){
					//then we're creating a new meeting
					$this->Meeting->save(
						array(
							'datetime' => $this->request->data['date'],
							'value' => $this->request->data['value'],
							'title' => $this->request->data['title']
						)
					);
					$meetingID = $this->Meeting->getInsertID();
					$parentID = null;
				}else{
					//this means that we're adding attendance to an existing meeting. Kludgy fix, create a new meeting with the existing meeting as its parent
					$this->Meeting->save(
						array(
							'parent_id' => $this->request->data['meeting_id'],
							'value' => $this->request->data['SubMeetingValue'],
							'title' => $this->request->data['SubMeetingTitle']
						)
					);
					$meetingID = $this->Meeting->getInsertID();
					$parentID = $this->request->data['meeting_id'];
				}
				if(isset($this->request->data['User'])){
					foreach($this->request->data['User'] as $u_id){
						$results = $this->Meeting->query('INSERT INTO meetings_users(meeting_id, user_id) VALUES(' . $meetingID . ', '.$u_id.')');
					}
				}
				
				//Calculate whether you have a quorum
				if($this->request->data['meeting_id'] == null){
					$membersPresent = $this->Meeting->query('SELECT COUNT(*) 
															FROM  `meetings` 
																JOIN meetings_users 
																	ON meetings_users.meeting_id = meetings.id
																JOIN users ON meetings_users.user_id = users.id
															WHERE users.role =  \'member\'
															AND meetings.id ='.$meetingID);
					$possibleMembers = $this->Meeting->query('SELECT COUNT(*) 
																FROM  users 
																WHERE role =  \'member\'
																AND dues_expire > NOW()');
					if($membersPresent[0][0]['COUNT(*)']*4 >= $possibleMembers[0][0]['COUNT(*)']){
						$this->Session->setFlash(__(' You have a Quorum! Meetings Created and Attendance Saved Successfully.'), 'flash_good');
					}else{
						$this->Session->setFlash(__(' You do not have a Quorum =( Meetings Created and Attendance Saved Successfully.'), 'flash_good');
					}
					if($parentID == null){
						$this->redirect(array('controller'=>'meetings', 'action'=>'view', $meetingID));
					}else{
						$this->redirect(array('controller'=>'meetings', 'action'=>'view', $parentID));
					}
				}else{
					$this->Session->setFlash(__('Attendance Successfully Added To Your Existing Meeting'), 'flash_good');
					$this->redirect(array('controller'=>'meetings', 'action'=>'view', $this->request->data['meeting_id']));
				}
			} else {
				//find all active members and provies
				$members = $this->User->find('all',array('conditions' => array('role' => 'member','dues_expire >'=>date('Y-m-d'))));
				$provies = $this->User->find('all',array('conditions' => array('role' => 'provie', 'email !=' => 'provie@wash.com')));
				//$this->Meeting->recursive = 0;
				//$meetings = $this->Meeting->find('all');
				//die(var_dump($members));
				$meetings = $this->User->Meeting->find('list', array('conditions' => array('parent_id' => null)));
				$this->set('members',$members);
				$this->set('provies',$provies);
				$this->set('meetings',$meetings);
				
			}
		}
	}
	
	public function editRoll($roll_id = null) {
		if($this->currentUser['User']['office'] != 'president' &&
			$this->currentUser['User']['office'] != 'vicepresident' &&
			$this->currentUser['User']['office'] != 'webmaster' &&
			$this->currentUser['User']['office'] != 'secretary'){
			$this->Session->setFlash(__('You do not have permissions to edit a rollcall'));
			$this->redirect(Controller::referer);
		}else{
			if ($this->request->is('post')) {
				//save the roll attendees
			}else{
				//figure out who is already attending this meeting
				$AttendingUsers = $this->User->query('SELECT user_id 
														FROM  meetings_users
														WHERE meeting_id = ' .$roll_id);
				//die(var_dump($AttendingUsers));
				//find all active members and provies
				$members = $this->User->find('all',array('conditions' => array('role' => 'member','dues_expire >'=>date('Y-m-d'))));
				$provies = $this->User->find('all',array('conditions' => array('role' => 'provie', 'email !=' => 'provie@wash.com')));
				$thisMeeting = $this->Meeting->find('first',array('conditions' => array('id' => $roll_id)));
				//$this->Meeting->recursive = 0;
				//$meetings = $this->Meeting->find('all');
				//die(var_dump($members));
				$meetings = $this->User->Meeting->find('list', array('conditions' => array('parent_id' => null)));
				$this->set('members',$members);
				$this->set('provies',$provies);
				$this->set('meetings',$meetings);
				$this->set('AttendingUsers',$AttendingUsers);
				$this->set('roll_id', $roll_id);
				$this->set('thisMeeting', $thisMeeting['Meeting']);
			}
		}
	}
	
	public function payDues($id = null) {
		if($this->currentUser['User']['office'] != 'president' &&
			$this->currentUser['User']['office'] != 'vicepresident' &&
			$this->currentUser['User']['office'] != 'webmaster' &&
			$this->currentUser['User']['office'] != 'treasurer'){
			$this->Session->setFlash(__('You do not have permissions to accept dues from users'));
			$this->redirect(Controller::referer);
		}else{
			if ($this->request->is('post')) {
				//die(var_dump($this->request->data));
				$nextMarch1 = date('Y-m-d', strtotime("15 march + 1 year"));
				$thisOctober1 = date('Y-m-d', strtotime("15 october"));
				$nextOctober1 = date('Y-m-d', strtotime("15 october + 1 year"));
				$June = strtotime("1 june");
				if($this->request->data['User']['paymentTerm'] == 'semester'){
					if(time() > $June){
						//if I pay for a semester between June 1 and December 31, I am paying for the Fall Semester.
						// My dues should expire a little bit in the spring semester - March 15 of next year
						$duesExpire = $nextMarch1;
					}else{
						//if I pay for a semester between Jan 1 and June 1, I am paying for the Spring Semester.
						// My dues should expire a little bit in the fall semester - October 15 of this year
						$duesExpire = $thisOctober1;
					}
				}else{
					if(time() > $June){
						//if I pay for a year between June 1 and December 31, I am paying for the Spring and Fall Semester.
						// My dues should expire a little bit in the fall semester - October 1 of next year
						$duesExpire = $nextOctober1;
					}else{
						//if I pay for a year between Jan 1 and June 1, I am paying for the Spring and Fall Semester.
						// My dues should expire a little bit in the fall semester - March 1 of next year
						$duesExpire = $nextMarch1;
					}
				}
				$this->User->id=$this->request->data['User']['user_id'];
				$this->User->save(
						array(
							'dues_expire' => $duesExpire
						)
				);
				$this->Session->setFlash(__('Your dues have been paid and will expire on '.$duesExpire),'flash_good');
				$this->redirect(array('action'=>'view',$this->request->data['User']['user_id']));
			}else{
				$users = $this->User->find('list');
				$this->set(compact('users'));
			}
		}
	}



}
