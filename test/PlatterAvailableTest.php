<?php
/**
 * @author Stuart Wakefield <me@stuartwakefield.co.uk>
 * @copyright Copyright (c) 2014 Stuart Wakefield (http://stuartwakefield.co.uk)
 */
class PlatterAvailableTest extends PHPUnit_Framework_TestCase {
	
	public function testAvailableWithNone() {
		$platter = new Platter(array());
		$this->assertEmpty($platter->available());
	}

	public function testAvailable() {
		$platter = new Platter(array(
			'simple' => 'abc'
		));
		$this->assertEquals(array('simple'), $platter->available());
	}

	public function testAvailableWithParent() {
		$parent = new Platter(array(
			'parent' => 'xyz'
		));
		$platter = new Platter(array(
			'simple' => 'abc'
		), $parent);

		$this->assertEquals(2, count($platter->available()));
		$this->assertContains('parent', $platter->available());
		$this->assertContains('simple', $platter->available());
	}

	public function testAvailableNoDupes() {
		$parent = new Platter(array(
			'parent' => 'xyz',
			'simple' => 123
		));
		$platter = new Platter(array(
			'simple' => 'abc'
		), $parent);

		$this->assertEquals(2, count($platter->available()));
		$this->assertContains('parent', $platter->available());
		$this->assertContains('simple', $platter->available());
	}

}
