<?php
/**
 * ownCloud - symlinks
 * API Controller
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author Jeremy Smith <jeremy.smith@arkivum.com>
 * @copyright Arkivum Limited 2015
 */

namespace OCA\SymLinks\Controller;

use OCP\IRequest;
use OCP\AppFramework\Http\DataResponse;
use OCP\AppFramework\ApiController;

use OCA\SymLinks\Service\SymLinkService;
use \OCP\AppFramework\Http\JSONResponse;

class SymLinkApiController extends ApiController {

	use Errors;

	/** @var NotesService */
	private $service;
	/** @var string */
	private $userId;
	private $AppName;

	private function notImplemented() {
		$params = array('error' => 'not implemented');
		return new JSONResponse($params);
	}

	public function __construct($AppName, IRequest $request,
								SymLinkService $service, $UserId){
		parent::__construct(
								$AppName,
								$request
							);
								// Can add the following to the above constructor if you
								// want to force these options
								//'PUT, POST, GET, DELETE, PATCH',
								//'Authorization, Content-Type, Accept',
								//1728000
		$this->service = $service;
		$this->userId = $UserId;
		$this->AppName = $AppName;
	}

	/**
	 * @CORS
	 * @NoCSRFRequired
	 * @NoAdminRequired
	 */
	public function index() {
	/*
	 * This would give a list of links
	 * but not implemented
	 */
		\OC_Log::write($this->AppName,"function index",\OC_Log::WARN);
		return $this->notImplemented();
	}

	/**
	 * @CORS
	 * @NoCSRFRequired
	 * @NoAdminRequired
	 *
	 * @param string $link
	 */
	public function show($link) {
	/*
	 * See if a symlink exists
	 */
		\OC_Log::write($this->AppName,"function show link is $link",\OC_Log::WARN);
		return $this->service->find($link);
	}

	/**
	 * @CORS
	 * @NoCSRFRequired
	 * @NoAdminRequired
	 *
	 * @param string $source
	 * @param string $link
	 */
	public function create($source, $link) {
		/*
		 * This create a symlink
		 */
		\OC_Log::write($this->AppName,"function create source is $source link is $link",\OC_Log::WARN);
		return $this->service->create($source, $link);
	}

	/**
	 * @CORS
	 * @NoCSRFRequired
	 * @NoAdminRequired
	 *
	 * @param string $source
	 * @param string $link
	 */
	public function update($source, $link) {
	/*
	 * Symlinks do not have any update capability
	 * so not implemented
	 */
		return $this->notImplemented();
	}

	/**
	 * @CORS
	 * @NoCSRFRequired
	 * @NoAdminRequired
	 *
	 * @param string $link
	 */
	public function destroy($link) {
	/*
	 * Remove a symlink
	 */
		\OC_Log::write($this->AppName,"function delete link is $link",\OC_Log::WARN);
		return $this->service->delete($link);
	}

}

