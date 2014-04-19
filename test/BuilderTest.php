<?php
class BuilderTest extends PHPUnit_Framework_TestCase {
	
	public function testBuildEmpty() {
		$builder = new Platter\Builder;
		$platter = $builder->build();
		$this->assertEmpty($platter->defined());
	}

}
