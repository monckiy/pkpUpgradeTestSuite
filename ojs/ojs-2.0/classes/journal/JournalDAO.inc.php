<?php

/**
 * JournalDAO.inc.php
 *
 * Copyright (c) 2003-2004 The Public Knowledge Project
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @package journal
 *
 * Class for Journal DAO.
 * Operations for retrieving and modifying Journal objects.
 *
 * $Id: JournalDAO.inc.php,v 1.12 2005/05/05 14:25:15 alec Exp $
 */

import ('journal.Journal');

class JournalDAO extends DAO {

	/**
	 * Constructor.
	 */
	function JournalDAO() {
		parent::DAO();
	}
	
	/**
	 * Retrieve a journal by ID.
	 * @param $journalId int
	 * @return Journal
	 */
	function &getJournal($journalId) {
		$result = &$this->retrieve(
			'SELECT * FROM journals WHERE journal_id = ?', $journalId
		);
		
		if ($result->RecordCount() == 0) {
			return null;
			
		} else {
			return $this->_returnJournalFromRow($result->GetRowAssoc(false));
		}
	}
	
	/**
	 * Retrieve a journal by path.
	 * @param $path string
	 * @return Journal
	 */
	function &getJournalByPath($path) {
		$result = &$this->retrieve(
			'SELECT * FROM journals WHERE path = ?', $path
		);
		
		if ($result->RecordCount() == 0) {
			return null;
			
		} else {
			return $this->_returnJournalFromRow($result->GetRowAssoc(false));
		}
	}
	
	/**
	 * Internal function to return a Journal object from a row.
	 * @param $row array
	 * @return Journal
	 */
	function &_returnJournalFromRow(&$row) {
		$journal = &new Journal();
		$journal->setJournalId($row['journal_id']);
		$journal->setTitle($row['title']);
		$journal->setDescription($row['description']);
		$journal->setPath($row['path']);
		$journal->setSequence($row['seq']);
		$journal->setEnabled($row['enabled']);
		
		return $journal;
	}

	/**
	 * Insert a new journal.
	 * @param $journal Journal
	 */	
	function insertJournal(&$journal) {
		return $this->update(
			'INSERT INTO journals
				(title, description, path, seq)
				VALUES
				(?, ?, ?, ?)',
			array(
				$journal->getTitle(),
				$journal->getDescription(),
				$journal->getPath(),
				$journal->getSequence() == null ? 0 : $journal->getSequence()
			)
		);
	}
	
	/**
	 * Update an existing journal.
	 * @param $journal Journal
	 */
	function updateJournal(&$journal) {
		return $this->update(
			'UPDATE journals
				SET
					title = ?,
					description = ?,
					path = ?,
					seq = ?,
					enabled = ?
				WHERE journal_id = ?',
			array(
				$journal->getTitle(),
				$journal->getDescription(),
				$journal->getPath(),
				$journal->getSequence(),
				$journal->getEnabled(),
				$journal->getJournalId()
			)
		);
	}
	
	/**
	 * Delete a journal, INCLUDING ALL DEPENDENT ITEMS.
	 * @param $journal Journal
	 */
	function deleteJournal(&$journal) {
		return $this->deleteJournalById($journal->getJournalId());
	}
	
	/**
	 * Delete a journal by ID, INCLUDING ALL DEPENDENT ITEMS.
	 * @param $journalId int
	 */
	function deleteJournalById($journalId) {
		$journalSettingsDao = &DAORegistry::getDAO('JournalSettingsDAO');
		$journalSettingsDao->deleteSettingsByJournal($journalId);

		$sectionDao = &DAORegistry::getDAO('SectionDAO');
		$sectionDao->deleteSectionsByJournal($journalId);

		$issueDao = &DAORegistry::getDAO('IssueDAO');
		$issueDao->deleteIssuesByJournal($journalId);

		$notificationStatusDao = &DAORegistry::getDAO('NotificationStatusDAO');
		$notificationStatusDao->deleteNotificationStatusByJournal($journalId);

		$emailTemplateDao = &DAORegistry::getDAO('EmailTemplateDAO');
		$emailTemplateDao->deleteEmailTemplatesByJournal($journalId);

		$rtDao = &DAORegistry::getDAO('RTDAO');
		$rtDao->deleteJournalRT($journalId);
		$rtDao->deleteVersionsByJournal($journalId);

		$subscriptionDao = &DAORegistry::getDAO('SubscriptionDAO');
		$subscriptionDao->deleteSubscriptionsByJournal($journalId);

		$articleDao = &DAORegistry::getDAO('ArticleDAO');
		$articleDao->deleteArticlesByJournalId($journalId);

		$roleDao = &DAORegistry::getDAO('RoleDAO');
		$roleDao->deleteRoleByJournalId($journalId);

		return $this->update(
			'DELETE FROM journals WHERE journal_id = ?', $journalId
		);
	}
	
	/**
	 * Retrieve all journals.
	 * @return DAOResultFactory containing matching journals
	 */
	function &getJournals($rangeInfo = null) {
		$result = &$this->retrieveRange(
			'SELECT * FROM journals ORDER BY seq',
			false, $rangeInfo
		);

		return new DAOResultFactory(&$result, $this, '_returnJournalFromRow');
	}
	
	/**
	 * Retrieve all enabled journals
	 * @return array Journals ordered by sequence
	 */
	 function &getEnabledJournals() 
	 {
		$result = &$this->retrieve(
			'SELECT * FROM journals WHERE enabled=1 ORDER BY seq'
		);
		
		return new DAOResultFactory(&$result, $this, '_returnJournalFromRow');
	}
	
	/**
	 * Retrieve the IDs and titles of all journals in an associative array.
	 * @return array
	 */
	function &getJournalTitles() {
		$journals = array();
		
		$result = &$this->retrieve(
			'SELECT journal_id, title FROM journals ORDER BY seq'
		);
		
		while (!$result->EOF) {
			$journalId = $result->fields[0];
			$journals[$journalId] = $result->fields[1];
			$result->moveNext();
		}
		$result->Close();
	
		return $journals;
	}
	
	/**
	* Retrieve enabled journal IDs and titles in an associative array
	* @return array
	*/
	function &getEnabledJournalTitles()
	{
		$journals = array();
		
		$result = &$this->retrieve(
			'SELECT journal_id, title FROM journals WHERE enabled=1 ORDER BY seq'
		);
		
		while (!$result->EOF) {
			$journalId = $result->fields[0];
			$journals[$journalId] = $result->fields[1];
			$result->moveNext();
		}
		$result->Close();
	
		return $journals;
	}
	
	/**
	 * Check if a journal exists with a specified path.
	 * @param $path the path of the journal
	 * @return boolean
	 */
	function journalExistsByPath($path) {
		$result = &$this->retrieve(
			'SELECT COUNT(*) FROM journals WHERE path = ?', $path
		);
		return isset($result->fields[0]) && $result->fields[0] == 1 ? true : false;
	}
	
	/**
	 * Sequentially renumber journals in their sequence order.
	 */
	function resequenceJournals() {
		$result = &$this->retrieve(
			'SELECT journal_id FROM journals ORDER BY seq'
		);
		
		for ($i=1; !$result->EOF; $i++) {
			list($journalId) = $result->fields;
			$this->update(
				'UPDATE journals SET seq = ? WHERE journal_id = ?',
				array(
					$i,
					$journalId
				)
			);
			
			$result->moveNext();
		}

		$result->close();
	}
	
	/**
	 * Get the ID of the last inserted journal.
	 * @return int
	 */
	function getInsertJournalId() {
		return $this->getInsertId('journals', 'journal_id');
	}
	
}

?>
