<?php

/**
 * IssueHandler.inc.php
 *
 * Copyright (c) 2003-2004 The Public Knowledge Project
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @package pages.issue
 *
 * Handle requests for issue functions.
 *
 * $Id: IssueHandler.inc.php,v 1.17 2005/05/13 16:52:30 alec Exp $
 */

import ('issue.IssueAction');

class IssueHandler extends Handler {

	/**
	 * Display about index page.
	 */
	function index($args) {
		parent::validate();
		IssueHandler::current();
	}

	/**
	 * Display current issue page.
	 */
	function current($args) {
		parent::validate();

		$journal = &Request::getJournal();

		$issueDao = &DAORegistry::getDAO('IssueDAO');
		$issue = &$issueDao->getCurrentIssue($journal->getJournalId());

		$templateMgr = &TemplateManager::getManager();

		if ($issue != null) {
			$issueTitle = $issue->getIssueIdentification();
			$issueCrumbTitle = $issue->getIssueIdentification(false, true);

			$arg = isset($args[0]) ? $args[0] : '';
			$showToc = ($arg == 'showToc') ? true : false;

			if (!$showToc && $issue->getFileName() && $issue->getShowCoverPage()) {
				$templateMgr->assign('fileName', $issue->getFileName());
				$templateMgr->assign('originalFileName', $issue->getOriginalFileName());

				import('file.PublicFileManager');
				$publicFileManager = new PublicFileManager();
				$coverPagePath = Request::getBaseUrl() . '/';
				$coverPagePath .= $publicFileManager->getJournalFilesPath($journal->getJournalId()) . '/';
				$coverPagePath .= $issue->getFileName();
				$templateMgr->assign('coverPagePath', $coverPagePath);
				$showToc = false;
			} else {

				$publishedArticleDao = &DAORegistry::getDAO('PublishedArticleDAO');
				$publishedArticles = &$publishedArticleDao->getPublishedArticlesInSections($issue->getIssueId());
				$templateMgr->assign('publishedArticles', $publishedArticles);
				$issueTitle = $issueTitle;
				$showToc = true;
			}

			$templateMgr->assign('issue', $issue);
			$templateMgr->assign('showToc', $showToc);

			// Subscription Access
			import('issue.IssueAction');
			$templateMgr->assign('subscriptionRequired', IssueAction::subscriptionRequired($issue));
			$templateMgr->assign('subscribedUser', IssueAction::subscribedUser());
			$templateMgr->assign('subscribedDomain', IssueAction::subscribedDomain());

		} else {
			$issueCrumbTitle = Locale::translate('current.noCurrentIssue');
			$issueTitle = Locale::translate('current.noCurrentIssue');
		}

		$templateMgr->assign('issueCrumbTitle', $issueCrumbTitle);
		$templateMgr->assign('issueTitle', $issueTitle);
		$templateMgr->assign('pageHierarchy', array(array('issue/current', 'current.current')));
		$templateMgr->assign('helpTopicId', 'user.currentAndArchives');
		$templateMgr->display('issue/current.tpl');
	}

	/**
	 * Display issue view page.
	 */
	function view($args) {
		parent::validate();

		$issueId = isset($args[0]) ? $args[0] : 0;
		$showToc = isset($args[1]) ? $args[1] : '';

		$journal = &Request::getJournal();

		$issueDao = &DAORegistry::getDAO('IssueDAO');

		if ($journal->getSetting('enablePublicIssueId')) {
			$issue = $issueDao->getIssueByBestIssueId($issueId);
		} else {
			$issue = $issueDao->getIssueById($issueId);
		}

		$templateMgr = &TemplateManager::getManager();

		if (isset($issue) && $issue->getPublished() && $issue->getJournalId() == $journal->getJournalId()) {

			$issueTitle = $issue->getIssueIdentification();
			$issueCrumbTitle = $issue->getIssueIdentification(false, true);

			$showToc = ($showToc == 'showToc') ? true : false;

			if (!$showToc && $issue->getFileName() && $issue->getShowCoverPage()) {
				$templateMgr->assign('fileName', $issue->getFileName());
				$templateMgr->assign('originalFileName', $issue->getOriginalFileName());

				import('file.PublicFileManager');
				$publicFileManager = new PublicFileManager();
				$coverPagePath = Request::getBaseUrl() . '/';
				$coverPagePath .= $publicFileManager->getJournalFilesPath($journal->getJournalId()) . '/';
				$coverPagePath .= $issue->getFileName();
				$templateMgr->assign('coverPagePath', $coverPagePath);

				$showToc = false;
			} else {
				$publishedArticleDao = &DAORegistry::getDAO('PublishedArticleDAO');
				$publishedArticles = &$publishedArticleDao->getPublishedArticlesInSections($issue->getIssueId());

				$templateMgr->assign('publishedArticles', $publishedArticles);
				$showToc = true;
			}
			$templateMgr->assign('showToc', $showToc);
			$templateMgr->assign('issueId', $issueId);
			$templateMgr->assign('issue', $issue);

			// Subscription Access
			import('issue.IssueAction');
			$templateMgr->assign('subscriptionRequired', IssueAction::subscriptionRequired($issue));
			$templateMgr->assign('subscribedUser', IssueAction::subscribedUser());
			$templateMgr->assign('subscribedDomain', IssueAction::subscribedDomain());

		} else {
			$issueCrumbTitle = Locale::translate('archive.issueUnavailable');
			$issueTitle = Locale::translate('archive.issueUnavailable');
		}

		$templateMgr->assign('issueCrumbTitle', $issueCrumbTitle);
		$templateMgr->assign('issueTitle', $issueTitle);
		$templateMgr->assign('pageHierarchy', array(array('issue/archive', 'archive.archives')));
		$templateMgr->assign('helpTopicId', 'user.currentAndArchives');
		$templateMgr->display('issue/view.tpl');

	}

	/**
	 * Display the issue archive listings
	 */
	function archive() {
		parent::validate();

		$journal = &Request::getJournal();
		$issueDao = &DAORegistry::getDAO('IssueDAO');
		$rangeInfo = Handler::getRangeInfo('issues');

		$publishedIssuesIterator = $issueDao->getPublishedIssues($journal->getJournalId(), false, $rangeInfo);
		$publishedIssues = $publishedIssuesIterator->toArray();

		$issueGroups = array();
		foreach($publishedIssues as $issue) {
			$issueGroups[$issue->getYear()][] = $issue;
		}

		$templateMgr = &TemplateManager::getManager();
		$templateMgr->assign_by_ref('issueGroups', new ArrayItemIterator($issueGroups, $rangeInfo->getPage(), $rangeInfo->getCount()));
		$templateMgr->assign('helpTopicId', 'user.currentAndArchives');
		$templateMgr->display('issue/archive.tpl');
	}

}

?>
