<?php

/**
 * SubscriptionHandler.inc.php
 *
 * Copyright (c) 2003-2004 The Public Knowledge Project
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @package pages.manager
 *
 * Handle requests for subscription management functions. 
 *
 * $Id: SubscriptionHandler.inc.php,v 1.8 2005/08/09 00:55:08 alec Exp $
 */

class SubscriptionHandler extends ManagerHandler {

	/**
	 * Display a list of subscriptions for the current journal.
	 */
	function subscriptions() {
		parent::validate();
		SubscriptionHandler::setupTemplate();

		$journal = &Request::getJournal();
		$rangeInfo = &Handler::getRangeInfo('subscriptions');
		$subscriptionDao = &DAORegistry::getDAO('SubscriptionDAO');
		$subscriptions = &$subscriptionDao->getSubscriptionsByJournalId($journal->getJournalId(), $rangeInfo);

		$templateMgr = &TemplateManager::getManager();
		$templateMgr->assign('subscriptions', $subscriptions);
		$templateMgr->assign('helpTopicId', 'journal.managementPages.subscriptions');
		$templateMgr->display('manager/subscription/subscriptions.tpl');
	}

	/**
	 * Delete a subscription.
	 * @param $args array first parameter is the ID of the subscription to delete
	 */
	function deleteSubscription($args) {
		parent::validate();
		
		if (isset($args) && !empty($args)) {
			$journal = &Request::getJournal();
			$subscriptionId = (int) $args[0];
		
			$subscriptionDao = &DAORegistry::getDAO('SubscriptionDAO');

			// Ensure subscription is for this journal
			if ($subscriptionDao->getSubscriptionJournalId($subscriptionId) == $journal->getJournalId()) {
				$subscriptionDao->deleteSubscriptionById($subscriptionId);
			}
		}
		
		Request::redirect('manager/subscriptions');
	}

	/**
	 * Display form to edit a subscription.
	 * @param $args array optional, first parameter is the ID of the subscription to edit
	 */
	function editSubscription($args = array()) {
		parent::validate();
		SubscriptionHandler::setupTemplate();

		$journal = &Request::getJournal();
		$subscriptionId = !isset($args) || empty($args) ? null : (int) $args[0];
		$userId = Request::getUserVar('userId');
		$subscriptionDao = &DAORegistry::getDAO('SubscriptionDAO');

		// Ensure subscription is valid and for this journal
		if (($subscriptionId != null && $subscriptionDao->getSubscriptionJournalId($subscriptionId) == $journal->getJournalId()) || ($subscriptionId == null && $userId)) {
			import('manager.form.SubscriptionForm');

			$templateMgr = &TemplateManager::getManager();
			$templateMgr->append('pageHierarchy', array('manager/subscriptions', 'manager.subscriptions'));

			if ($subscriptionId == null) {
				$templateMgr->assign('subscriptionTitle', 'manager.subscriptions.createTitle');
			} else {
				$templateMgr->assign('subscriptionTitle', 'manager.subscriptions.editTitle');	
			}

			$subscriptionForm = &new SubscriptionForm($subscriptionId, $userId);
			$subscriptionForm->initData();
			$subscriptionForm->display();
		
		} else {
				Request::redirect('manager/subscriptions');
		}
	}

	/**
	 * Display form to create new subscription.
	 */
	function createSubscription() {
		SubscriptionHandler::editSubscription();
	}

	/**
	 * Display a list of users from which to choose a subscriber.
	 */
	function selectSubscriber() {
		parent::validate();
		$templateMgr = &TemplateManager::getManager();
		SubscriptionHandler::setupTemplate();
		$templateMgr->append('pageHierarchy', array('manager/subscriptions', 'manager.subscriptions'));

		$userDao = &DAORegistry::getDAO('UserDAO');

		$searchType = null;
		$searchMatch = null;
		$search = $searchQuery = Request::getUserVar('search');
		$searchInitial = Request::getUserVar('searchInitial');
		if (isset($search)) {
			$searchType = Request::getUserVar('searchField');
			$searchMatch = Request::getUserVar('searchMatch');
			
		} else if (isset($searchInitial)) {
			$searchInitial = String::strtoupper($searchInitial);
			$searchType = USER_FIELD_INITIAL;
			$search = $searchInitial;
		}

		$rangeInfo = Handler::getRangeInfo('users');

		$users = &$userDao->getUsersByField($searchType, $searchMatch, $search, true, $rangeInfo);
		
		$templateMgr->assign('searchField', $searchType);
		$templateMgr->assign('searchMatch', $searchMatch);
		$templateMgr->assign('search', $searchQuery);
		$templateMgr->assign('searchInitial', $searchInitial);

		$templateMgr->assign('fieldOptions', Array(
			USER_FIELD_FIRSTNAME => 'user.firstName',
			USER_FIELD_LASTNAME => 'user.lastName',
			USER_FIELD_USERNAME => 'user.username',
			USER_FIELD_EMAIL => 'user.email'
		));
		$templateMgr->assign_by_ref('users', $users);
		$templateMgr->assign('helpTopicId', 'journal.managementPages.subscriptions');
		$templateMgr->assign('subscriptionId', Request::getUserVar('subscriptionId'));
		$templateMgr->display('manager/subscription/users.tpl');
	}

	/**
	 * Save changes to a subscription.
	 */
	function updateSubscription() {
		parent::validate();
		
		import('manager.form.SubscriptionForm');
		
		$journal = &Request::getJournal();
		$subscriptionId = Request::getUserVar('subscriptionId') == null ? null : (int) Request::getUserVar('subscriptionId');
		$subscriptionDao = &DAORegistry::getDAO('SubscriptionDAO');

		if (($subscriptionId != null && $subscriptionDao->getSubscriptionJournalId($subscriptionId) == $journal->getJournalId()) || $subscriptionId == null) {

			$subscriptionForm = &new SubscriptionForm($subscriptionId);
			$subscriptionForm->readInputData();
			
			if ($subscriptionForm->validate()) {
				$subscriptionForm->execute();

				if (Request::getUserVar('createAnother')) {
					Request::redirect('manager/selectSubscriber?subscriptionCreated=1');
				} else {
					Request::redirect('manager/subscriptions');
				}
				
			} else {
				SubscriptionHandler::setupTemplate();

				$templateMgr = &TemplateManager::getManager();
				$templateMgr->append('pageHierarchy', array('manager/subscriptions', 'manager.subscriptions'));

				if ($subscriptionId == null) {
					$templateMgr->assign('subscriptionTitle', 'manager.subscriptions.createTitle');
				} else {
					$templateMgr->assign('subscriptionTitle', 'manager.subscriptions.editTitle');	
				}

				$subscriptionForm->display();
			}
			
		} else {
				Request::redirect('manager/subscriptions');
		}
	}

	/**
	 * Display a list of subscription types for the current journal.
	 */
	function subscriptionTypes() {
		parent::validate();
		SubscriptionHandler::setupTemplate(true);

		$journal = &Request::getJournal();
		$rangeInfo = &Handler::getRangeInfo('subscriptionTypes');
		$subscriptionTypeDao = &DAORegistry::getDAO('SubscriptionTypeDAO');
		$subscriptionTypes = &$subscriptionTypeDao->getSubscriptionTypesByJournalId($journal->getJournalId(), $rangeInfo);

		$templateMgr = &TemplateManager::getManager();
		$templateMgr->assign('subscriptionTypes', $subscriptionTypes);
		$templateMgr->assign('helpTopicId', 'journal.managementPages.subscriptions');

		$templateMgr->display('manager/subscription/subscriptionTypes.tpl');
	}

	/**
	 * Rearrange the order of subscription types.
	 */
	function moveSubscriptionType($args) {
		parent::validate();

		$subscriptionTypeId = isset($args[0])?$args[0]:0;
		$journal = &Request::getJournal();

		$subscriptionTypeDao = &DAORegistry::getDAO('SubscriptionTypeDAO');
		$subscriptionType = &$subscriptionTypeDao->getSubscriptionType($subscriptionTypeId);

		if ($subscriptionType && $subscriptionType->getJournalId() == $journal->getJournalId()) {
			$isDown = Request::getUserVar('dir')=='d';
			$subscriptionType->setSequence($subscriptionType->getSequence()+($isDown?1.5:-1.5));
			$subscriptionTypeDao->updateSubscriptionType($subscriptionType);
			$subscriptionTypeDao->resequenceSubscriptionTypes($subscriptionType->getJournalId());
		}

		Request::redirect('manager/subscriptionTypes');
	}

	/**
	 * Delete a subscription type.
	 * @param $args array first parameter is the ID of the subscription type to delete
	 */
	function deleteSubscriptionType($args) {
		parent::validate();
		
		if (isset($args) && !empty($args)) {
			$journal = &Request::getJournal();
			$subscriptionTypeId = (int) $args[0];
		
			$subscriptionTypeDao = &DAORegistry::getDAO('SubscriptionTypeDAO');

			// Ensure subscription type is for this journal
			if ($subscriptionTypeDao->getSubscriptionTypeJournalId($subscriptionTypeId) == $journal->getJournalId()) {
				$subscriptionTypeDao->deleteSubscriptionTypeById($subscriptionTypeId);
			}
		}
		
		Request::redirect('manager/subscriptionTypes');
	}

	/**
	 * Display form to edit a subscription type.
	 * @param $args array optional, first parameter is the ID of the subscription type to edit
	 */
	function editSubscriptionType($args = array()) {
		parent::validate();
		SubscriptionHandler::setupTemplate(true);

		$journal = &Request::getJournal();
		$subscriptionTypeId = !isset($args) || empty($args) ? null : (int) $args[0];
		$subscriptionTypeDao = &DAORegistry::getDAO('SubscriptionTypeDAO');

		// Ensure subscription type is valid and for this journal
		if (($subscriptionTypeId != null && $subscriptionTypeDao->getSubscriptionTypeJournalId($subscriptionTypeId) == $journal->getJournalId()) || $subscriptionTypeId == null) {

			import('manager.form.SubscriptionTypeForm');

			$templateMgr = &TemplateManager::getManager();
			$templateMgr->append('pageHierarchy', array('manager/subscriptionTypes', 'manager.subscriptionTypes'));

			if ($subscriptionTypeId == null) {
				$templateMgr->assign('subscriptionTypeTitle', 'manager.subscriptionTypes.createTitle');
			} else {
				$templateMgr->assign('subscriptionTypeTitle', 'manager.subscriptionTypes.editTitle');	
			}

			$subscriptionTypeForm = &new SubscriptionTypeForm($subscriptionTypeId);
			$subscriptionTypeForm->initData();
			$subscriptionTypeForm->display();
		
		} else {
				Request::redirect('manager/subscriptionTypes');
		}
	}

	/**
	 * Display form to create new subscription type.
	 */
	function createSubscriptionType() {
		SubscriptionHandler::editSubscriptionType();
	}

	/**
	 * Save changes to a subscription type.
	 */
	function updateSubscriptionType() {
		parent::validate();
		
		import('manager.form.SubscriptionTypeForm');
		
		$journal = &Request::getJournal();
		$subscriptionTypeId = Request::getUserVar('typeId') == null ? null : (int) Request::getUserVar('typeId');
		$subscriptionTypeDao = &DAORegistry::getDAO('SubscriptionTypeDAO');

		if (($subscriptionTypeId != null && $subscriptionTypeDao->getSubscriptionTypeJournalId($subscriptionTypeId) == $journal->getJournalId()) || $subscriptionTypeId == null) {

			$subscriptionTypeForm = &new SubscriptionTypeForm($subscriptionTypeId);
			$subscriptionTypeForm->readInputData();
			
			if ($subscriptionTypeForm->validate()) {
				$subscriptionTypeForm->execute();

				if (Request::getUserVar('createAnother')) {
					SubscriptionHandler::setupTemplate(true);

					$templateMgr = &TemplateManager::getManager();
					$templateMgr->append('pageHierarchy', array('manager/subscriptionTypes', 'manager.subscriptionTypes'));
					$templateMgr->assign('subscriptionTypeTitle', 'manager.subscriptionTypes.createTitle');
					$templateMgr->assign('subscriptionTypeCreated', '1');

					$subscriptionTypeForm = &new SubscriptionTypeForm($subscriptionTypeId);
					$subscriptionTypeForm->initData();
					$subscriptionTypeForm->display();
	
				} else {
					Request::redirect('manager/subscriptionTypes');
				}
				
			} else {
				SubscriptionHandler::setupTemplate(true);

				$templateMgr = &TemplateManager::getManager();
				$templateMgr->append('pageHierarchy', array('manager/subscriptionTypes', 'manager.subscriptionTypes'));

				if ($subscriptionTypeId == null) {
					$templateMgr->assign('subscriptionTypeTitle', 'manager.subscriptionTypes.createTitle');
				} else {
					$templateMgr->assign('subscriptionTypeTitle', 'manager.subscriptionTypes.editTitle');	
				}

				$subscriptionTypeForm->display();
			}
			
		} else {
				Request::redirect('manager/subscriptionTypes');
		}
	}
	
	function setupTemplate($subclass = false) {
		parent::setupTemplate(true);
		if ($subclass) {
			$templateMgr = &TemplateManager::getManager();
			$templateMgr->append('pageHierarchy', array('manager/subscriptions', 'manager.subscriptions'));
		}
	}

}

?>
