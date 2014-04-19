<?php
/**
 * @author Stuart Wakefield <me@stuartwakefield.co.uk>
 * @copyright Copyright (c) 2014 Stuart Wakefield (http://stuartwakefield.co.uk)
 */
class Platter {
	
	/**
	 * @var array $defs The array of object definitions
	 */
	private $defs;

	/**
	 * @param array $defs The array of object definitions
	 */
	public function __construct($defs) {
		$this->defs = $defs;
	}

	/**
	 * @param string $name The identifier of the object to retrieve
	 * @return mixed The object identified by the identifier
	 * @throws InvalidArgumentException if the identifier has not been defined
	 */
	public function get($name) {
		if (!isset($this->defs[$name])) {
			throw new InvalidArgumentException(
				sprintf("Identifier '%s' is not defined", $name)
			);
		}
		$def = $this->defs[$name];
		if (is_callable($def)) {
			return call_user_func($def, $this);
		}
		return $def;
	}

}