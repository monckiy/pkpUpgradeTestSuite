{**
 * block.tpl
 *
 * Copyright (c) 2003-2009 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * Common site sidebar menu -- language toggle.
 *
 * $Id: block.tpl,v 1.4.2.1 2009/04/08 19:43:10 asmecher Exp $
 *}
{if $enableLanguageToggle}
<div class="block" id="sidebarLanguageToggle">
	<span class="blockTitle">{translate key="common.language"}</span>
	<form action="#">
		<select size="1" name="locale" onchange="location.href={if $languageToggleNoUser}'{$currentUrl|escape}{if strstr($currentUrl, '?')}&{else}?{/if}setLocale='+this.options[this.selectedIndex].value{else}('{url page="user" op="setLocale" path="NEW_LOCALE" source=$smarty.server.REQUEST_URI escape=false}'.replace('NEW_LOCALE', this.options[this.selectedIndex].value)){/if}" class="selectMenu">{html_options options=$languageToggleLocales selected=$currentLocale}</select>
	</form>
</div>
{/if}
