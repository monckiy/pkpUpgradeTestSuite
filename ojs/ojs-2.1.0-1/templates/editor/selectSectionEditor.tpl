{**
 * selectSectionEditor.tpl
 *
 * Copyright (c) 2003-2005 The Public Knowledge Project
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * List copyeditors and give the ability to select a copyeditor.
 *
 * $Id: selectSectionEditor.tpl,v 1.25 2005/12/07 19:08:15 alec Exp $
 *}

{assign var="pageTitle" value="user.role.sectionEditors"}
{include file="common/header.tpl"}

{assign var="start" value="A"|ord}

<h3>{translate key="editor.article.selectSectionEditor"}</h3>

<form name="submit" method="post" action="{url op="assignEditor" articleId=$articleId}">
	<select name="searchField" size="1" class="selectMenu">
		{html_options_translate options=$fieldOptions selected=$searchField}
	</select>
	<select name="searchMatch" size="1" class="selectMenu">
		<option value="contains"{if $searchMatch == 'contains'} selected="selected"{/if}>{translate key="form.contains"}</option>
		<option value="is"{if $searchMatch == 'is'} selected="selected"{/if}>{translate key="form.is"}</option>
	</select>
	<input type="text" name="search" class="textField" value="{$search|escape}" />&nbsp;<input type="submit" value="{translate key="common.search"}" class="button" />
</form>

<p>{section loop=26 name=letters}<a href="{url op="assignEditor" articleId=$articleId searchInitial=$smarty.section.letters.index+$start|chr}">{if chr($smarty.section.letters.index+$start) == $searchInitial}<strong>{$smarty.section.letters.index+$start|chr}</strong>{else}{$smarty.section.letters.index+$start|chr}{/if}</a> {/section}<a href="{url op="assignEditor" articleId=$articleId}">{if $searchInitial==''}<strong>{translate key="common.all"}</strong>{else}{translate key="common.all"}{/if}</a></p>

<table width="100%" class="listing">
<tr><td colspan="5" class="headseparator">&nbsp;</td></tr>
<tr valign="bottom">
	<td class="heading" width="30%">{translate key="user.name"}</td>
	<td class="heading" width="20%">{translate key="section.sections"}</td>
	<td class="heading" width="20%">{translate key="submissions.completed"}</td>
	<td class="heading" width="20%">{translate key="submissions.active"}</td>
	<td class="heading" width="10%">{translate key="common.action"}</td>
</tr>
<tr><td colspan="5" class="headseparator">&nbsp;</td></tr>
{iterate from=editors item=editor}
{assign var=editorId value=$editor->getUserId()}
<tr valign="top">
	<td><a class="action" href="{url op="userProfile" path=$editorId}">{$editor->getFullName()}</a></td>
	<td>
		{assign var=thisEditorSections value=$editorSections[$editorId]}
		{foreach from=$thisEditorSections item=section}
			{$section->getSectionAbbrev()|escape}&nbsp;
		{foreachelse}
			&mdash;
		{/foreach}
	</td>
	<td>
		{if $editorStatistics[$editorId] && $editorStatistics[$editorId].complete}
			{$editorStatistics[$editorId].complete}
		{else}
			0
		{/if}
	</td>
	<td>
		{if $editorStatistics[$editorId] && $editorStatistics[$editorId].incomplete}
			{$editorStatistics[$editorId].incomplete}
		{else}
			0
		{/if}
	</td>
	<td><a class="action" href="{url op="assignEditor" articleId=$articleId editorId=$editorId}">{translate key="common.assign"}</a></td>
</tr>
<tr><td colspan="5" class="{if $editors->eof()}end{/if}separator">&nbsp;</td></tr>
{/iterate}
{if $editors->wasEmpty()}
<tr>
<td colspan="5" class="nodata">{translate key="manager.people.noneEnrolled"}</td>
</tr>
<tr><td colspan="5" class="{if $editors->eof()}end{/if}separator">&nbsp;</td></tr>
{else}
	<tr>
		<td colspan="2" align="left">{page_info iterator=$editors}</td>
		<td colspan="3" align="right">{page_links name="editors" iterator=$editors searchField=$searchField searchMatch=$searchMatch search=$search dateFromDay=$dateFromDay dateFromYear=$dateFromYear dateFromMonth=$dateFromMonth dateToDay=$dateToDay dateToYear=$dateToYear dateToMonth=$dateToMonth}</td>
	</tr>
{/if}
</table>

{include file="common/footer.tpl"}
