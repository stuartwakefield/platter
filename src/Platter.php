<?php
class Platter {
	
	private $def;

	public function __construct($def) {
		$this->def = $def;
	}

	public function get($name) {
		return $this->def[$name];
	}

}