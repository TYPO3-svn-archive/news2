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
 * Tests for domain repository newsRepository
 *
 * @package TYPO3
 * @subpackage tx_news2
 * @version $Id$
 * @author Nikolas Hagelstein <nikolas.hagelstein@gmail.com>
 */
class Tx_News2_Tests_Unit_Domain_Repository_NewsRepositoryTest extends Tx_Extbase_Tests_Unit_BaseTestCase {

	/**
	 * dataProvider for  createCategoryConstraintCreatesRightJunctions
	 * @return array
	 */
	public function conjunctionNameProvider() {
		return array(
			'or' => array('or', Tx_Extbase_Persistence_QOM_LogicalOr, NULL),
			'notor' => array('notor', Tx_Extbase_Persistence_QOM_LogicalNot, Tx_Extbase_Persistence_QOM_LogicalOr),
			'notand' => array('notand', Tx_Extbase_Persistence_QOM_LogicalNot, Tx_Extbase_Persistence_QOM_LogicalAnd),
			'and' => array('and', Tx_Extbase_Persistence_QOM_LogicalAnd , NULL),
			'defaults to and' => array('', Tx_Extbase_Persistence_QOM_LogicalAnd , NULL));
	}

	/**
	 * @test
	 * @dataProvider conjunctionNameProvider
	 * @return void
	 */
	public function createCategoryConstraintCreatesRightJunctions($junctionName, $outerConstraintType, $innerConstraintType) {
		$newsRepository = $this->getAccessibleMock('Tx_News2_Domain_Repository_NewsRepository', array('dummy'));
		$query = $newsRepository->createQuery();

		$resultQuery = $newsRepository->_call('createCategoryConstraint', $query, array(1, 2), $junctionName);

		$this->assertType($outerConstraintType, $resultQuery);

		if ($innerConstraintType !== NULL) {
			$this->assertType($innerConstraintType, $resultQuery->getConstraint());
		}
	}
}
?>
