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
 * Tests for domains model News
 *
 * @package TYPO3
 * @subpackage tx_news2
 * @author Georg Ringer <typo3@ringerge.org>
 * @author Nikolas Hagelstein <nikolas.hagelstein@gmail.com>
 */
class Tx_News2_Tests_Unit_Domain_Model_NewsTest extends Tx_Extbase_Tests_Unit_BaseTestCase {
	/**
	 * @var Tx_News2_Domain_Model_News
	 */
	protected $newsDomainModelInstance;

	/**
	 * Set up framework
	 *
	 * @return void
	 */
	protected function setUp() {
		$this->newsDomainModelInstance = $this->objectManager->get('Tx_News2_Domain_Model_News');
	}

	/**
	 * Test if title can be set
	 *
	 * @test
	 * @return void
	 */
	public function titleCanBeSet() {
		$title = 'News title';
		$this->newsDomainModelInstance->setTitle($title);
		$this->assertEquals($title, $this->newsDomainModelInstance->getTitle());
	}

	/**
	 * Test if teaser can be set
	 *
	 * @test
	 * @return void
	 */
	public function teaserCanBeSet() {
		$teaser = 'News teaser';
		$this->newsDomainModelInstance->setTeaser($teaser);
		$this->assertEquals($teaser, $this->newsDomainModelInstance->getTeaser());
	}

	/**
	 * Test if bodytext can be set
	 *
	 * @test
	 * @return void
	 */
	public function bodytextCanBeSet() {
		$bodytext = 'News bodytext';
		$this->newsDomainModelInstance->setBodytext($bodytext);
		$this->assertEquals($bodytext, $this->newsDomainModelInstance->getBodytext());
	}

	/**
	 * Test if datetime can be set
	 *
	 * @test
	 * @return void
	 */
	public function datetimeCanBeSet() {
		$datetime = new DateTime();
		$this->newsDomainModelInstance->setDatetime($datetime);
		$this->assertEquals($datetime, $this->newsDomainModelInstance->getDatetime());
	}

	/**
	 * Test if archive can be set
	 *
	 * @test
	 * @return void
	 */
	public function archiveCanBeSet() {
		$archive = new DateTime();
		$this->newsDomainModelInstance->setArchive($archive);
		$this->assertEquals($archive, $this->newsDomainModelInstance->getArchive());
	}

	/**
	 * Test if author can be set
	 *
	 * @test
	 * @return void
	 */
	public function authorCanBeSet() {
		$author = 'News author';
		$this->newsDomainModelInstance->setAuthor($author);
		$this->assertEquals($author, $this->newsDomainModelInstance->getAuthor());
	}

	/**
	 * Test if emailadr can be set
	 *
	 * @test
	 * @return void
	 */
	public function authorEmailCanBeSet() {
		$authorEmail = 'author@news.org';
		$this->newsDomainModelInstance->setAuthorEmail($authorEmail);
		$this->assertEquals($authorEmail, $this->newsDomainModelInstance->getAuthorEmail());
	}

	/**
	 * Test if type can be set
	 *
	 * @test
	 * @return void
	 */
	public function typeCanBeSet() {
		$type = 123;
		$this->newsDomainModelInstance->setType($type);
		$this->assertEquals($type, $this->newsDomainModelInstance->getType());
	}

	/**
	 * Test if keyword can be set
	 *
	 * @test
	 * @return void
	 */
	public function keywordsCanBeSet() {
		$keywords = 'news1 keyword, news2 keyword';
		$this->newsDomainModelInstance->setKeywords($keywords);
		$this->assertEquals($keywords, $this->newsDomainModelInstance->getKeywords());
	}

	/**
	 * Test if internalurl can be set
	 *
	 * @test
	 * @return void
	 */
	public function internalurlCanBeSet() {
		$internalurl = 'http://foo.org/';
		$this->newsDomainModelInstance->setInternalurl($internalurl);
		$this->assertEquals($internalurl, $this->newsDomainModelInstance->getInternalurl());
	}

	/**
	 * Test if externalurl can be set
	 *
	 * @test
	 * @return void
	 */
	public function externalurlCanBeSet() {
		$externalurl = 'http://bar.org/';
		$this->newsDomainModelInstance->setExternalurl($externalurl);
		$this->assertEquals($externalurl, $this->newsDomainModelInstance->getExternalurl());
	}

	/**
	 * Test if topnews can be set
	 *
	 * @test
	 * @return void
	 */
	public function isttopnewsCanBeSet() {
		$istopnews = TRUE;
		$this->newsDomainModelInstance->setIstopnews($istopnews);
		$this->assertEquals($istopnews, $this->newsDomainModelInstance->getIstopnews());
	}

	/**
	 * Test if editlock can be set
	 *
	 * @test
	 * @return void
	 */
	public function editlockCanBeSet() {
		$editlock = 2;
		$this->newsDomainModelInstance->setEditlock($editlock);
		$this->assertEquals($editlock, $this->newsDomainModelInstance->getEditlock());
	}

	/**
	 * Test if importid can be set
	 *
	 * @test
	 * @return void
	 */
	public function importIdCanBeSet() {
		$importId = 2;
		$this->newsDomainModelInstance->setImportId($importId);
		$this->assertEquals($importId, $this->newsDomainModelInstance->getImportId());
	}

	/**
	 * Test if importSource can be set
	 *
	 * @test
	 * @return void
	 */
	public function importSourceCanBeSet() {
		$importSource = 'test';
		$this->newsDomainModelInstance->setImportSource($importSource);
		$this->assertEquals($importSource, $this->newsDomainModelInstance->getImportSource());
	}

	/**
	 * Test if sorting can be set
	 *
	 * @test
	 * @return void
	 */
	public function sortingCanBeSet() {
		$sorting = 2;
		$this->newsDomainModelInstance->setSorting($sorting);
		$this->assertEquals($sorting, $this->newsDomainModelInstance->getSorting());
	}

	/**
	 * Test if tag can be set
	 *
	 * @test
	 * @return void
	 */
	public function tagsCanBeSet() {
		$tags = '123';
		$this->newsDomainModelInstance->setTags($tags);
		$this->assertEquals($tags, $this->newsDomainModelInstance->getTags());
	}

	/**
	 * Test if content elements can be set
	 *
	 * @test
	 * @return void
	 */
	public function contentElementsCanBeSet() {
		$ce = '12,34';
		$this->newsDomainModelInstance->setContentElements($ce);
		$this->assertEquals($ce, $this->newsDomainModelInstance->getContentElements());
	}

	/**
	 * Test if category can be set
	 *
	 * @test
	 * @return void
	 */
	public function categoryCanBeSet() {
		$categories = new Tx_Extbase_Persistence_ObjectStorage();
		$categories->attach('test');
		$this->newsDomainModelInstance->setCategories($categories);
		$this->assertEquals($categories, $this->newsDomainModelInstance->getCategories());
	}

	/**
	 * Test if media can be set
	 *
	 * @test
	 * @return void
	 */
	public function mediaCanBeSet() {
		$media = new Tx_Extbase_Persistence_ObjectStorage();
		$media->attach('test');
		$this->newsDomainModelInstance->setMedia($media);
		$this->assertEquals($media, $this->newsDomainModelInstance->getMedia());
	}

	/**
	 * Test if related can be set
	 *
	 * @test
	 * @return void
	 */
	public function relatedCanBeSet() {
		$related = new Tx_Extbase_Persistence_ObjectStorage();
		$related->attach('test');
		$this->newsDomainModelInstance->setRelated($related);
		$this->assertEquals($related, $this->newsDomainModelInstance->getRelated());
	}

	/**
	 * Test if related files can be set
	 *
	 * @test
	 * @return void
	 */
	public function relatedFilesCanBeSet() {
		$related = new Tx_Extbase_Persistence_ObjectStorage();
		$related->attach('test');
		$this->newsDomainModelInstance->setRelatedFiles($related);
		$this->assertEquals($related, $this->newsDomainModelInstance->getRelatedFiles());
	}

	/**
	 * Test if related links can be set
	 *
	 * @test
	 * @return void
	 */
	public function relatedLinksCanBeSet() {
		$related = new Tx_Extbase_Persistence_ObjectStorage();
		$related->attach('test');
		$this->newsDomainModelInstance->setRelatedLinks($related);
		$this->assertEquals($related, $this->newsDomainModelInstance->getRelatedLinks());
	}
}
?>