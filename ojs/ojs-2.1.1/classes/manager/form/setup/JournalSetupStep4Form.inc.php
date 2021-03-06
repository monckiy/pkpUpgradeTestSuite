<?php

/**
 * JournalSetupStep4Form.inc.php
 *
 * Copyright (c) 2003-2006 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @package manager.form.setup
 *
 * Form for Step 4 of journal setup.
 *
 * $Id: JournalSetupStep4Form.inc.php,v 1.13 2006/06/12 23:25:52 alec Exp $
 */

import("manager.form.setup.JournalSetupForm");

class JournalSetupStep4Form extends JournalSetupForm {
	
	function JournalSetupStep4Form() {
		parent::JournalSetupForm(
			4,
			array(
				'publicationFormat' => 'int',
				'initialVolume' => 'int',
				'initialNumber' => 'int',
				'initialYear' => 'int',
				'pubFreqPolicy' => 'string',
				'useCopyeditors' => 'bool',
				'copyeditInstructions' => 'string',
				'useLayoutEditors' => 'bool',
				'layoutInstructions' => 'string',
				'useProofreaders' => 'bool',
				'proofInstructions' => 'string',
				'enableSubscriptions' => 'bool',
				'openAccessPolicy' => 'string',
				'enableAnnouncements' => 'bool',
				'enableAnnouncementsHomepage' => 'bool',
				'numAnnouncementsHomepage' => 'int',
				'announcementsIntroduction' => 'string',
				'volumePerYear' => 'int',
				'issuePerVolume' => 'int',
				'enablePublicIssueId' => 'bool',
				'enablePublicArticleId' => 'bool',
				'enablePublicSuppFileId' => 'bool',
				'enablePageNumber' => 'bool'
			)
		);
	}
}

?>
