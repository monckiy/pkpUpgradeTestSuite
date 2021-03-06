<?php

/**
 * @defgroup pages_issue
 */
 
/**
 * @file pages/issue/index.php
 *
 * Copyright (c) 2003-2009 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @ingroup pages_issue
 * @brief Handle requests for issue functions. 
 *
 */

// $Id: index.php,v 1.11 2009/12/12 00:27:47 asmecher Exp $


switch ($op) {
	case 'index':
	case 'current':
	case 'view':
	case 'archive':
		define('HANDLER_CLASS', 'IssueHandler');
		import('pages.issue.IssueHandler');
		break;
}

?>
