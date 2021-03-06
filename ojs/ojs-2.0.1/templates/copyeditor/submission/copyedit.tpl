{**
 * copyedit.tpl
 *
 * Copyright (c) 2003-2005 The Public Knowledge Project
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * Subtemplate defining the copyeditor's submission management table.
 *
 * $Id: copyedit.tpl,v 1.6 2005/05/15 10:34:54 kevin Exp $
 *}

<a name="copyedit"></a>
<h3>{translate key="submission.copyedit"}</h3>

<p>{translate key="user.role.copyeditor"}:
{if $submission->getCopyeditorId()}&nbsp; {$copyeditor->getFullName()}{else}{translate key="common.none"}{/if}</p>

<table width="100%" class="info">
	<tr>
		<td width="40%" colspan="2"><a class="action" href="{$pageUrl}/copyeditor/viewMetadata/{$submission->getArticleId()}">{translate key="submission.reviewMetadata"}</a></td>
		<td width="20%" class="heading">{translate key="submission.request"}</td>
		<td width="20%" class="heading">{translate key="submission.underway"}</td>
		<td width="20%" class="heading">{translate key="submission.complete"}</td>
	</tr>
	<tr>
		<td width="5%">1.</td>
		<td width="35%">{translate key="submission.copyedit.initialCopyedit"}</td>
		<td>{$submission->getDateNotified()|date_format:$dateFormatShort|default:"&mdash;"}</td>
		<td>{$submission->getDateUnderway()|date_format:$dateFormatShort|default:"&mdash;"}</td>
		<td>
			{if not $submission->getDateNotified() or $submission->getDateCompleted()}
				{icon name="mail" disabled="disabled"}
			{else}
				{icon name="mail" url="$requestPageUrl/completeCopyedit?articleId=`$submission->getArticleId()`"}
			{/if}
			{$submission->getDateCompleted()|date_format:$dateFormatShort|default:""}
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td colspan="4">
			{translate key="common.file"}:
			{if $submission->getDateNotified() && $initialCopyeditFile}
				<a href="{$requestPageUrl}/downloadFile/{$submission->getArticleId()}/{$initialCopyeditFile->getFileId()}/{$initialCopyeditFile->getRevision()}" class="file">{$initialCopyeditFile->getFileName()}</a> {$initialCopyeditFile->getDateModified()|date_format:$dateFormatShort}
			{else}
				{translate key="common.none"}
			{/if}
			<br />
			<form method="post" action="{$requestPageUrl}/uploadCopyeditVersion"  enctype="multipart/form-data">
				<input type="hidden" name="articleId" value="{$submission->getArticleId()}" />
				<input type="hidden" name="copyeditStage" value="initial" />
				<input type="file" name="upload"{if not $submission->getDateNotified() or $submission->getDateCompleted()} disabled="disabled"{/if} class="uploadField" />
				<input type="submit" class="button" value="{translate key="common.upload"}"{if not $submission->getDateNotified() or $submission->getDateCompleted()} disabled="disabled"{/if} />
			</form>
		</td>
	</tr>
	<tr>
		<td colspan="5" class="separator">&nbsp;</td>
	</tr>
	<tr>
		<td>2.</td>
		<td>{translate key="submission.copyedit.editorAuthorReview"}</td>
		<td>{$submission->getDateAuthorNotified()|date_format:$dateFormatShort|default:"&mdash;"}</td>
		<td>{$submission->getDateAuthorUnderway()|date_format:$dateFormatShort|default:"&mdash;"}</td>
		<td>{$submission->getDateAuthorCompleted()|date_format:$dateFormatShort|default:"&mdash;"}</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td colspan="4">
			{translate key="common.file"}:
			{if $editorAuthorCopyeditFile}
				<a href="{$requestPageUrl}/downloadFile/{$submission->getArticleId()}/{$editorAuthorCopyeditFile->getFileId()}/{$editorAuthorCopyeditFile->getRevision()}" class="file">{$editorAuthorCopyeditFile->getFileName()}</a> {$editorAuthorCopyeditFile->getDateModified()|date_format:$dateFormatShort}
			{else}
				{translate key="common.none"}
			{/if}
		</td>
	</tr>
	<tr>
		<td colspan="5" class="separator">&nbsp;</td>
	</tr>
	<tr>
		<td>3.</td>
		<td>{translate key="submission.copyedit.finalCopyedit"}</td>
		<td width="20%">{$submission->getDateFinalNotified()|date_format:$dateFormatShort|default:"&mdash;"}</td>
		<td width="20%">{$submission->getDateFinalUnderway()|date_format:$dateFormatShort|default:"&mdash;"}</td>
		<td width="20%">
			{if not $submission->getDateFinalNotified() or $submission->getDateFinalCompleted()}
				{icon name="mail" disabled="disabled"}
			{else}
				{icon name="mail" url="$requestPageUrl/completeFinalCopyedit?articleId=`$submission->getArticleId()`"}
			{/if}
			{$submission->getDateFinalCompleted()|date_format:$dateFormatShort|default:""}
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td colspan="4">
			{translate key="common.file"}:
			{if $submission->getDateFinalNotified() && $finalCopyeditFile}
				<a href="{$requestPageUrl}/downloadFile/{$submission->getArticleId()}/{$finalCopyeditFile->getFileId()}/{$finalCopyeditFile->getRevision()}" class="file">{$finalCopyeditFile->getFileName()}</a> {$finalCopyeditFile->getDateModified()|date_format:$dateFormatShort}
			{else}
				{translate key="common.none"}
			{/if}
			<br />
			<form method="post" action="{$requestPageUrl}/uploadCopyeditVersion"  enctype="multipart/form-data">
				<input type="hidden" name="articleId" value="{$submission->getArticleId()}" />
				<input type="hidden" name="copyeditStage" value="final" />
				<input type="file" name="upload"{if not $submission->getDateFinalNotified() or $submission->getDateFinalCompleted()} disabled="disabled"{/if} class="uploadField">
				<input type="submit" class="button" value="{translate key="common.upload"}"{if not $submission->getDateFinalNotified() or $submission->getDateFinalCompleted()} disabled="disabled"{/if} />
			</form>
		</td>
	</tr>
	<tr>
		<td colspan="5" class="separator">&nbsp;</td>
	</tr>
</table>

{translate key="submission.copyedit.copyeditComments"}
{if $submission->getMostRecentCopyeditComment()}
	{assign var="comment" value=$submission->getMostRecentCopyeditComment()}        <a href="javascript:openComments('{$requestPageUrl}/viewCopyeditComments/{$submission->getArticleId()}#{$comment->getCommentId()}');" class="icon">{icon name="comment"}</a>{$comment->getDatePosted()|date_format:$dateFormatShort}
{else}
	<a href="javascript:openComments('{$requestPageUrl}/viewCopyeditComments/{$submission->getArticleId()}');" class="icon">{icon name="comment"}</a>
{/if}

{if $currentJournal->getSetting('copyeditInstructions')}
&nbsp;&nbsp;
<a href="javascript:openHelp('{$requestPageUrl}/instructions/copy')" class="action">{translate key="submission.copyedit.instructions"}</a>
{/if}
