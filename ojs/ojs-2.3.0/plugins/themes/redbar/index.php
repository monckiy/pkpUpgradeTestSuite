<?php

/**
 * @defgroup plugins_themes_redbar
 */

/**
 * @file plugins/themes/redbar/index.php
 *
 * Copyright (c) 2003-2009 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @ingroup plugins_themes_redbar
 * @brief Wrapper for "redbar" theme plugin.
 *
 */

// $Id: index.php,v 1.7 2009/05/12 16:57:21 asmecher Exp $


require_once('RedbarThemePlugin.inc.php');

return new RedbarThemePlugin();

?>