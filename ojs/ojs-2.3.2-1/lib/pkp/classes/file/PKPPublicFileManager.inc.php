<?php

/**
 * @file classes/file/PKPPublicFileManager.inc.php
 *
 * Copyright (c) 2003-2009 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class PKPPublicFileManager
 * @ingroup file
 *
 * @brief Wrapper class for uploading files to a site/journal's public directory.
 */

// $Id: PKPPublicFileManager.inc.php,v 1.1 2009/07/03 16:23:00 asmecher Exp $


import('file.FileManager');

class PKPPublicFileManager extends FileManager {

	/**
	 * Get the path to the site public files directory.
	 * @return string
	 */
	function getSiteFilesPath() {
		return Config::getVar('files', 'public_files_dir') . '/site';
	}

	/**
	 * Upload a file to the site's public directory.
	 * @param $fileName string the name of the file in the upload form
	 * @param $destFileName string the destination file name
	 * @return boolean
	 */
 	function uploadSiteFile($fileName, $destFileName) {
 		return $this->uploadFile($fileName, $this->getSiteFilesPath() . '/' . $destFileName);
 	}

 	/**
	 * Delete a file from the site's public directory.
 	 * @param $fileName string the target file name
	 * @return boolean
 	 */
 	function removeSiteFile($fileName) {
 		return $this->deleteFile($this->getSiteFilesPath() . '/' . $fileName);
 	}
}

?>
