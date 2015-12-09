<?php
/**
 * ownCloud - symlinks
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author Jeremy Smith <jeremy.smith@arkivum.com>
 * @copyright Arkivum Limited 2015
 */

namespace OCA\SymLinks\Controller;

use PHPUnit_Framework_TestCase;

use OCP\AppFramework\Http\TemplateResponse;


class SymLinksApiControllerTest extends PHPUnit_Framework_TestCase {

	private $controller;
	private $service;
	private $userId = 'john';
	private $source = '/tmp/one/hello.txt';
	private $link = '/tmp/two/hello.txt';

	public function setUp() {
		$this->request = $this->getMockBuilder('OCP\IRequest')->getMock();
		$this->service = $this->getMockBuilder('OCA\SymLinks\Service\SymLinkService')->getMock();
		$this->service = new \OCA\SymLinks\Service\SymLinkService();
		$this->controller = new SymLinkApiController(
			'symlinks', $this->request, $this->service, $this->userId
		);
	}


	public function testIndex() {
		$result = $this->controller->index();
		$this->assertEquals(['error' => 'not implemented'], $result->getData());
	}

	public function testUpdate() {
		$result = $this->controller->update($this->source, $this->link);
		$this->assertEquals(['error' => 'not implemented'], $result->getData());
	}

	public function testCreate() {
		$result = $this->controller->create($this->source, $this->link);
		$this->assertEquals(['result' => 'ok', 'message' => 'link made'], $result->getData());
	}

	public function testShow() {
		$result = $this->controller->show($this->link);
		$this->assertEquals(['result' => 'ok', 'message' => '/tmp/two/hello.txt exists'], $result->getData());
	}

	public function testDestroy() {
		$result = $this->controller->destroy($this->link);
		$this->assertEquals(['result' => 'ok', 'message' => '/tmp/two/hello.txt deleted'], $result->getData());
	}

}

