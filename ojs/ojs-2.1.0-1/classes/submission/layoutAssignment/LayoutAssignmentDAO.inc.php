<?php

/**
 * LayoutAssignmentDAO.inc.php
 *
 * Copyright (c) 2003-2004 The Public Knowledge Project
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @package submission.layoutAssignment
 *
 * DAO class for layout editing assignments.
 *
 * $Id: LayoutAssignmentDAO.inc.php,v 1.11 2005/09/24 18:58:33 alec Exp $
 */

import('submission.layoutAssignment.LayoutAssignment');

class LayoutAssignmentDAO extends DAO {

	var $articleFileDao;

	/**
	 * Constructor.
	 */
	function LayoutAssignmentDAO() {
		parent::DAO();
		$this->articleFileDao = &DAORegistry::getDAO('ArticleFileDAO');
	}
	
	/**
	 * Retrieve a layout assignment by assignment ID.
	 * @param $layoutId int
	 * @return LayoutAssignment
	 */
	function &getLayoutAssignmentById($layoutId) {
		$result = &$this->retrieve(
			'SELECT l.*, u.first_name, u.last_name, u.email
				FROM layouted_assignments l
				LEFT JOIN users u ON (l.editor_id = u.user_id)
				WHERE layouted_id = ?',
			$layoutId
		);

		$returner = null;
		if ($result->RecordCount() != 0) {
			$returner = &$this->_returnLayoutAssignmentFromRow($result->GetRowAssoc(false));
		}

		$result->Close();
		unset($result);

		return $returner;
	}
	

	/**
	 * Retrieve the layout editing assignment for an article.
	 * @param $articleId int
	 * @return LayoutAssignment
	 */
	function &getLayoutAssignmentByArticleId($articleId) {
		$result = &$this->retrieve(
			'SELECT l.*, u.first_name, u.last_name, u.email
				FROM layouted_assignments l
				LEFT JOIN users u ON (l.editor_id = u.user_id)
				WHERE article_id = ?',
			$articleId
		);

		$returner = null;
		if ($result->RecordCount() != 0) {
			$returner = &$this->_returnLayoutAssignmentFromRow($result->GetRowAssoc(false));
		}

		$result->Close();
		unset($result);

		return $returner;
	}

	/**
	 * Internal function to return a layout assignment object from a row.
	 * @param $row array
	 * @return LayoutAssignment
	 */
	function &_returnLayoutAssignmentFromRow(&$row) {
		$layoutAssignment = &new LayoutAssignment();
		$layoutAssignment->setLayoutId($row['layouted_id']);
		$layoutAssignment->setArticleId($row['article_id']);
		$layoutAssignment->setEditorId($row['editor_id']);
		$layoutAssignment->setEditorFullName($row['first_name'].' '.$row['last_name']);
		$layoutAssignment->setEditorEmail($row['email']);
		$layoutAssignment->setDateNotified($this->datetimeFromDB($row['date_notified']));
		$layoutAssignment->setDateUnderway($this->datetimeFromDB($row['date_underway']));
		$layoutAssignment->setDateCompleted($this->datetimeFromDB($row['date_completed']));
		$layoutAssignment->setDateAcknowledged($this->datetimeFromDB($row['date_acknowledged']));
		$layoutAssignment->setLayoutFileId($row['layout_file_id']);
		
		if ($row['layout_file_id'] && $row['layout_file_id']) {
			$layoutAssignment->setLayoutFile($this->articleFileDao->getArticleFile($row['layout_file_id']));
		}
			
		HookRegistry::call('LayoutAssignmentDAO::_returnLayoutAssignmentFromRow', array(&$layoutAssignment, &$row));

		return $layoutAssignment;
	}
	
	/**
	 * Insert a new layout assignment.
	 * @param $layoutAssignment LayoutAssignment
	 */	
	function insertLayoutAssignment(&$layoutAssignment) {
		$this->update(
			sprintf('INSERT INTO layouted_assignments
				(article_id, editor_id, date_notified, date_underway, date_completed, date_acknowledged, layout_file_id)
				VALUES
				(?, ?, %s, %s, %s, %s, ?)',
				$this->datetimeToDB($layoutAssignment->getDateNotified()), $this->datetimeToDB($layoutAssignment->getDateUnderway()), $this->datetimeToDB($layoutAssignment->getDateCompleted()), $this->datetimeToDB($layoutAssignment->getDateAcknowledged())),
			array(
				$layoutAssignment->getArticleId(),
				$layoutAssignment->getEditorId(),
				$layoutAssignment->getLayoutFileId()
			)
		);
		
		$layoutAssignment->setLayoutId($this->getInsertLayoutId());
		return $layoutAssignment->getLayoutId();
	}
	
	/**
	 * Update an layout assignment.
	 * @param $layoutAssignment LayoutAssignment
	 */
	function updateLayoutAssignment(&$layoutAssignment) {
		return $this->update(
			sprintf('UPDATE layouted_assignments
				SET	article_id = ?,
					editor_id = ?,
					date_notified = %s,
					date_underway = %s,
					date_completed = %s,
					date_acknowledged = %s,
					layout_file_id = ?
				WHERE layouted_id = ?',
				$this->datetimeToDB($layoutAssignment->getDateNotified()), $this->datetimeToDB($layoutAssignment->getDateUnderway()), $this->datetimeToDB($layoutAssignment->getDateCompleted()), $this->datetimeToDB($layoutAssignment->getDateAcknowledged())),
			array(
				$layoutAssignment->getArticleId(),
				$layoutAssignment->getEditorId(),
				$layoutAssignment->getLayoutFileId(),
				$layoutAssignment->getLayoutId()
			)
		);
	}
	
	/**
	 * Delete layout assignment.
	 * @param $layoutId int
	 */
	function deleteLayoutAssignmentById($layoutId) {
		return $this->update(
			'DELETE FROM layouted_assignments WHERE layouted_id = ?',
			$layoutId
		);
	}
	
	/**
	 * Delete layout assignments by article.
	 * @param $articleId int
	 */
	function deleteLayoutAssignmentsByArticle($articleId) {
		return $this->update(
			'DELETE FROM layouted_assignments WHERE article_id = ?',
			$articleId
		);
	}

	/**
	 * Get the ID of the last inserted layout assignment.
	 * @return int
	 */
	function getInsertLayoutId() {
		return $this->getInsertId('layouted_assignments', 'layouted_id');
	}
	
}

?>
