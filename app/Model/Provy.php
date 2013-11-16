<?php
App::uses('AppModel', 'Model', 'User', 'Meeting', 'Meeting_User');
/**
 * Provy Model
 *
 * @property User $User
 * @property Debate $Debate
 * @property Lit $Lit
 */
class Provy extends AppModel {

public $virtualFields = array(
    'attendance' => 'SELECT SUM(value) FROM meetings WHERE id IN (SELECT meeting_id FROM meetings_users WHERE user_id = Provy.user_id )',
	'Proviepoints' => 'SELECT SUM(value) FROM provies_points where provy_id = Provy.id'
);

public $order = array('User.display_name'=>'ASC');

	//The Associations below have been created with all possible keys, those that are not needed can be removed

	
	
	public $hasMany = array(
		'Point' => array(
			'className' => 'ProviesPoints',
			'foreignKey' => 'provy_id',
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
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Big' => array(
			'className' => 'User',
			'foreignKey' => 'big_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Debate' => array(
			'className' => 'Debate',
			'foreignKey' => 'debate_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Lit' => array(
			'className' => 'Lit',
			'foreignKey' => 'lit_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
