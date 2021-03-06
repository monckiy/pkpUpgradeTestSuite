<?php

/**
 * @file ReviewReportDAO.inc.php
 *
 * Copyright (c) 2003-2009 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 * 
 * @class ReviewReportDAO
 * @ingroup plugins_reports_review
 * @see ReviewReportPlugin
 *
 * @brief Review report DAO
 */

//$Id$


import('classes.article.ArticleComment');
import('db.DBRowIterator');

class ReviewReportDAO extends DAO {
	/**
	 * Get the review report data.
	 * @param $journalId int
	 * @return array
	 */
	function getReviewReport($journalId) {
		$primaryLocale = Locale::getPrimaryLocale();
		$locale = Locale::getLocale();

		$result =& $this->retrieve(
			'SELECT	article_id,
				comments,
				author_id
			FROM	article_comments
			WHERE	comment_type = ?',
			array(
				COMMENT_TYPE_PEER_REVIEW
			)
		);
		import('db.DBRowIterator');
		$commentsReturner = new DBRowIterator($result);

		$result =& $this->retrieve(
			'SELECT r.round AS round,
				COALESCE(asl.setting_value, aspl.setting_value) AS article,
				a.article_id AS articleId,
				u.user_id AS reviewerId,
				u.username AS reviewer,
				u.first_name AS firstName,
				u.middle_name AS middleName,
				u.last_name AS lastName,
				r.date_assigned AS dateAssigned,
				r.date_notified AS dateNotified,
				r.date_confirmed AS dateConfirmed,
				r.date_completed AS dateCompleted,
				r.date_reminded AS dateReminded,
				(r.declined=1) AS declined,
				(r.cancelled=1) AS cancelled,
				r.recommendation AS recommendation
			FROM	review_assignments r
				LEFT JOIN articles a ON r.article_id = a.article_id
				LEFT JOIN article_settings asl ON (a.article_id=asl.article_id AND asl.locale=? AND asl.setting_name=?)
				LEFT JOIN article_settings aspl ON (a.article_id=aspl.article_id AND aspl.locale=? AND aspl.setting_name=?),
				users u
			WHERE	u.user_id=r.reviewer_id AND a.journal_id= ?
			ORDER BY article',
			array(
				$locale,
				'title',
				$primaryLocale,
				'title',
				$journalId
			)
		);
		$reviewsReturner = new DBRowIterator($result);

		return array($commentsReturner, $reviewsReturner);
	}
}

?>
