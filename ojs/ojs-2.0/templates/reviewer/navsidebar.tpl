{**
 * navsidebar.tpl
 *
 * Copyright (c) 2003-2004 The Public Knowledge Project
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * Reviewer navigation sidebar.
 *
 * $Id: navsidebar.tpl,v 1.8 2005/03/09 01:30:05 alec Exp $
 *}

<div class="block">
	<span class="blockTitle">{translate key="user.role.reviewer"}</span>
	<span class="blockSubtitle">{translate key="article.submissions"}</span>
	<ul>
		<li><a href="{$pageUrl}/reviewer/index/active">{translate key="common.queue.short.active"}</a>&nbsp;({if $submissionsCount[0]}<strong>{$submissionsCount[0]}</strong>{else}0{/if})</li>
		<li><a href="{$pageUrl}/reviewer/index/completed">{translate key="common.queue.short.completed"}</a>&nbsp;({if $submissionsCount[1]}<strong>{$submissionsCount[1]}</strong>{else}0{/if})</li>
	</ul>
</div>
