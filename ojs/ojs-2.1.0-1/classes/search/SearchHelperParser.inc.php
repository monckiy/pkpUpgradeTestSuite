<?php

/**
 * SearchHelperParser.inc.php
 *
 * Copyright (c) 2003-2005 The Public Knowledge Project
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @package search
 *
 * Class to extract text from a file using an external helper program.
 *
 * $Id: SearchHelperParser.inc.php,v 1.4 2005/08/01 23:03:54 kevin Exp $
 */

import('search.SearchFileParser');

class SearchHelperParser extends SearchFileParser {

	/** @var $type string Type should match an index[$type] setting in the "search" section of config.inc.php */
	var $type;
	
	function SearchHelperParser($type, $filePath) {
		parent::SearchFileParser($filePath);
		$this->type = $type;
	}
	
	function open() {
		$prog = Config::getVar('search', 'index[' . $this->type . ']');
		
		if (isset($prog)) {
			$exec = sprintf($prog, escapeshellcmd($this->getFilePath()));
			$this->fp = @popen($exec, 'r');
			return $this->fp ? true : false;
		}
		
		return false;
	}
	
	function close() {
		pclose($this->fp);
	}

}

?>
