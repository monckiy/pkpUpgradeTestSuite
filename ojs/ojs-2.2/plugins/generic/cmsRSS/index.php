<?php 

/**
 * @file index.php
 *
 * Copyright (c) 2006-2007 Gunther Eysenbach, Juan Pablo Alperin
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * Wrapper for CMS RSS plugin.
 *
 * @package plugins.generic.cmsRSS
 *
 * $Id: index.php,v 1.4 2007/09/19 00:04:38 asmecher Exp $
 */

require_once('CmsRssPlugin.inc.php');

return new CmsRssPlugin();

?>
