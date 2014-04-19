<?php
/**
 * @package Platter
 * @author Stuart Wakefield <me@stuartwakefield.co.uk>
 * @copyright Copyright (c) 2014 Stuart Wakefield (http://stuartwakefield.co.uk)
 */
namespace Platter;

use Platter;

class Builder {
	
	private $defs = array();

	public function define($name, $def) {
		$this->defs[$name] = $def;
		return $this;
	}

	public function build() {
		return new Platter($this->defs);
	}

}
