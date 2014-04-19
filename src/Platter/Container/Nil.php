<?php
/**
 * @package Platter\Container
 * @author Stuart Wakefield <me@stuartwakefield.co.uk>
 * @copyright Copyright (c) 2014 Stuart Wakefield (http://stuartwakefield.co.uk)
 */
namespace Platter\Container;

use Platter;
use InvalidArgumentException;

/**
 * The Nil container represents a container with no entries
 */
class Nil implements Platter\Container {
	
	/**
	 * @param string $name The identifier of the object to retrieve
	 * @return mixed The object identified by the identifier
	 * @throws InvalidArgumentException if the identifier has not been defined
	 */
	public function get($name) {
		throw new InvalidArgumentException(
			sprintf("Identifier '%s' is not defined", $name)
		);
	}

	public function available() {
		return $this->defined();
	}

	public function defined() {
		return array();
	}

}