<?php

/**
 * @file ImportExportHandler.inc.php
 *
 * Copyright (c) 2003-2009 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class ImportExportHandler
 * @ingroup pages_manager
 *
 * @brief Handle requests for import/export functions. 
 */

// $Id: ImportExportHandler.inc.php,v 1.9.2.1 2009/04/08 19:43:07 asmecher Exp $


define('IMPORTEXPORT_PLUGIN_CATEGORY', 'importexport');

class ImportExportHandler extends ManagerHandler {
	function importexport($args) {
		parent::validate();
		parent::setupTemplate(true);

		PluginRegistry::loadCategory(IMPORTEXPORT_PLUGIN_CATEGORY);
		$templateMgr = &TemplateManager::getManager();

		if (array_shift($args) === 'plugin') {
			$pluginName = array_shift($args);
			$plugin = &PluginRegistry::getPlugin(IMPORTEXPORT_PLUGIN_CATEGORY, $pluginName); 
			if ($plugin) return $plugin->display($args);
		}
		$templateMgr->assign_by_ref('plugins', PluginRegistry::getPlugins(IMPORTEXPORT_PLUGIN_CATEGORY));
		$templateMgr->assign('helpTopicId', 'journal.managementPages.importExport');
		$templateMgr->display('manager/importexport/plugins.tpl');
	}
}
?>
