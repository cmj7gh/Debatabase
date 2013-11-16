<?php
App::uses('AppModel', 'Model', 'User', 'Meeting', 'Meeting_User');
/**
 * Alumnus Model
 *
 * @property User $User
 */
class Alumnus extends AppModel {

public $virtualFields = array(
    //'attendance' => 'SELECT SUM(value) FROM meetings WHERE id IN (SELECT meeting_id FROM meetings_users WHERE user_id = Provy.user_id )'
);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

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
		)
	);
}
