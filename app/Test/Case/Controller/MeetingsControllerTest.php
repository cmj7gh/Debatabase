<?php
App::uses('MeetingsController', 'Controller');

/**
 * MeetingsController Test Case
 *
 */
class MeetingsControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.meeting',
		'app.debate',
		'app.pm',
		'app.mg',
		'app.lo',
		'app.mo',
		'app.lit',
		'app.user',
		'app.authentication',
		'app.log',
		'app.provy',
		'app.meetings_user'
	);

}
