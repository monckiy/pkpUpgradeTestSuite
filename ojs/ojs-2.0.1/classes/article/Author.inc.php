<?php

/**
 * Author.inc.php
 *
 * Copyright (c) 2003-2004 The Public Knowledge Project
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @package article
 *
 * Article author metadata class.
 *
 * $Id: Author.inc.php,v 1.2 2004/06/26 21:28:45 kevin Exp $
 */

class Author extends DataObject {

	/**
	 * Constructor.
	 */
	function Author() {
		parent::DataObject();
		$this->setAuthorId(0);
	}
	
	/**
	 * Get the author's complete name.
	 * Includes first name, middle name (if applicable), and last name.
	 * @return string
	 */
	function getFullName() {
		return $this->getData('firstName') . ' ' . ($this->getData('middleName') != '' ? $this->getData('middleName') . ' ' : '') . $this->getData('lastName');
	}
	
	//
	// Get/set methods
	//
	
	/**
	 * Get ID of author.
	 * @return int
	 */
	function getAuthorId() {
		return $this->getData('authorId');
	}
	
	/**
	 * Set ID of author.
	 * @param $authorId int
	 */
	function setAuthorId($authorId) {
		return $this->setData('authorId', $authorId);
	}
	
	/**
	 * Get ID of article.
	 * @return int
	 */
	function getArticleId() {
		return $this->getData('articleId');
	}
	
	/**
	 * Set ID of article.
	 * @param $articleId int
	 */
	function setArticleId($articleId) {
		return $this->setData('articleId', $articleId);
	}
		
	/**
	 * Get first name.
	 * @return string
	 */
	function getFirstName() {
		return $this->getData('firstName');
	}
	
	/**
	 * Set first name.
	 * @param $firstName string
	 */
	function setFirstName($firstName)
	{
		return $this->setData('firstName', $firstName);
	}
	
	/**
	 * Get middle name.
	 * @return string
	 */
	function getMiddleName() {
		return $this->getData('middleName');
	}
	
	/**
	 * Set middle name.
	 * @param $middleName string
	 */
	function setMiddleName($middleName) {
		return $this->setData('middleName', $middleName);
	}
	
	/**
	 * Get last name.
	 * @return string
	 */
	function getLastName() {
		return $this->getData('lastName');
	}
	
	/**
	 * Set last name.
	 * @param $lastName string
	 */
	function setLastName($lastName) {
		return $this->setData('lastName', $lastName);
	}
	
	/**
	 * Get affiliation (position, institution, etc.).
	 * @return string
	 */
	function getAffiliation() {
		return $this->getData('affiliation');
	}
	
	/**
	 * Set affiliation.
	 * @param $affiliation string
	 */
	function setAffiliation($affiliation) {
		return $this->setData('affiliation', $affiliation);
	}
	
	/**
	 * Get email address.
	 * @return string
	 */
	function getEmail() {
		return $this->getData('email');
	}
	
	/**
	 * Set email address.
	 * @param $email string
	 */
	function setEmail($email) {
		return $this->setData('email', $email);
	}
	
	/**
	 * Get author biography.
	 * @return string
	 */
	function getBiography() {
		return $this->getData('biography');
	}
	
	/**
	 * Set author biography.
	 * @param $biography string
	 */
	function setBiography($biography) {
		return $this->setData('biography', $biography);
	}
	
	/**
	 * Get primary contact.
	 * @return boolean
	 */
	function getPrimaryContact() {
		return $this->getData('primaryContact');
	}
	
	/**
	 * Set primary contact.
	 * @param $primaryContact boolean
	 */
	function setPrimaryContact($primaryContact) {
		return $this->setData('primaryContact', $primaryContact);
	}
	
	/**
	 * Get sequence of author in article's author list.
	 * @return float
	 */
	function getSequence() {
		return $this->getData('sequence');
	}
	
	/**
	 * Set sequence of author in article's author list.
	 * @param $sequence float
	 */
	function setSequence($sequence) {
		return $this->setData('sequence', $sequence);
	}
	
}

?>
