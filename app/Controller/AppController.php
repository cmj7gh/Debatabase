<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	public $helpers = array('Html', 'Session');
	public $uses = array('User', 'Provy', 'Alumnus');
	public $components = array(
    'Auth'=> array(
        'authenticate' => array(
            'Form' => array(
                'fields' => array('username' => 'email', 'password' => 'password')
            )
        ),
		'logoutRedirect' => array('controller' => 'pages', 'action' => 'welcome'),
		'unauthorizedRedirect' => array('controller' => 'pages', 'action' => 'welcome'),
		'loginAction' => array('controller' => 'pages', 'action' => 'welcome')
	), 'Session', 'SQLLog'
	);
	
	public function beforeFilter() {
	  $currentUser = array('User' => false, 'Provie' => false, 'Member' => false, 'Alum' => false, 'Officer' => false);
      $currentUser['User'] = $this->Session->read('Auth.User');
	  $currentUser['Provie'] = $this->Provy->find('first', array('conditions' => array('Provy.user_id' => $currentUser['User']['id'])));
	  $currentUser['Alum'] = $this->Alumnus->find('first', array('conditions' => array('Alumnus.user_id' => $currentUser['User']['id'])));
      $this->set('currentUser', $this->currentUser = $currentUser, 'provie', $this->provie = $currentUser['Provie']);
	  $this->SQLLog->LogEvent();
	}
}
