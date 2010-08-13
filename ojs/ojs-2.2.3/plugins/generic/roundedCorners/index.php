<?php

/**
 * @defgroup plugins_generic_roundedCorners
 */
 
/**
 * @file plugins/generic/roundedCorners/index.php
 *
 * Copyright (c) 2003-2009 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @ingroup plugins_generic_roundedCorners
 * @brief Wrapper for rounded corners plugin.
 *
 */

// $Id: index.php,v 1.6.2.1 2009/04/08 19:43:17 asmecher Exp $


require_once('RoundedCornersPlugin.inc.php');

return new RoundedCornersPlugin();

?> 
