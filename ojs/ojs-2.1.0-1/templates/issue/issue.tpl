{**
 * issue.tpl
 *
 * Copyright (c) 2003-2005 The Public Knowledge Project
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * Issue
 *
 * $Id: issue.tpl,v 1.22 2005/11/26 19:45:36 alec Exp $
 *}

{foreach name=sections from=$publishedArticles item=section key=sectionId}
{if $section.title}<h4>{$section.title|escape}</h4>{/if}

{foreach from=$section.articles item=article}
<table width="100%">
<tr valign="top">
	<td width="75%">{$article->getArticleTitle()|strip_unsafe_html}</td>
	<td align="right" width="25%">
		<a href="{url page="article" op="view" path=$article->getBestArticleId($currentJournal)}" class="file">{if $section.abstractsDisabled}{translate key="article.details"}{else}{translate key="article.abstract"}{/if}</a>
		{if (!$subscriptionRequired || $article->getAccessStatus() || $subscribedUser || $subscribedDomain)}
		{foreach from=$article->getGalleys() item=galley name=galleyList}
			<a href="{url page="article" op="view" path=$article->getBestArticleId($currentJournal)|to_array:$galley->getGalleyId()}" class="file">{$galley->getLabel()|escape}</a>
		{/foreach}
		{/if}
	</td>
</tr>
<tr>
	<td style="padding-left: 30px;font-style: italic;">
		{foreach from=$article->getAuthors() item=author name=authorList}
			{$author->getFullName()|escape}{if !$smarty.foreach.authorList.last},{/if}
		{/foreach}
	</td>
	<td align="right">{$article->getPages()|escape}</td>
</tr>
</table>
{/foreach}

{if !$smarty.foreach.sections.last}
<div class="separator"></div>
{/if}
{/foreach}
