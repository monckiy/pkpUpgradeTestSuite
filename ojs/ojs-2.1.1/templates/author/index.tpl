{**
 * index.tpl
 *
 * Copyright (c) 2003-2006 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * Journal author index.
 *
 * $Id: index.tpl,v 1.13 2006/06/12 23:26:26 alec Exp $
 *}

{assign var="pageTitle" value="common.queue.long.$pageToDisplay"}
{include file="common/header.tpl"}

<ul class="menu">
	<li{if ($pageToDisplay == "active")} class="current"{/if}><a href="{url op="index" path="active"}">{translate key="common.queue.short.active"}</a></li>
	<li{if ($pageToDisplay == "completed")} class="current"{/if}><a href="{url op="index" path="completed"}">{translate key="common.queue.short.completed"}</a></li>
</ul>

<br />

{include file="author/$pageToDisplay.tpl"}

<a href="{url op="submit"}" class="action">{translate key="author.submit.startHereLink"}</a><br />
</p>

{include file="common/footer.tpl"}
