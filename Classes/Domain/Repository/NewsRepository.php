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
 * @version $Id$
 */
class Tx_News2_Domain_Repository_NewsRepository extends Tx_Extbase_Persistence_Repository  {

	protected function createCategoryConstraint($query, $categories, $conjunction) {
        $constraint = NULL;
		$categoryConstraints = array();

		foreach($categories as $category) {
			$categoryConstraints[] = $query->contains('category', $category);
		}

		switch($conjunction) {
			case 'or' :
				$constraint = $query->logicalOr($categoryConstraints );
				break;

			case 'notor' :
				$constraint =  $query->logicalNot($query->logicalOr($categoryConstraints));
				break;

			case 'notand' :
				$constraint = $query->logicalNot($query->logicalAnd($categoryConstraints));
				break;

			case 'and' :
			default:
				$constraint = $query->logicalAnd($categoryConstraints);
		}

		return $constraint;
	}

	protected function createConstraintsFromDemand($query, $demand) {
		$constraints = array();
		$constraints[] = $this->createCategoryConstraint($query, $demand->getCategories(), $demand->getCategorySetting());
		$constraints[] = $this->createCategoryConstraint($query, $demand->getAdditionalCategories(), $demand->getAdditionalCategorySetting());

		if ($demand->getArchiveSetting() == 'archived') {
			$constraints[] = $query->logicalAnd(
				$query->lessThan('archive', $GLOBALS['EXEC_TIME']),
				$query->greaterThan('archive', 0)
			);
		} elseif ($demand->getArchiveSetting() == 'active') {
			$constraints[] = $query->greaterThanOrEqual('archive', $GLOBALS['EXEC_TIME']);
		}

		if ($demand->getLatestTimeLimit() !== NULL) {
			$constraints[] = $query->greaterThanOrEqual(
				'datetime',
				$demand->getLatestTimeLimit()
			);
		}

		if ($demand->getTopNewsSetting() == 1) {
			$constraints[] = $query->equals('istopnews', 1);
		} elseif ($demand->getTopNewsSetting() == 2) {
			$constraints[] = $query->greaterThanOrEqual('istopnews', 0);
		}

		if ($demand->getStoragePage() != 0) {
			$pidList = t3lib_div::intExplode(',', $demand->getStoragePage(), TRUE);
			$constraints[]  = $query->in('pid', $pidList);
		}

		return $constraints;
	}

	protected function createOrderingsFromDemand($demand) {
		$orderings = array();
		if ($demand->getOrderRespectTopNews()) {
			$orderings['istopnews'] = Tx_Extbase_Persistence_QueryInterface::ORDER_DESCENDING;
		}

		$orderList = t3lib_div::trimExplode(',', $demand->getOrder(), TRUE);

		if (!empty($orderList)) {
				// go through every order statement
			foreach($orderList as $orderItem) {
				list($orderField, $ascDesc) = t3lib_div::trimExplode(' ', $orderItem, TRUE);
					// count == 1 means that no direction is given
				if ($ascDesc) {
					$orderings[$orderField] = ((strtolower($ascDesc) == 'desc') ?
						Tx_Extbase_Persistence_QueryInterface::ORDER_DESCENDING :
						Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING);
				} else {
					$orderings[$orderField] = Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING;
				}
			}
		}

		return $orderings;
	}

	public function findDemanded(Tx_News2_Domain_Model_NewsDemand $demand) {
		$query = $this->createQuery();

		if($constraints = $this->createConstraintsFromDemand($query, $demand)) {
        	$query->matching(
				$query->logicalAnd($constraints)
			);
		}

		if ($orderings = $this->createOrderingsFromDemand($demand)) {
			$query->setOrderings($orderings);
		}

		if ($demand->getLimit() != NULL) {
			$query->setLimit($demand->getLimit());
		}

		if ($demand->getOffset() != NULL) {
			$query->setOffset($demand->getOffset());
		}

		return $query->execute();
	}

	public function countDemanded(Tx_News2_Domain_Model_NewsDemand $demand) {
		$query = $this->createQuery();

		if($constraints = $this->createConstraintsFromDemand($query, $demand)) {
        	$query->matching(
				$query->logicalAnd($constraints)
			);
		}

		return $query->count();
	}

}

?>