<?php

/**
 * @file plugins/oaiMetadata/marc/OAIMetadataFormatPlugin_MARC.inc.php
 *
 * Copyright (c) 2003-2009 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class OAIMetadataFormatPlugin_MARC
 * @ingroup oai_format
 * @see OAI
 *
 * @brief marc metadata format plugin for OAI.
 */

// $Id: OAIMetadataFormatPlugin_MARC.inc.php,v 1.2 2009/04/08 19:54:48 asmecher Exp $


import('plugins.OAIMetadataFormatPlugin');

class OAIMetadataFormatPlugin_MARC extends OAIMetadataFormatPlugin {

	/**
	 * Get the name of this plugin. The name must be unique within
	 * its category.
	 * @return String name of plugin
	 */
	function getName() {
		return 'OAIFormatPlugin_MARC';
	}

	function getDisplayName() {
		return Locale::translate('plugins.OAIMetadata.marc.displayName');
	}

	function getDescription() {
		return Locale::translate('plugins.OAIMetadata.marc.description');
	}

	function getFormatClass() {
		return 'OAIMetadataFormat_MARC';
	}

	function getMetadataPrefix() {
		return 'oai_marc';
	}

	function getSchema() {
		return 'http://www.openarchives.org/OAI/1.1/oai_marc.xsd';
	}

	function getNamespace() {
		return 'http://www.openarchives.org/OAI/1.1/oai_marc';
	}
}

?>
