<?php
/**
 * @package Platter
 * @author Stuart Wakefield <me@stuartwakefield.co.uk>
 * @copyright Copyright (c) 2014 Stuart Wakefield (http://stuartwakefield.co.uk)
 */
namespace Platter;

/**
 * Defines the interface to be implemented by all containers
 */
interface Container {

	/**
	 * @param string $name The identifier of the object to retrieve
	 * @return mixed The object identified by the identifier
	 * @throws InvalidArgumentException if the identifier has not been defined
	 */
	public function get($name);

	/**
	 * @return array An array of identifiers available to this container
	 */
	public function available();

	/**
	 * @return array An array of identifiers that this container defines
	 */
	public function defined();

}
