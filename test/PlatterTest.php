<?php
class PlatterTest extends PHPUnit_Framework_TestCase {

	public function testGetSimpleItem() {
		$platter = new Platter(array(
			'simple' => 'abc'
		));
		$this->assertEquals('abc', $platter->get('simple'));
	}

}