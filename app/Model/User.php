<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 * @property Authentication $Authentication
 * @property Lit $Lit
 * @property Log $Log
 * @property Provy $Provy
 * @property Alumnus $Alumnus
 * @property Meeting $Meeting
 */
class User extends AppModel {



public $virtualFields = array(
     'display_name' => 'CONCAT(User.first_name, " ", User.last_name, " (", User.email, ")")',
	 'dues_status' =>  'User.dues_expire > now()'
);

public $displayField = 'display_name';

public $order = array('User.display_name'=>'ASC');
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Authentication' => array(
			'className' => 'Authentication',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Lit' => array(
			'className' => 'Lit',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Debater' => array(
			'className' => 'Debater',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Log' => array(
			'className' => 'Log',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Provy' => array(
			'className' => 'Provy',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Alumnus' => array(
			'className' => 'Alumnus',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);


/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Meeting' => array(
			'className' => 'Meeting',
			'joinTable' => 'meetings_users',
			'foreignKey' => 'user_id',
			'associationForeignKey' => 'meeting_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);

}
