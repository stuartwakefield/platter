<?php
/**
 * @author Stuart Wakefield <me@stuartwakefield.co.uk>
 * @copyright Copyright (c) 2014 Stuart Wakefield (http://stuartwakefield.co.uk)
 */
class PlatterDefinedTest extends PHPUnit_Framework_TestCase {
	
	public function testDefinedWithNone() {
		$platter = new Platter(array());
		$this->assertEmpty($platter->defined());
	}

	public function testDefined() {
		$platter = new Platter(array(
			'simple' => 'abc'
		));
		$this->assertContains('simple', $platter->defined());
	}

}
