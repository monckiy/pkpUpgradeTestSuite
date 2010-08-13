<?php

/**
 * @defgroup plugins_blocks_user
 */
 
/**
 * @file plugins/blocks/donation/index.php
 *
 * Copyright (c) 2003-2009 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @ingroup plugins_blocks_user
 * @brief Wrapper for donation block plugin.
 *
 */

// $Id: index.php,v 1.3.2.1 2009/04/08 19:43:09 asmecher Exp $


require_once('DonationBlockPlugin.inc.php');

return new DonationBlockPlugin();

?> 