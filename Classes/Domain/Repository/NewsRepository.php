<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2010 Georg Ringer <typo3@ringerge.org>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

/**
 * News repository with all the callable functionality
 *
 * @package TYPO3
 * @subpackage tx_news2
 * @version $Id: NewsRepository.php 42183 2011-01-15 14:09:16Z just2b $
 */
class Tx_News2_Domain_Repository_NewsRepository extends Tx_News2_Domain_Repository_AbstractNewsRepository {

	/**
	 * List entries
	 */
	public function findList() {
		$query = $this->createQuery();

		$constraints = array();
		$constraints[] = $this->getArchiveRestriction($query);
		$constraints[] = $this->getCategoryRestriction($query);
		$constraints[] = $this->getAdditionalCategoryRestriction($query);
		$constraints[] = $this->getLatestTimeLimitRestriction($query);
		$constraints[] = $this->getTopNewsConstraint($query);
		$constraints[] = $this->setStoragePageRestriction($query);
//		$constraints[] = $this->setDebugConstraint($query);

		return $this->executeQuery($query, $constraints);
	}

    /**
     * @param  Tx_News2_Domain_Model_Search $searchobject
     * @return
     */
	public function findBySearch($searchobject) {
		$query = $this->createQuery();

		$constraints = array();
		$constraints[] = $this->getArchiveRestriction($query);
		$constraints[] = $this->getCategoryRestriction($query);
		$constraints[] = $this->getSearchConstraint($query, $searchobject);
		$constraints[] = $this->getTopNewsConstraint($query);
		$constraints[] = $this->setStoragePageRestriction($query);

		return $this->executeQuery($query, $constraints);
	}


	/**
	 * @todo: tests
	 */
	public function countByTest() {
		$query = $this->createQuery();

		$constraints = array();
		$constraints[] = $this->getArchiveRestriction($query);
		$constraints[] = $this->getCategoryRestriction($query);
		$constraints[] = $this->setStoragePageRestriction($query);
//		$constraints[] = $this->setDebugConstraint($query);

		return $this->executeCountQuery($query, $constraints);
	}
	
	/*
	 * find all News respecting archive restrictions
	 */
	public function findByArchiveRestrictions(){
		$query = $this->createQuery();
		
		$constraints = array();
		$constraints[] = $this->getArchiveRestriction($query);
		$constraints[] = $this->getCategoryRestriction($query);
		$constraints[] = $this->getLatestTimeLimitRestriction($query);
		$constraints[] = $this->setStoragePageRestriction($query);
		//$constraints[] = $this->setDebugConstraint($query);
		
		$constraints[] = $this->setOrder('datetime desc');
		
		return $this->executeQuery($query, $constraints);
	}
	
	/*
	 * find all News respecting archive restrictions
	 */
	public function findByMonth($start,$end){
		$query = $this->createQuery();
		
		$constraints = array();
		$constraints[] = $this->getArchiveRestriction($query);
		$constraints[] = $this->getCategoryRestriction($query);
		$constraints[] = $this->getLatestTimeLimitRestriction($query);
		$constraints[] = $this->setStoragePageRestriction($query);
		//$constraints[] = $this->setDebugConstraint($query);

		$constraints[] = $query->logicalAnd(
								$query->greaterThanOrEqual('datetime',$start),
								$query->lessThan('datetime',$end)
							);
		
		return $this->executeQuery($query, $constraints);
	}


}

?>