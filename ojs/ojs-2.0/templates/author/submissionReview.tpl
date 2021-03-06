{**
 * submissionReview.tpl
 *
 * Copyright (c) 2003-2005 The Public Knowledge Project
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * Author's submission review.
 *
 * $Id: submissionReview.tpl,v 1.9 2005/03/10 02:10:35 jasonc Exp $
 *}

{assign_translate var="pageTitleTranslated" key="submission.page.review" id=$submission->getArticleId()}
{assign var="pageCrumbTitle" value="submission.review"}
{include file="common/header.tpl"}

<ul class="menu">
	<li><a href="{$requestPageUrl}/submission/{$submission->getArticleId()}">{translate key="submission.summary"}</a></li>
	<li class="current"><a href="{$requestPageUrl}/submissionReview/{$submission->getArticleId()}">{translate key="submission.review"}</a></li>
	<li><a href="{$requestPageUrl}/submissionEditing/{$submission->getArticleId()}">{translate key="submission.editing"}</a></li>
</ul>


{include file="author/submission/summary.tpl"}

<div class="separator"></div>

{include file="author/submission/peerReview.tpl"}

<div class="separator"></div>

{include file="author/submission/editorDecision.tpl"}

{include file="common/footer.tpl"}
