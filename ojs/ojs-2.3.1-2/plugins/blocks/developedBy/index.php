<?php

/**
 * @defgroup plugins_blocks_developedBy
 */
 
/**
 * @file plugins/blocks/developedBy/index.php
 *
 * Copyright (c) 2003-2009 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @ingroup plugins_blocks_developedBy
 * @brief Wrapper for "developed by" block plugin.
 *
 */

// $Id: index.php,v 1.6 2009/04/08 19:54:34 asmecher Exp $


require_once('DevelopedByBlockPlugin.inc.php');

return new DevelopedByBlockPlugin();

?> 
