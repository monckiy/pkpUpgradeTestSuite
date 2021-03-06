{**
 * issue.tpl
 *
 * Copyright (c) 2003-2007 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * Issue
 *
 * $Id: issue.tpl,v 1.31 2007/10/02 07:05:57 jalperin Exp $
 *} 
{foreach name=sections from=$publishedArticles item=section key=sectionId}
{if $section.title}<h4>{$section.title|escape}</h4>{/if}

{foreach from=$section.articles item=article}
<table width="100%">
<tr valign="top">
	<td width="70%">{$article->getArticleTitle()|strip_unsafe_html}</td>
	<td align="right" width="30%">
		{if $section.abstractsDisabled || $article->getArticleAbstract() == ""}
			{assign var=hasAbstract value=0}
		{else}
			{assign var=hasAbstract value=1}
		{/if}

		{if (!$subscriptionRequired || $article->getAccessStatus() || $subscribedUser || $subscribedDomain)}
			{assign var=hasAccess value=1}
		{else}
			{assign var=hasAccess value=0}
		{/if}

		{if !$hasAccess || $hasAbstract}<a href="{url page="article" op="view" path=$article->getBestArticleId($currentJournal)}" class="file">{if $hasAbstract}{translate key=article.abstract}{else}{translate key="article.details"}{/if}</a>{/if}

		{if $hasAccess || ($subscriptionRequired && $showGalleyLinks)}
			{foreach from=$article->getLocalizedGalleys() item=galley name=galleyList}
				<a href="{url page="article" op="view" path=$article->getBestArticleId($currentJournal)|to_array:$galley->getGalleyId()}" class="file">{$galley->getGalleyLabel()|escape}</a>
				{if $subscriptionRequired && $showGalleyLinks && $restrictOnlyPdf}
					{if $article->getAccessStatus() || !$galley->isPdfGalley()}	
						<img src="{$baseUrl}/templates/images/icons/fulltext_open_medium.png">
					{else}
						<img src="{$baseUrl}/templates/images/icons/fulltext_restricted_medium.png">
					{/if}
				{/if}
			{/foreach}
			{if $subscriptionRequired && $showGalleyLinks && !$restrictOnlyPdf}
				{if $article->getAccessStatus()}
					<img src="{$baseUrl}/templates/images/icons/fulltext_open_medium.png">
				{else}
					<img src="{$baseUrl}/templates/images/icons/fulltext_restricted_medium.png">
				{/if}
			{/if}				
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
