<?php /* Smarty version 2.6.12, created on 2006-02-03 13:26:36
         compiled from editor/submissionsInReview.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'editor/submissionsInReview.tpl', 17, false),array('function', 'url', 'editor/submissionsInReview.tpl', 45, false),array('function', 'page_info', 'editor/submissionsInReview.tpl', 104, false),array('function', 'page_links', 'editor/submissionsInReview.tpl', 105, false),array('block', 'iterate', 'editor/submissionsInReview.tpl', 39, false),array('modifier', 'date_format', 'editor/submissionsInReview.tpl', 42, false),array('modifier', 'escape', 'editor/submissionsInReview.tpl', 43, false),array('modifier', 'truncate', 'editor/submissionsInReview.tpl', 44, false),array('modifier', 'strip_unsafe_html', 'editor/submissionsInReview.tpl', 45, false),)), $this); ?>

<table width="100%" class="listing">
	<tr>
		<td colspan="8" class="headseparator">&nbsp;</td>
	</tr>
	<tr class="heading" valign="bottom">
		<td width="5%"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.id"), $this);?>
</td>
		<td width="5%"><span class="disabled">MM-DD</span><br /><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "submissions.submit"), $this);?>
</td>
		<td width="5%"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "submissions.sec"), $this);?>
</td>
		<td width="15%"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "article.authors"), $this);?>
</td>
		<td width="30%"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "article.title"), $this);?>
</td>
		<td width="30%">
			<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "submission.peerReview"), $this);?>

			<table width="100%" class="nested">
				<tr valign="top">
					<td class="padded"><span class="nested"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "submission.ask"), $this);?>
</span></td>
					<td class="padded"><span class="nested"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "submission.due"), $this);?>
</span></td>
					<td class="padded"><span class="nested"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "submission.done"), $this);?>
</span></td>
				</tr>
			</table>
		</td>
		<td width="5%"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "submissions.ruling"), $this);?>
</td>
		<td width="5%"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "article.sectionEditor"), $this);?>
</td>
	</tr>
	<tr>
		<td colspan="8" class="headseparator">&nbsp;</td>
	</tr>
	
	<?php $this->_tag_stack[] = array('iterate', array('from' => 'submissions','item' => 'submission')); $_block_repeat=true;$this->_plugins['block']['iterate'][0][0]->smartyIterate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<tr valign="top">
		<td><?php echo $this->_tpl_vars['submission']->getArticleId(); ?>
</td>
		<td><?php echo ((is_array($_tmp=$this->_tpl_vars['submission']->getDateSubmitted())) ? $this->_run_mod_handler('date_format', true, $_tmp, $this->_tpl_vars['dateFormatTrunc']) : smarty_modifier_date_format($_tmp, $this->_tpl_vars['dateFormatTrunc'])); ?>
</td>
		<td><?php echo ((is_array($_tmp=$this->_tpl_vars['submission']->getSectionAbbrev())) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
		<td><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['submission']->getAuthorString(true))) ? $this->_run_mod_handler('truncate', true, $_tmp, 40, "...") : smarty_modifier_truncate($_tmp, 40, "...")))) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
		<td><a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('op' => 'submissionReview','path' => $this->_tpl_vars['submission']->getArticleId()), $this);?>
" class="action"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['submission']->getArticleTitle())) ? $this->_run_mod_handler('strip_unsafe_html', true, $_tmp) : String::stripUnsafeHtml($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 40, "...") : smarty_modifier_truncate($_tmp, 40, "...")); ?>
</a></td>
		<td>
			<table width="100%">
			<?php $_from = $this->_tpl_vars['submission']->getReviewAssignments(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['reviewAssignments']):
?>
				<?php $_from = $this->_tpl_vars['reviewAssignments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['assignmentList'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['assignmentList']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['assignment']):
        $this->_foreach['assignmentList']['iteration']++;
?>
					<?php if (! $this->_tpl_vars['assignment']->getCancelled()): ?>
					<tr valign="top">
						<td width="33%" style="padding: 0 4px 0 0; font-size: 1.0em"><?php if ($this->_tpl_vars['assignment']->getDateNotified()):  echo ((is_array($_tmp=$this->_tpl_vars['assignment']->getDateNotified())) ? $this->_run_mod_handler('date_format', true, $_tmp, $this->_tpl_vars['dateFormatTrunc']) : smarty_modifier_date_format($_tmp, $this->_tpl_vars['dateFormatTrunc']));  else: ?>&mdash;<?php endif; ?></td>
						<td width="33%" style="padding: 0 4px 0 0; font-size: 1.0em"><?php if ($this->_tpl_vars['assignment']->getDateCompleted() || ! $this->_tpl_vars['assignment']->getDateConfirmed()): ?>&mdash;<?php else:  echo $this->_tpl_vars['assignment']->getWeeksDue();  endif; ?></td>
						<td width="34%" style="padding: 0 4px 0 0; font-size: 1.0em"><?php if ($this->_tpl_vars['assignment']->getDateCompleted()):  echo ((is_array($_tmp=$this->_tpl_vars['assignment']->getDateCompleted())) ? $this->_run_mod_handler('date_format', true, $_tmp, $this->_tpl_vars['dateFormatTrunc']) : smarty_modifier_date_format($_tmp, $this->_tpl_vars['dateFormatTrunc']));  else: ?>&mdash;<?php endif; ?></td>
					</tr>
					<?php endif; ?>
				<?php endforeach; else: ?>
				<tr valign="top">
					<td width="33%" style="padding: 0 4px 0 0; font-size: 1.0em">&mdash;</td>
					<td width="33%" style="padding: 0 4px 0 0; font-size: 1.0em">&mdash;</td>
					<td width="34%" style="padding: 0 0 0 0; font-size: 1.0em">&mdash;</td>
				</tr>
				<?php endif; unset($_from); ?>
			<?php endforeach; else: ?>
				<tr valign="top">
					<td width="33%" style="padding: 0 4px 0 0; font-size: 1.0em">&mdash;</td>
					<td width="33%" style="padding: 0 4px 0 0; font-size: 1.0em">&mdash;</td>
					<td width="34%" style="padding: 0 0 0 0; font-size: 1.0em">&mdash;</td>
				</tr>
			<?php endif; unset($_from); ?>
			</table>
		</td>
		<td>
			<?php $_from = $this->_tpl_vars['submission']->getDecisions(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['decisions']):
?>
				<?php $_from = $this->_tpl_vars['decisions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['decisionList'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['decisionList']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['decision']):
        $this->_foreach['decisionList']['iteration']++;
?>
					<?php if (($this->_foreach['decisionList']['iteration'] == $this->_foreach['decisionList']['total'])): ?>
							<?php echo ((is_array($_tmp=$this->_tpl_vars['decision']['dateDecided'])) ? $this->_run_mod_handler('date_format', true, $_tmp, $this->_tpl_vars['dateFormatTrunc']) : smarty_modifier_date_format($_tmp, $this->_tpl_vars['dateFormatTrunc'])); ?>
				
					<?php endif; ?>
				<?php endforeach; else: ?>
					&mdash;
				<?php endif; unset($_from); ?>
			<?php endforeach; else: ?>
				&mdash;
			<?php endif; unset($_from); ?>
		</td>
		<td>
			<?php $this->assign('editAssignments', $this->_tpl_vars['submission']->getEditAssignments()); ?>
			<?php $_from = $this->_tpl_vars['editAssignments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['editAssignment']):
 echo ((is_array($_tmp=$this->_tpl_vars['editAssignment']->getEditorInitials())) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 <?php endforeach; endif; unset($_from); ?>
		</td>
	</tr>
	<tr>
		<td colspan="8" class="<?php if ($this->_tpl_vars['submissions']->eof()): ?>end<?php endif; ?>separator">&nbsp;</td>
	</tr>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['iterate'][0][0]->smartyIterate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  if ($this->_tpl_vars['submissions']->wasEmpty()): ?>
	<tr>
		<td colspan="8" class="nodata"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "submissions.noSubmissions"), $this);?>
</td>
	</tr>
	<tr>
		<td colspan="8" class="endseparator">&nbsp;</td>
	</tr>
<?php else: ?>
	<tr>
		<td colspan="5" align="left"><?php echo $this->_plugins['function']['page_info'][0][0]->smartyPageInfo(array('iterator' => $this->_tpl_vars['submissions']), $this);?>
</td>
		<td colspan="3" align="right"><?php echo $this->_plugins['function']['page_links'][0][0]->smartyPageLinks(array('name' => 'submissions','iterator' => $this->_tpl_vars['submissions'],'searchField' => $this->_tpl_vars['searchField'],'searchMatch' => $this->_tpl_vars['searchMatch'],'search' => $this->_tpl_vars['search'],'dateFromDay' => $this->_tpl_vars['dateFromDay'],'dateFromYear' => $this->_tpl_vars['dateFromYear'],'dateFromMonth' => $this->_tpl_vars['dateFromMonth'],'dateToDay' => $this->_tpl_vars['dateToDay'],'dateToYear' => $this->_tpl_vars['dateToYear'],'dateToMonth' => $this->_tpl_vars['dateToMonth'],'section' => $this->_tpl_vars['section']), $this);?>
</td>
	</tr>
<?php endif; ?>
</table>