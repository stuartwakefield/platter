<?php
/**
 * @author Stuart Wakefield <me@stuartwakefield.co.uk>
 * @copyright Copyright (c) 2014 Stuart Wakefield (http://stuartwakefield.co.uk)
 */

/**
 * The base container class
 */
class Platter implements Platter\Container {
	
	/**
	 * @var array $defs The array of object definitions
	 */
	private $defs;

	/**
	 * @var Platter\Container $parent An optional parent container
	 */
	private $parent;

	/**
	 * @param array $defs The array of object definitions
	 * @param Platter\Container $parent An optional parent container
	 */
	public function __construct($defs, $parent = null) {
		if ($parent === null) {
			$parent = new Platter\Container\Nil;
		}
		$this->defs = $defs;
		$this->parent = $parent;
	}

	/**
	 * @param string $name The identifier of the object to retrieve
	 * @return mixed The object identified by the identifier
	 * @throws InvalidArgumentException if the identifier has not been defined
	 */
	public function get($name) {
		if (!isset($this->defs[$name])) {
			return $this->parent->get($name);
		}
		$def = $this->defs[$name];
		if (is_callable($def)) {
			return call_user_func($def, $this);
		}
		return $def;
	}

	/**
	 * Retrieves all of the possible identifiers available through this container
	 * including all parent containers
	 * @return array The array of identifiers
	 */
	public function available() {
		return array_unique(array_merge($this->parent->available(), $this->defined()));
	}

	/**
	 * Retrieves all of the identifiers defined by this container
	 * @return array The array of identifiers
	 */
	public function defined() {
		return array_keys($this->defs);
	}

}
