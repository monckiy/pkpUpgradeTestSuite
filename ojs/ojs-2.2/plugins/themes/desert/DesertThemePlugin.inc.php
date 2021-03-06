<?php

/**
 * @file DesertThemePlugin.inc.php
 *
 * Copyright (c) 2003-2007 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @package plugins.themes.desert
 * @class DesertThemePlugin
 *
 * "Desert" theme plugin
 *
 * $Id: DesertThemePlugin.inc.php,v 1.4 2007/10/22 22:41:48 asmecher Exp $
 */

import('classes.plugins.ThemePlugin');

class DesertThemePlugin extends ThemePlugin {
	/**
	 * Get the name of this plugin. The name must be unique within
	 * its category.
	 * @return String name of plugin
	 */
	function getName() {
		return 'DesertThemePlugin';
	}

	function getDisplayName() {
		return 'Desert Theme';
	}

	function getDescription() {
		return 'Desert layout';
	}

	function getStylesheetFilename() {
		return 'desert.css';
	}

	function getLocaleFilename($locale) {
		return null; // No locale data
	}
}

?>
