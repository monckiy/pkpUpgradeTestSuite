{**
 * plugins.tpl
 *
 * Copyright (c) 2003-2007 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * List available import/export plugins.
 *
 * $Id: plugins.tpl,v 1.6 2007/09/04 16:31:46 asmecher Exp $
 *}
{assign var="pageTitle" value="manager.importExport"}
{include file="common/header.tpl"}

<ul>
	{foreach from=$plugins item=plugin}
	<li><a href="{url op="importexport" path="plugin"|to_array:$plugin->getName()}">{$plugin->getDisplayName()|escape}</a>:&nbsp;{$plugin->getDescription()|escape}</li>
	{/foreach}
</ul>

{include file="common/footer.tpl"}
