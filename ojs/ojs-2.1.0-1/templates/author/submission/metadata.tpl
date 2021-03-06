{**
 * metadata.tpl
 *
 * Copyright (c) 2003-2005 The Public Knowledge Project
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * Subtemplate defining the submission metadata table.
 *
 * $Id: metadata.tpl,v 1.13 2006/01/05 21:04:28 alec Exp $
 *}

<a name="metadata"></a>
<h3>{translate key="submission.metadata"}</h3>

{if !$submission->getCopyeditorDateCompleted()}<p><a href="{url op="viewMetadata" path=$submission->getArticleId()}" class="action">{translate key="submission.editMetadata"}</a></p>{/if}


<h4>{translate key="article.authors"}</h4>
	
<table width="100%" class="data">
	{foreach name=authors from=$submission->getAuthors() item=author}
	<tr valign="top">
		<td width="20%" class="label">{translate key="user.name"}</td>

		{assign var=emailString value="`$author->getFullName()` <`$author->getEmail()`>"}
		{url|assign:"url" page="user" op="email" to=$emailString|to_array redirectUrl=$currentUrl subject=$submission->getArticleTitle()|strip_tags}
		<td width="80%" class="value">{$author->getFullName()|escape} {icon name="mail" url=$url}</td>
	</tr>
	<tr valign="top">
		<td class="label">{translate key="user.affiliation"}</td>
		<td class="value">{$author->getAffiliation()|escape|default:"&mdash;"}</td>
	</tr>
	<tr valign="top">
		<td class="label">{translate key="user.biography"}</td>
		<td class="value">{$author->getBiography()|nl2br|strip_unsafe_html|default:"&mdash;"}</td>
	</tr>
	{if $author->getPrimaryContact()}
	<tr valign="top">
		<td colspan="2" class="label">{translate key="author.submit.selectPrincipalContact"}</td>
	</tr>
	{/if}
	{if !$smarty.foreach.authors.last}
	<tr>
		<td colspan="2" class="separator">&nbsp;</td>
	</tr>
	{/if}
	{/foreach}
</table>


<br />


<h4>{if $section->getAbstractsDisabled()}{translate key="article.title"}{else}{translate key="submission.titleAndAbstract"}{/if}</h4>

<table width="100%" class="data">
	<tr valign="top">
		<td width="20%" class="label">{translate key="article.title"}</td>
		<td width="80%" class="value">{$submission->getTitle()|escape|default:"&mdash;"}</td>
	</tr>
	{if $alternateLocale1}
	<tr valign="top">
		<td class="label">{translate key="article.title"}<br />({$languageToggleLocales.$alternateLocale1|escape})</td>
		<td class="value">{$submission->getTitleAlt1()|escape|default:"&mdash;"}</td>
	</tr>
	{/if}
	{if $alternateLocale2}
	<tr valign="top">
		<td class="label">{translate key="article.title"}<br />({$languageToggleLocales.$alternateLocale2|escape})</td>
		<td class="value">{$submission->getTitleAlt2()|escape|default:"&mdash;"}</td>
	</tr>
	{/if}

	{if !$section->getAbstractsDisabled()}
	<tr>
		<td colspan="2" class="separator">&nbsp;</td>
	</tr>
	<tr valign="top">
		<td class="label">{translate key="article.abstract"}</td>
		<td class="value">{$submission->getAbstract()|strip_unsafe_html|nl2br|default:"&mdash;"}</td>
	</tr>
	{if $alternateLocale1}
	<tr valign="top">
		<td class="label">{translate key="article.abstract"}<br />({$languageToggleLocales.$alternateLocale1|escape})</td>
		<td class="value">{$submission->getAbstractAlt1()|strip_unsafe_html|escape|nl2br|default:"&mdash;"}</td>
	</tr>
	{/if}
	{if $alternateLocale2}
	<tr valign="top">
		<td class="label">{translate key="article.abstract"}<br />({$languageToggleLocales.$alternateLocale2|escape})</td>
		<td class="value">{$submission->getAbstractAlt2()|strip_unsafe_html|escape|nl2br|default:"&mdash;"}</td>
	</tr>
	{/if}
	{/if}
</table>


<br />


<h4>{translate key="submission.indexing"}</h4>
	
<table width="100%" class="data">
	{if $journalSettings.metaDiscipline}
	<tr valign="top">
		<td width="20%" class="label">{translate key="article.discipline"}</td>
		<td width="80%" class="value">{$submission->getDiscipline()|escape|default:"&mdash;"}</td>
	</tr>
	<tr>
		<td colspan="2" class="separator">&nbsp;</td>
	</tr>
	{/if}
	{if $journalSettings.metaSubjectClass}
	<tr valign="top">
		<td width="20%"  class="label">{translate key="article.subjectClassification"}</td>
		<td width="80%" class="value">{$submission->getSubjectClass()|escape|default:"&mdash;"}</td>
	</tr>
	<tr>
		<td colspan="2" class="separator">&nbsp;</td>
	</tr>
	{/if}
	{if $journalSettings.metaSubject}
	<tr valign="top">
		<td width="20%"  class="label">{translate key="article.subject"}</td>
		<td width="80%" class="value">{$submission->getSubject()|escape|default:"&mdash;"}</td>
	</tr>
	<tr>
		<td colspan="2" class="separator">&nbsp;</td>
	</tr>
	{/if}
	{if $journalSettings.metaCoverage}
	<tr valign="top">
		<td width="20%"  class="label">{translate key="article.coverageGeo"}</td>
		<td width="80%" class="value">{$submission->getCoverageGeo()|escape|default:"&mdash;"}</td>
	</tr>
	<tr>
		<td colspan="2" class="separator">&nbsp;</td>
	</tr>
	<tr valign="top">
		<td class="label">{translate key="article.coverageChron"}</td>
		<td class="value">{$submission->getCoverageChron()|escape|default:"&mdash;"}</td>
	</tr>
	<tr>
		<td colspan="2" class="separator">&nbsp;</td>
	</tr>
	<tr valign="top">
		<td class="label">{translate key="article.coverageSample"}</td>
		<td class="value">{$submission->getCoverageSample()|escape|default:"&mdash;"}</td>
	</tr>
	<tr>
		<td colspan="2" class="separator">&nbsp;</td>
	</tr>
	{/if}
	{if $journalSettings.metaType}
	<tr valign="top">
		<td width="20%"  class="label">{translate key="article.type"}</td>
		<td width="80%" class="value">{$submission->getType()|escape|default:"&mdash;"}</td>
	</tr>
	<tr>
		<td colspan="2" class="separator">&nbsp;</td>
	</tr>
	{/if}
	<tr valign="top">
		<td width="20%" class="label">{translate key="article.language"}</td>
		<td width="80%" class="value">{$submission->getLanguage()|escape|default:"&mdash;"}</td>
	</tr>
</table>


<br />


<h4>{translate key="submission.supportingAgencies"}</h4>
	
<table width="100%" class="data">
	<tr valign="top">
		<td width="20%" class="label">{translate key="author.submit.agencies"}</td>
		<td width="80%" class="value">{$submission->getSponsor()|escape|default:"&mdash;"}</td>
	</tr>
</table>
