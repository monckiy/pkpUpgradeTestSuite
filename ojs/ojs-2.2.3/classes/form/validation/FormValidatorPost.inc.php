<?php

/**
 * @file classes/form/validation/FormValidatorPost.inc.php
 *
 * Copyright (c) 2003-2009 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class FormValidatorPost
 * @ingroup form_validation
 *
 * @brief Form validation check to make sure the form is POSTed.
 */

// $Id: FormValidatorPost.inc.php,v 1.5.2.1 2009/04/08 19:42:47 asmecher Exp $


import ('form.validation.FormValidator');

class FormValidatorPost extends FormValidator {
	/**
	 * Constructor.
	 * @see FormValidator::FormValidator()
	 * @param message string the locale key to use (optional)
	 */
	function FormValidatorPost(&$form, $message = 'form.postRequired') {
		parent::FormValidator($form, 'dummy', 'required', $message);
	}

	/**
	 * Check if field value is valid.
	 * Value is valid if it is empty and optional or matches regular expression.
	 * @return boolean
	 */
	function isValid() {
		return Request::isPost();
	}

}

?>
