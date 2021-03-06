<?php

/**
 * @file JournalRT.inc.php
 *
 * Copyright (c) 2003-2007 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @package rt.ojs
 * @class JournalRT
 *
 * OJS-specific Reading Tools end-user interface.
 *
 * $Id: JournalRT.inc.php,v 1.8 2007/07/23 22:28:18 asmecher Exp $
 */

import('rt.RT');
import('rt.ojs.RTDAO');

class JournalRT extends RT {
	var $journalId;
	var $enabled;

	function JournalRT($journalId) {
		$this->setJournalId($journalId);
	}

	// Getter/setter methods

	function getJournalId() {
		return $this->journalId;
	}

	function setJournalId($journalId) {
		$this->journalId = $journalId;
	}
}

?>
