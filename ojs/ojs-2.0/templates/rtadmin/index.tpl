{**
 * index.tpl
 *
 * Copyright (c) 2003-2005 The Public Knowledge Project
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * Research Tool Administrator index.
 *
 * $Id: index.tpl,v 1.6 2005/04/25 07:34:01 kevin Exp $
 *}

{assign var="pageTitle" value="rt.readingTools"}
{include file="common/header.tpl"}

<h3>{translate key="rt.admin.status"}</h3>
<p>{translate key="rt.admin.selectedVersion"}: {if $versionTitle}{$versionTitle}{else}{translate key="rt.admin.rtDisabled"}{/if}<p>

<p>{translate key="rt.admin.rtEnable"}</p>

<h3>{translate key="rt.admin.configuration"}</h3>
<ul class="plain">
	<li>&#187; <a href="{$pageUrl}/rtadmin/settings">{translate key="rt.admin.settings"}</a></li>
	<li>&#187; <a href="{$pageUrl}/rtadmin/versions">{translate key="rt.versions"}</a></li>
</ul>

<h3>{translate key="rt.admin.management"}</h3>
<ul class="plain">
	<li>&#187; <a href="{$pageUrl}/rtadmin/validateUrls">{translate key="rt.admin.validateUrls"}</a></li>
</ul>

{include file="common/footer.tpl"}
