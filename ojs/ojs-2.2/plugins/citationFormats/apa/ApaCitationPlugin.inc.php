<?php

/**
 * @file ApaCitationPlugin.inc.php
 *
 * Copyright (c) 2003-2007 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @package plugins.citationFormats.apa
 * @class ApaCitationPlugin
 *
 * APA citation format plugin
 *
 * $Id: ApaCitationPlugin.inc.php,v 1.3 2007/07/24 18:18:49 asmecher Exp $
 */

import('classes.plugins.CitationPlugin');

class ApaCitationPlugin extends CitationPlugin {
	function register($category, $path) {
		$success = parent::register($category, $path);
		$this->addLocaleData();
		return $success;
	}

	/**
	 * Get the name of this plugin. The name must be unique within
	 * its category.
	 * @return String name of plugin
	 */
	function getName() {
		return 'ApaCitationPlugin';
	}

	function getDisplayName() {
		return Locale::translate('plugins.citationFormats.apa.displayName');
	}

	function getCitationFormatName() {
		return Locale::translate('plugins.citationFormats.apa.citationFormatName');
	}

	function getDescription() {
		return Locale::translate('plugins.citationFormats.apa.description');
	}

}

?>
