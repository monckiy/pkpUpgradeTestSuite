{**
 * index.tpl
 *
 * Copyright (c) 2003-2006 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * Display the statistics & reporting page.
 *
 * $Id: index.tpl,v 1.2 2006/06/12 23:26:31 alec Exp $
 *}

{assign var="pageTitle" value="manager.statistics"}
{include file="common/header.tpl"}
<br/>

{include file="manager/statistics/statistics.tpl"}

<div class="separator">&nbsp;</div>

<br/>

{include file="manager/statistics/reportGenerator.tpl"}

{include file="common/footer.tpl"}
