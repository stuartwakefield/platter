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

	public function testBuildConnectParent() {
		$parent = new Platter(array(
			'simple' => 'abc'
		));
		$builder = new Platter\Builder;
		$platter = $builder
			->define('callable', function ($container) {
				return strrev($container->get('simple'));
			})
			->connect($parent)
			->build();
		$this->assertEquals('cba', $platter->get('callable'));
	}

}
