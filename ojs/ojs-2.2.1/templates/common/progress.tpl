{**
 * progress.tpl
 *
 * Copyright (c) 2003-2008 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * Generic progress bar page.
 * Displays a simple message and progress bar.
 *
 * $Id: progress.tpl,v 1.4 2008/06/11 18:55:18 asmecher Exp $
 *}
{include file="common/header.tpl"}

<p>{translate key=$message}</p>

<div class="progressbar">
  {call_progress_function}
</div>

{if $backLink}
<p>&#187; <a href="{$backLink}">{translate key="$backLinkLabel"}</a></p>
{/if}

{include file="common/footer.tpl"}
