<?php
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