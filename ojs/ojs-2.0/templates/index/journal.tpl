{**
 * index.tpl
 *
 * Copyright (c) 2003-2004 The Public Knowledge Project
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * Journal index page.
 *
 * $Id: journal.tpl,v 1.11 2005/05/16 05:46:34 kevin Exp $
 *}

{assign var="pageTitleTranslated" value=$siteTitle}
{include file="common/header.tpl"}

<div>{$journalDescription}</div>

<br />

{if $homepageImage}
<div align="center"><img src="{$publicFilesDir}/{$homepageImage.uploadName}" width="{$homepageImage.width}" height="{$homepageImage.height}" border="0" alt="" /></div>
{/if}

<br /><br />

{$additionalHomeContent}

{include file="common/footer.tpl"}
