<?php

/**
 * @file classes/core/PKPProfiler.inc.php
 *
 * Copyright (c) 2000-2009 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class PKPProfiler
 * @ingroup core
 *
 * @brief Basic shell class used to wrap the PHP Quick Profiler Class
 */

// $Id: PKPProfiler.inc.php,v 1.3 2009/05/05 23:21:04 asmecher Exp $

ini_set('include_path', BASE_SYS_DIR . '/lib/pkp/lib/pqp/classes/' . ENV_SEPARATOR . ini_get('include_path'));
require_once('PhpQuickProfiler.php');

class PKPProfiler {

	/** @var $profiler object instance of the PQP profiler */
	var $profiler;

	/**
	 * Constructor.
	 */
	function PKPProfiler() {
		$this->profiler = new PhpQuickProfiler(PhpQuickProfiler::getMicroTime());
	}

	/**
	 * Gather information to be used to display profiling
	 * @return array of stored profiling information
	 */
	function getData() {
		$profiler =& $this->profiler;
		$profiler->db = new PKPDBProfiler();

		$profiler->gatherConsoleData();
		$profiler->gatherFileData();
		$profiler->gatherMemoryData();
		$profiler->gatherQueryData();
		$profiler->gatherSpeedData();

		return $profiler->output;
	}
}

class PKPDBProfiler {

	/** @var $queryCount property to wrap DB connection query count */
	var $queryCount;

	/**
	 * Constructor.
	 */
	function PKPDBProfiler() {
		$dbconn =& DBConnection::getInstance();

		$this->queryCount = $dbconn->getNumQueries();
		$this->queries =& Registry::get('queries', true, array());
	}
}
