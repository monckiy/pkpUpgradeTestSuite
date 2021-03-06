<?php

/**
 * FormValidatorAlphaNum.inc.php
 *
 * Copyright (c) 2003-2004 The Public Knowledge Project
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @package form.validation
 *
 * Form validation check for alphanumeric (plus interior dash/underscore) characters only.
 *
 * $Id: FormValidatorAlphaNum.inc.php,v 1.2 2005/04/25 20:38:11 alec Exp $
 */

import('form.validation.FormValidatorRegExp');

class FormValidatorAlphaNum extends FormValidatorRegExp {

	/**
	 * Constructor.
	 * @see FormValidatorRegExp::FormValidatorRegExp()
	 */
	function FormValidatorAlphaNum($form, $field, $type, $message) {
		parent::FormValidatorRegExp(&$form, $field, $type, $message,
			'/^[A-Z0-9]+([\-_][A-Z0-9]+)*$/i'
		);
	}
	
}

?>
