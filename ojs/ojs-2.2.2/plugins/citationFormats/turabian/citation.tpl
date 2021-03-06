{**
 * citation.tpl
 *
 * Copyright (c) 2003-2008 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * Article reading tools -- Capture Citation
 *
 * $Id: citation.tpl,v 1.5 2008/06/11 18:55:11 asmecher Exp $
 *}
<div class="separator"></div>

{assign var=authors value=$article->getAuthors()}
{assign var=authorCount value=$authors|@count}
{foreach from=$authors item=author name=authors key=i}
	{assign var=firstName value=$author->getFirstName()}
	{$author->getLastName()|escape}, {$firstName|escape}{if $i==$authorCount-2}, {translate key="rt.context.and"} {elseif $i<$authorCount-1}, {else}.{/if}
{/foreach}

"{$article->getArticleTitle()|strip_unsafe_html}" <em>{$journal->getJournalTitle()|escape}</em> [{translate key="rt.captureCite.online"}], {translate key="issue.volume"} {if $issue}{$issue->getVolume()|escape} {translate key="issue.number"} {$issue->getNumber()|escape} {/if}({$article->getDatePublished()|date_format:'%e %B %Y'|trim})

