<?php
/**
 * @author Stuart Wakefield <me@stuartwakefield.co.uk>
 * @copyright Copyright (c) 2014 Stuart Wakefield (http://stuartwakefield.co.uk)
 */
class BuilderTest extends PHPUnit_Framework_TestCase {
	
	public function testBuildEmpty() {
		$builder = new Platter\Builder;
		$platter = $builder->build();
		$this->assertEmpty($platter->defined());
	}

	public function testBuild() {
		$builder = new Platter\Builder;
		$platter = $builder
			->define('simple', 'abc')
			->build();
		$this->assertEquals('abc', $platter->get('simple'));
	}

}
