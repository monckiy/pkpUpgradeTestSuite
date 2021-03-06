<?php

/**
 * ArticleDAO.inc.php
 *
 * Copyright (c) 2003-2004 The Public Knowledge Project
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @package article
 *
 * Class for Article DAO.
 * Operations for retrieving and modifying Article objects.
 *
 * $Id: ArticleDAO.inc.php,v 1.24 2005/05/11 18:07:55 alec Exp $
 */

import('article.Article');

class ArticleDAO extends DAO {

	var $authorDao;

	/**
	 * Constructor.
	 */
	function ArticleDAO() {
		parent::DAO();
		$this->authorDao = DAORegistry::getDAO('AuthorDAO');
	}
	
	/**
	 * Retrieve an article by ID.
	 * @param $articleId int
	 * @return Article
	 */
	function &getArticle($articleId) {
		$result = &$this->retrieve(
			'SELECT a.*, s.title AS section_title FROM articles a LEFT JOIN sections s ON s.section_id = a.section_id WHERE article_id = ?', $articleId
		);
		
		if ($result->RecordCount() == 0) {
			return null;
			
		} else {
			return $this->_returnArticleFromRow($result->GetRowAssoc(false));
		}
	}
	
	/**
	 * Internal function to return an Article object from a row.
	 * @param $row array
	 * @return Article
	 */
	function &_returnArticleFromRow(&$row) {
		$article = &new Article();
		$this->_articleFromRow($article, $row);
		return $article;
	}
	
	/**
	 * Internal function to fill in the passed article object from the row.
	 * @param $article Article output article
	 * @param $row array input row
	 */
	function _articleFromRow(&$article, &$row) {
		$article->setArticleId($row['article_id']);
		$article->setUserId($row['user_id']);
		$article->setJournalId($row['journal_id']);
		$article->setSectionId($row['section_id']);
		$article->setSectionTitle($row['section_title']);
		$article->setTitle($row['title']);
		$article->setTitleAlt1($row['title_alt1']);
		$article->setTitleAlt2($row['title_alt2']);
		$article->setAbstract($row['abstract']);
		$article->setAbstractAlt1($row['abstract_alt1']);
		$article->setAbstractAlt2($row['abstract_alt2']);
		$article->setDiscipline($row['discipline']);
		$article->setSubjectClass($row['subject_class']);
		$article->setSubject($row['subject']);
		$article->setCoverageGeo($row['coverage_geo']);
		$article->setCoverageChron($row['coverage_chron']);
		$article->setCoverageSample($row['coverage_sample']);
		$article->setType($row['type']);
		$article->setLanguage($row['language']);
		$article->setSponsor($row['sponsor']);
		$article->setCommentsToEditor($row['comments_to_ed']);
		$article->setDateSubmitted($row['date_submitted']);
		$article->setDateStatusModified($row['date_status_modified']);
		$article->setLastModified($row['last_modified']);
		$article->setStatus($row['status']);
		$article->setSubmissionProgress($row['submission_progress']);
		$article->setCurrentRound($row['current_round']);
		$article->setSubmissionFileId($row['submission_file_id']);
		$article->setRevisedFileId($row['revised_file_id']);
		$article->setReviewFileId($row['review_file_id']);
		$article->setEditorFileId($row['editor_file_id']);
		$article->setCopyeditFileId($row['copyedit_file_id']);
		$article->setPages($row['pages']);
		
		$article->setAuthors($this->authorDao->getAuthorsByArticle($row['article_id']));
	}

	/**
	 * Insert a new Article.
	 * @param $article Article
	 */	
	function insertArticle(&$article) {
		$article->stampModified();
		$this->update(
			'INSERT INTO articles
				(user_id, journal_id, section_id, title, title_alt1, title_alt2, abstract, abstract_alt1, abstract_alt2, discipline, subject_class, subject, coverage_geo, coverage_chron, coverage_sample, type, language, sponsor, comments_to_ed, date_submitted, date_status_modified, last_modified, status, submission_progress, current_round, submission_file_id, revised_file_id, review_file_id, editor_file_id, copyedit_file_id, pages)
				VALUES
				(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
			array(
				$article->getUserId(),
				$article->getJournalId(),
				$article->getSectionId(),
				$article->getTitle() === null ? '' : $article->getTitle(),
				$article->getTitleAlt1(),
				$article->getTitleAlt2(),
				$article->getAbstract(),
				$article->getAbstractAlt1(),
				$article->getAbstractAlt2(),
				$article->getDiscipline(),
				$article->getSubjectClass(),
				$article->getSubject(),
				$article->getCoverageGeo(),
				$article->getCoverageChron(),
				$article->getCoverageSample(),
				$article->getType(),
				$article->getLanguage(),
				$article->getSponsor(),
				$article->getCommentsToEditor(),
				$article->getDateSubmitted(),
				$article->getDateStatusModified(),
				$article->getLastModified(),
				$article->getStatus() === null ? STATUS_QUEUED : $article->getStatus(),
				$article->getSubmissionProgress() === null ? 1 : $article->getSubmissionProgress(),
				$article->getCurrentRound() === null ? 1 : $article->getSubmissionProgress(),
				$article->getSubmissionFileId(),
				$article->getRevisedFileId(),
				$article->getReviewFileId(),
				$article->getEditorFileId(),
				$article->getCopyeditFileId(),
				$article->getPages()
			)
		);
		
		$article->setArticleId($this->getInsertArticleId());
		
		// Insert authors for this article
		$authors = &$article->getAuthors();
		for ($i=0, $count=count($authors); $i < $count; $i++) {
			$authors[$i]->setArticleId($article->getArticleId());
			$this->authorDao->insertAuthor(&$authors[$i]);
		}
	}
	
	/**
	 * Update an existing article.
	 * @param $article Article
	 */
	function updateArticle(&$article) {
		$article->stampModified();
		$this->update(
			'UPDATE articles
				SET
					section_id = ?,
					title = ?,
					title_alt1 = ?,
					title_alt2 = ?,
					abstract = ?,
					abstract_alt1 = ?,
					abstract_alt2 = ?,
					discipline = ?,
					subject_class = ?,
					subject = ?,
					coverage_geo = ?,
					coverage_chron = ?,
					coverage_sample = ?,
					type = ?,
					language = ?,
					sponsor = ?,
					comments_to_ed = ?,
					date_submitted = ?,
					date_status_modified = ?,
					last_modified = ?,
					status = ?,
					submission_progress = ?,
					current_round = ?,
					submission_file_id = ?,
					revised_file_id = ?,
					review_file_id = ?,
					editor_file_id = ?,
					copyedit_file_id = ?,
					pages = ?
				WHERE article_id = ?',
			array(
				$article->getSectionId(),
				$article->getTitle(),
				$article->getTitleAlt1(),
				$article->getTitleAlt2(),
				$article->getAbstract(),
				$article->getAbstractAlt1(),
				$article->getAbstractAlt2(),
				$article->getDiscipline(),
				$article->getSubjectClass(),
				$article->getSubject(),
				$article->getCoverageGeo(),
				$article->getCoverageChron(),
				$article->getCoverageSample(),
				$article->getType(),
				$article->getLanguage(),
				$article->getSponsor(),
				$article->getCommentsToEditor(),
				$article->getDateSubmitted(),
				$article->getDateStatusModified(),
				$article->getLastModified(),
				$article->getStatus(),
				$article->getSubmissionProgress(),
				$article->getCurrentRound(),
				$article->getSubmissionFileId(),
				$article->getRevisedFileId(),
				$article->getReviewFileId(),
				$article->getEditorFileId(),
				$article->getCopyeditFileId(),
				$article->getPages(),
				$article->getArticleId()
			)
		);
		
		// update authors for this article
		$authors = &$article->getAuthors();
		for ($i=0, $count=count($authors); $i < $count; $i++) {
			if ($authors[$i]->getAuthorId() > 0) {
				$this->authorDao->updateAuthor(&$authors[$i]);
			} else {
				$this->authorDao->insertAuthor(&$authors[$i]);
			}
		}
		
		// Remove deleted authors
		$removedAuthors = $article->getRemovedAuthors();
		for ($i=0, $count=count($removedAuthors); $i < $count; $i++) {
			$this->authorDao->deleteAuthorById($removedAuthors[$i], $article->getArticleId());
		}
		
		// Update author sequence numbers
		$this->authorDao->resequenceAuthors($article->getArticleId());
	}
	
	/**
	 * Delete an article.
	 * @param $article Article
	 */
	function deleteArticle(&$article) {
		return $this->deleteArticleById($article->getArticleId());
	}
	
	/**
	 * Delete an article by ID.
	 * @param $articleId int
	 */
	function deleteArticleById($articleId) {
		$this->authorDao->deleteAuthorsByArticle($articleId);

		$publishedArticleDao = &DAORegistry::getDAO('PublishedArticleDAO');
		$publishedArticleDao->deletePublishedArticleByArticleId($articleId);

		$commentDao = &DAORegistry::getDAO('CommentDAO');
		$commentDao->deleteCommentsByArticle($articleId);

		$articleNoteDao = &DAORegistry::getDAO('ArticleNoteDAO');
		$articleNoteDao->clearAllArticleNotes($articleId);

		$sectionEditorSubmissionDao = &DAORegistry::getDAO('SectionEditorSubmissionDAO');
		$sectionEditorSubmissionDao->deleteDecisionsByArticle($articleId);
		$sectionEditorSubmissionDao->deleteReviewRoundsByArticle($articleId);

		$reviewAssignmentDao = &DAORegistry::getDAO('ReviewAssignmentDAO');
		$reviewAssignmentDao->deleteReviewAssignmentsByArticle($articleId);

		$editAssignmentDao = &DAORegistry::getDAO('EditAssignmentDAO');
		$editAssignmentDao->deleteEditAssignmentsByArticle($articleId);

		$copyAssignmentDao = &DAORegistry::getDAO('CopyAssignmentDAO');
		$copyAssignmentDao->deleteCopyAssignmentsByArticle($articleId);

		$layoutAssignmentDao = &DAORegistry::getDAO('LayoutAssignmentDAO');
		$layoutAssignmentDao->deleteLayoutAssignmentsByArticle($articleId);

		$proofAssignmentDao = &DAORegistry::getDAO('ProofAssignmentDAO');
		$proofAssignmentDao->deleteProofAssignmentsByArticle($articleId);

		$articleCommentDao = &DAORegistry::getDAO('ArticleCommentDAO');
		$articleCommentDao->deleteArticleComments($articleId);

		$articleGalleyDao = &DAORegistry::getDAO('ArticleGalleyDAO');
		$articleGalleyDao->deleteGalleysByArticle($articleId);

		$articleSearchDao = &DAORegistry::getDAO('ArticleSearchDAO');
		$articleSearchDao->deleteArticleKeywords($articleId);

		$articleEventLogDao = &DAORegistry::getDAO('ArticleEventLogDAO');
		$articleEventLogDao->deleteArticleLogEntries($articleId);

		$articleEmailLogDao = &DAORegistry::getDAO('ArticleEmailLogDAO');
		$articleEmailLogDao->deleteArticleLogEntries($articleId);

		$articleEventLogDao = &DAORegistry::getDAO('ArticleEventLogDAO');
		$articleEventLogDao->deleteArticleLogEntries($articleId);

		$suppFileDao = &DAORegistry::getDAO('SuppFileDAO');
		$suppFileDao->deleteSuppFilesByArticle($articleId);

		// Delete article files -- first from the filesystem, then from the database
		import('file.ArticleFileManager');
		$articleFileDao = &DAORegistry::getDAO('ArticleFileDAO');
		$articleFiles = &$articleFileDao->getArticleFilesByArticle($articleId);
	
		$articleFileManager = new ArticleFileManager($articleId);
		foreach ($articleFiles as $articleFile) {
			$articleFileManager->deleteFile($articleFile->getFileId());
		}

		$articleFileDao->deleteArticleFiles($articleId);

		$this->update(
			'DELETE FROM articles WHERE article_id = ?', $articleId
		);
	}
	
	/**
	 * Get all articles for a journal.
	 * @param $userId int
	 * @param $journalId int
	 * @return array Articles
	 */
	function &getArticlesByJournalId($journalId) {
		$articles = array();
		
		$result = &$this->retrieve(
			'SELECT a.*, s.title AS section_title FROM articles a LEFT JOIN sections s ON s.section_id = a.section_id WHERE a.journal_id = ?',
			$journalId
		);
		
		while (!$result->EOF) {
			$articles[] = $this->_returnArticleFromRow($result->GetRowAssoc(false));
			$result->MoveNext();
		}
		$result->Close();
		
		return $articles;
	}

	/**
	 * Delete all articles by journal ID.
	 * @param $journalId int
	 */
	function deleteArticlesByJournalId($journalId) {
		$articles = $this->getArticlesByJournalId($journalId);

		foreach ($articles as $article) {
			$this->deleteArticleById($article->getArticleId());
		}
	}

	/**
	 * Get all articles for a user.
	 * @param $userId int
	 * @param $journalId int
	 * @return array Articles
	 */
	function &getArticlesByUserId($userId, $journalId) {
		$articles = array();
		
		$result = &$this->retrieve(
			'SELECT a.*, s.title AS section_title FROM articles a LEFT JOIN sections s ON s.section_id = a.section_id WHERE a.user_id = ? AND a.journal_id = ?',
			array($userId, $journalId)
		);
		
		while (!$result->EOF) {
			$articles[] = $this->_returnArticleFromRow($result->GetRowAssoc(false));
			$result->MoveNext();
		}
		$result->Close();
		
		return $articles;
	}
	
	/**
	 * Get the ID of the journal an article is in.
	 * @param $articleId int
	 * @return int
	 */
	function &getArticleJournalId($articleId) {
		$result = &$this->retrieve(
			'SELECT journal_id FROM articles WHERE article_id = ?', $articleId
		);
		return isset($result->fields[0]) ? $result->fields[0] : false;
	}
	
	/**
	 * Check if the specified incomplete submission exists.
	 * @param $articleId int
	 * @param $userId int
	 * @param $journalId int
	 * @return int the submission progress
	 */
	function incompleteSubmissionExists($articleId, $userId, $journalId) {
		$result = &$this->retrieve(
			'SELECT submission_progress FROM articles WHERE article_id = ? AND user_id = ? AND journal_id = ? AND date_submitted IS NULL',
			array($articleId, $userId, $journalId)
		);
		return isset($result->fields[0]) ? $result->fields[0] : false;
	}

	/**
	 * Change the status of the article
	 * @param $articleId int
	 * @param $status int
	 */
	function changeArticleStatus($articleId, $status) {
		$this->update(
			'UPDATE articles SET status = ? WHERE article_id = ?', array($status, $articleId)
		);
	}
	
	/**
	 * Removes articles from a section by section ID
	 * @param $sectionId int
	 */
	function removeArticlesFromSection($sectionId) {
		$this->update(
			'UPDATE articles SET section_id = null WHERE section_id = ?', $sectionId
		);
	}
	
	/**
	 * Get the ID of the last inserted article.
	 * @return int
	 */
	function getInsertArticleId() {
		return $this->getInsertId('articles', 'article_id');
	}
	
}

?>
