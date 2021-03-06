{**
 * editorialTeam.tpl
 *
 * Copyright (c) 2003-2005 The Public Knowledge Project
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * About the Journal index.
 *
 * $Id: editorialTeam.tpl,v 1.7 2005/03/15 19:13:38 alec Exp $
 *}

{assign var="pageTitle" value="about.editorialTeam"}
{include file="common/header.tpl"}

{if count($editors) > 0}
<h3>{translate key="user.role.editors"}</h3>
<p>
{foreach from=$editors item=editor}
	{$editor->getFullName()}{if strlen($editor->getAffiliation()) > 0}, {$editor->getAffiliation()}{/if}
	<br />
{/foreach}
</p>
{/if}

{if count($sectionEditors) > 0}
<h3>{translate key="user.role.sectionEditors"}</h3>
<p>
{foreach from=$sectionEditors item=sectionEditor}
	{$sectionEditor->getFullName()}{if strlen($sectionEditor->getAffiliation()) > 0}, {$sectionEditor->getAffiliation()}{/if}
	<br/>
{/foreach}
</p>
{/if}

{if count($layoutEditors) > 0}
<h3>{translate key="user.role.layoutEditors"}</h3>
<p>
{foreach from=$layoutEditors item=layoutEditor}
	{$layoutEditor->getFullName()}{if strlen($layoutEditor->getAffiliation()) > 0}, {$layoutEditor->getAffiliation()}{/if}
	<br/>
{/foreach}
</p>
{/if}


{include file="common/footer.tpl"}
