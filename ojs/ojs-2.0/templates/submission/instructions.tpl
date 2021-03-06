{**
 * instructions.tpl
 *
 * Copyright (c) 2003-2005 The Public Knowledge Project
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * Submissions instructions page.
 *
 * $Id: instructions.tpl,v 1.1 2005/03/14 01:14:47 kevin Exp $
 *}

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>{translate key=$pageTitle}</title>
	<meta http-equiv="Content-Type" content="text/html; charset={$defaultCharset}" />
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<link rel="stylesheet" href="{$baseUrl}/styles/common.css" type="text/css" />
	<link rel="stylesheet" href="{$baseUrl}/styles/help.css" type="text/css" />
	{foreach from=$stylesheets item=cssFile}
	<link rel="stylesheet" href="{$baseUrl}/styles/{$cssFile}" type="text/css" />
	{/foreach}
	<script type="text/javascript" src="{$baseUrl}/js/general.js"></script>
</head>
<body>
{literal}<script type="text/javascript">if (self.blur) { self.focus(); }</script>{/literal}

<div id="container">
<div id="body">

	<div id="main" style="width: 650px;">
	
		<br />
	
		<div class="thickSeparator"></div>
		
		<h2>{translate key=$pageTitle}</h2>
		
		<div id="content">
			<br />
			{$instructions|nl2br}
		</div>
		
	</div>

</div>
</div>
</body>
</html>
