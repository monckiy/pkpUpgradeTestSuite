<?php /* Smarty version 2.6.12, created on 2006-07-17 16:34:28
         compiled from common/sidebar.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'common/sidebar.tpl', 13, false),array('function', 'get_help_id', 'common/sidebar.tpl', 17, false),array('function', 'url', 'common/sidebar.tpl', 17, false),array('function', 'html_options', 'common/sidebar.tpl', 66, false),array('function', 'html_options_translate', 'common/sidebar.tpl', 82, false),array('modifier', 'escape', 'common/sidebar.tpl', 24, false),)), $this); ?>
<div id="sidebar">
	<div class="block">
		<a href="http://pkp.sfu.ca/ojs/" id="developedBy"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.openJournalSystems"), $this);?>
</a>
	</div>
	
	<div class="block">
		<a href="javascript:openHelp('<?php if ($this->_tpl_vars['helpTopicId']):  echo $this->_plugins['function']['get_help_id'][0][0]->smartyGetHelpId(array('key' => ($this->_tpl_vars['helpTopicId']),'url' => 'true'), $this); else:  echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('page' => 'help'), $this); endif; ?>')"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "navigation.journalHelp"), $this);?>
</a>
	</div>
		
	<div class="block">
		<span class="blockTitle"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "navigation.user"), $this);?>
</span>
		<?php if ($this->_tpl_vars['isUserLoggedIn']): ?>
		<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "navigation.loggedInAs"), $this);?>
<br />
		<strong><?php echo ((is_array($_tmp=$this->_tpl_vars['loggedInUsername'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</strong>
		
		<ul>
			<?php if ($this->_tpl_vars['hasOtherJournals']): ?>
			<li><a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('journal' => 'index','page' => 'user'), $this);?>
"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "navigation.myJournals"), $this);?>
</a></li>
			<?php endif; ?>
			<li><a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('page' => 'user','op' => 'profile'), $this);?>
"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "navigation.myProfile"), $this);?>
</a></li>
			<li><a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('page' => 'login','op' => 'signOut'), $this);?>
"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "navigation.logout"), $this);?>
</a></li>
		<?php if ($this->_tpl_vars['userSession']->getSessionVar('signedInAs')): ?>
			<li><a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('page' => 'manager','op' => 'signOutAsUser'), $this);?>
"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.people.signOutAsUser"), $this);?>
</a></li>
		<?php endif; ?>
		</ul>
		<?php else: ?>
		<form method="post" action="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('page' => 'login','op' => 'signIn'), $this);?>
">
		<table>
		<tr>
			<td><label for="sidebar-username"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "user.username"), $this);?>
</label></td>
			<td><input type="text" id="sidebar-username" name="username" value="" size="12" maxlength="32" class="textField" /></td>
		</tr>
		<tr>
			<td><label for="sidebar-password"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "user.password"), $this);?>
</label></td>
			<td><input type="password" id="sidebar-password" name="password" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['password'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" size="12" maxlength="32" class="textField" /></td>
		</tr>
		<tr>
			<td colspan="2"><input type="checkbox" id="remember" name="remember" value="1" /> <label for="remember"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "user.login.rememberMe"), $this);?>
</label></td>
		</tr>
		<tr>
			<td><input type="submit" value="<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "user.login"), $this);?>
" class="button" /></td>
		</tr>
		</table>
		</form>
		<?php endif; ?>
	</div>
	
	<?php if ($this->_tpl_vars['sidebarTemplate']): ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['sidebarTemplate'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>
	
	<?php if ($this->_tpl_vars['enableLanguageToggle']): ?>
	<div class="block">
		<span class="blockTitle"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.language"), $this);?>
</span>
		<form action="#">
			<select size="1" name="locale" onchange="location.href=<?php if ($this->_tpl_vars['languageToggleNoUser']): ?>'<?php echo $this->_tpl_vars['currentUrl'];  if (strstr ( $this->_tpl_vars['currentUrl'] , '?' )): ?>&<?php else: ?>?<?php endif; ?>setLocale='+this.options[this.selectedIndex].value<?php else: ?>('<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('page' => 'user','op' => 'setLocale','path' => 'NEW_LOCALE','source' => $_SERVER['REQUEST_URI'],'escape' => false), $this);?>
'.replace('NEW_LOCALE', this.options[this.selectedIndex].value))<?php endif; ?>" class="selectMenu"><?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['languageToggleLocales'],'selected' => $this->_tpl_vars['currentLocale']), $this);?>
</select>
		</form>
	</div>
	<?php endif; ?>
		
	<div class="block">
		<span class="blockTitle"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "navigation.journalContent"), $this);?>
</span>
		
		<span class="blockSubtitle"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "navigation.search"), $this);?>
</span>
		<form method="post" action="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('page' => 'search','op' => 'results'), $this);?>
">
		<table>
		<tr>
			<td><input type="text" id="query" name="query" size="15" maxlength="255" value="" class="textField" /></td>
		</tr>
		<tr>
			<td><select name="searchField" size="1" class="selectMenu">
				<?php echo $this->_plugins['function']['html_options_translate'][0][0]->smartyHtmlOptionsTranslate(array('options' => $this->_tpl_vars['articleSearchByOptions']), $this);?>

			</select></td>
		</tr>
		<tr>
			<td><input type="submit" value="<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.search"), $this);?>
" class="button" /></td>
		</tr>
		</table>
		</form>
		
		<br />
		
		<?php if ($this->_tpl_vars['currentJournal']): ?>
		<span class="blockSubtitle"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "navigation.browse"), $this);?>
</span>
		<ul>
			<li><a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('page' => 'issue','op' => 'archive'), $this);?>
"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "navigation.browseByIssue"), $this);?>
</a></li>
			<li><a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('page' => 'search','op' => 'authors'), $this);?>
"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "navigation.browseByAuthor"), $this);?>
</a></li>
			<li><a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('page' => 'search','op' => 'titles'), $this);?>
"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "navigation.browseByTitle"), $this);?>
</a></li>
			<?php if ($this->_tpl_vars['hasOtherJournals']): ?>
			<li><a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('journal' => 'index'), $this);?>
"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "navigation.otherJournals"), $this);?>
</a></li>
			<?php endif; ?>
		</ul>
		<?php endif; ?>
	</div>
	
	<?php if ($this->_tpl_vars['currentJournal']): ?>
	<div class="block">
		<span class="blockTitle"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "navigation.info"), $this);?>
</span>
		<ul>
			<li><a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('page' => 'information','op' => 'readers'), $this);?>
"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "navigation.infoForReaders"), $this);?>
</a></li>
			<li><a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('page' => 'information','op' => 'authors'), $this);?>
"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "navigation.infoForAuthors"), $this);?>
</a></li>
			<li><a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('page' => 'information','op' => 'librarians'), $this);?>
"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "navigation.infoForLibrarians"), $this);?>
</a></li>		
		</ul>
	</div>
	<?php endif; ?>
</div>