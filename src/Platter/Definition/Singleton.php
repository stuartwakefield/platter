<?php
/**
 * @package Platter
 * @author Stuart Wakefield <me@stuartwakefield.co.uk>
 * @copyright Copyright (c) 2014 Stuart Wakefield (http://stuartwakefield.co.uk)
 */
namespace Platter\Definition;

class Singleton {
	
	private $callable;
	private $instance;

	public function __construct($callable) {
		$this->callable = $callable;
	}

	public function __invoke($container) {
		if ($this->instance == null) {
			$this->instance = call_user_func($this->callable, $container);
		}
		return $this->instance;
	}

}
