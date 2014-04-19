<?php
/**
 * @author Stuart Wakefield <me@stuartwakefield.co.uk>
 * @copyright Copyright (c) 2014 Stuart Wakefield (http://stuartwakefield.co.uk)
 */
class PlatterTest extends PHPUnit_Framework_TestCase {

	public function testGetSimpleItem() {
		$platter = new Platter(array(
			'simple' => 'abc'
		));
		$this->assertEquals('abc', $platter->get('simple'));
	}

	public function testGetThrowsWhenUndefined() {
		$this->setExpectedException(
			'InvalidArgumentException',
			'Identifier \'nothing\' is not defined'
		);
		$platter = new Platter(array());
		$platter->get('nothing');
	}

}