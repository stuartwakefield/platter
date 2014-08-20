<?php
/**
 * @package Platter
 * @author Stuart Wakefield <me@stuartwakefield.co.uk>
 * @copyright Copyright (c) 2014 Stuart Wakefield (http://stuartwakefield.co.uk)
 */
namespace Platter;

use Platter;

class Builder {
	
	private $defs;
	private $parent;

	public function __construct($defs = array(), $parent = null) {
		$this->defs = $defs;
		$this->parent = $parent;
	}

	public function define($name, $def) {
		return new self(array(
			$name => $def
		) + $this->defs, $this->parent);
	}

	public function forget($name) {
		return new self(array_diff_key($this->defs, array_flip(array($name))), $this->parent);
	}

	public function connect($parent) {
		return new self($this->defs, $parent);
	}

	public function disconnect() {
		return new self($this->defs, null);
	}

	public function build() {
		return new Platter($this->defs, $this->parent);
	}

}
