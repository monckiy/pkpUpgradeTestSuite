{**
 * citation.tpl
 *
 * Copyright (c) 2003-2009 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * Article reading tools -- Capture Citation CBE format
 *
 * $Id: citation.tpl,v 1.8 2009/05/26 01:31:17 mcrider Exp $
 *}
<div class="separator"></div>

<div id="citation">
{assign var=authors value=$article->getAuthors()}
{assign var=authorCount value=$authors|@count}
{foreach from=$authors item=author name=authors key=i}
	{assign var=firstName value=$author->getFirstName()}
	{$author->getLastName()|escape}, {$firstName[0]|escape}.{if $i==$authorCount-2}, &amp; {elseif $i<$authorCount-1}, {/if}
{/foreach}

{$article->getDatePublished()|date_format:'%Y %b %e'}. {$article->getLocalizedTitle()|strip_unsafe_html}. {$journal->getLocalizedTitle()|escape}. [{translate key="rt.captureCite.online"}] {if $issue}{$issue->getVolume()|escape}:{$issue->getNumber()|escape}{/if}
</div>
