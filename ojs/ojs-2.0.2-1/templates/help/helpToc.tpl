{**
 * helpToc.tpl
 *
 * Copyright (c) 2003-2005 The Public Knowledge Project
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * Display the help table of contents
 *
 * $Id: helpToc.tpl,v 1.4 2005/04/11 01:45:32 jasonc Exp $
 *}

{include file="help/header.tpl"}

<div id="main" style="margin: 0; width: 660px;">

		<h4>{translate key="help.ojsHelp"}</h4>

		<div class="thickSeparator"></div>

		<div id="breadcrumb">
			<a href="{get_help_id key="index.index" url="true"}" class="current">{translate key="navigation.home"}</a>
		</div>

		<h2>{translate key="help.toc"}</h2>

		<div id="content">

		<div id="toc">
			<ul>
				<li><a href="{get_help_id key="index.index" url="true"}">{translate key="help.ojsHelp"}</a></li>
				{foreach from=$helpToc item=topic key=topicId}
				<li>{$topic.prefix}<a href="{$pageUrl}/help/view/{$topicId}">{$topic.title}</a></li>
				{/foreach}
			</ul>
		</div>

		<div class="separator" style="padding-top: 10px;"></div>

		<div>
			<h4>{translate key="help.search"}</h4>
			<form action="{$pageUrl}/help/search" method="post" style="display: inline">
			{translate key="help.searchFor"}&nbsp;&nbsp;<input type="text" name="keyword" size="30" maxlength="60" value="{$helpSearchKeyword|escape}" class="textField" />
			<input type="submit" value="{translate key="common.search"}" class="button" />
			</form>
		</div>

		</div>
</div>

{include file="help/footer.tpl"}
