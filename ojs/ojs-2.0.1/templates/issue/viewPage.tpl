{**
 * viewPage.tpl
 *
 * Copyright (c) 2003-2004 The Public Knowledge Project
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * View issue: This adds the header and footer code to view.tpl.
 *
 * $Id: viewPage.tpl,v 1.1 2005/06/24 21:50:21 alec Exp $
 *}

{assign var="pageTitleTranslated" value=$issueTitle}
{assign var="pageCrumbTitleTranslated" value=$issueCrumbTitle}
{include file="common/header.tpl"}

{include file="issue/view.tpl"}

{include file="common/footer.tpl"}
