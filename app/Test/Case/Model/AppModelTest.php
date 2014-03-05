<?php
App::uses('Tweet', 'Model');

/**
 * Tweet Test Case
 *
 */
class AppModelTest extends CakeTestCase {
/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Tweet = ClassRegistry::init('Tweet');
		$this->User = ClassRegistry::init('User');
	}
	public function testmb_maxLength() {
		$testData = array(
			'true' => array(
				'user_id' => 'kakenn',
				'text' => 'ああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああ',
				'created' => '2014-03-05 17:27:58'
			),
			'false' => array(
				'user_id' => 'kakenn',
				'text' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc,Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc,',
				'created' => '2014-03-05 17:27:58'
			)
		);
		foreach ($testData as $key => $value) {
			$this->Tweet->set($value);
			$result = $this->Tweet->validates();
			if($key=='true'){
				$this->assertTrue($result);
			}else{
				$this->assertFalse($result);
			}
		}
	}
	public function testmb_between() {
		$testData = array(
			'true' => array(
				array(
					'username' => 'kakenn',
					'password' => 'test',
					'viewname' => 'あああああああああああああああ',
					'mail' => 'info@kakenn.com',
					'public' => true
				),
				array(
					'username' => 'kakenn',
					'password' => 'test',
					'viewname' => 'ああああ',
					'mail' => 'info@kakenn.com',
					'public' => true
				),
				array(
					'username' => 'kakenn',
					'password' => 'test',
					'viewname' => 'ああああああああああああああああああああ',
					'mail' => 'info@kakenn.com',
					'public' => true
				),
			),
			'false' => array(
				array(
					'username' => 'kakenn',
					'password' => 'test',
					'viewname' => 'ああ',
					'mail' => 'info@kakenn.com',
					'public' => true
				),
				array(
					'username' => 'kakenn',
					'password' => 'test',
					'viewname' => 'あああああああああああああああああああああ',
					'mail' => 'info@kakenn.com',
					'public' => true
				),
			)
		);
		foreach ($testData as $key => $values) {
			foreach ($values as $value) {
				$this->User->set($value);
				$result = $this->User->validates();
			}
			if($key=='true'){
				$this->assertTrue($result);
			}else{
				$this->assertFalse($result);
			}
		}
	}
/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Tweet);
		unset($this->User);

		parent::tearDown();
	}

}
