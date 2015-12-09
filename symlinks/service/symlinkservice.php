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

namespace OCA\SymLinks\Service;

use Exception;
use \OCP\AppFramework\Http\JSONResponse;

class SymLinkService {

	public function __construct(){
	}

	private function handleException ($e) {
		if ($e instanceof DoesNotExistException ||
			$e instanceof MultipleObjectsReturnedException) {
			throw new NotFoundException($e->getMessage());
		} else {
			throw $e;
		}
	}

	private function notImplemented() {
		$params = array('error' => 'not implemented');
		return new JSONResponse($params);
	}

	private function resultReturn($result, $message) {
		$params = array('result' => $result, 'message' => $message);
		return new JSONResponse($params);
	}

	public function find($oclink) {
		$link = \OC\Files\Filesystem::getLocalFile($oclink);
		$result = "";
		$message = "";
		try {
			if(file_exists($link)) {
				if(is_link($link)) {
					$result = "ok";
					$message = "$link exists";
				} else {
					$result = "fail";
					$message = "$link exists but is not a symlink";
				}
			} else {
				$result = "fail";
				$message = "$link does not exist";
			}
			return $this->resultReturn($result, $message);
		} catch(Exception $e) {
			$this->handleException($e);
		}
	}

	public function create($ocsource, $oclink) {
		$source = \OC\Files\Filesystem::getLocalFile($ocsource);
		$link = \OC\Files\Filesystem::getLocalFile($oclink);
		$result = "";
		$message = "";
		try {
			if (!file_exists($source)) {
			$result = "fail";
			$message = "$source does not exist";
			} elseif(file_exists($link)) {
				$result = "fail";
				$message = "link exists";
			} else {
				symlink($source, $link);
				if (file_exists($link)) {
					$result = "ok";
					$message = "link made";
				} else {
					$result = "fail";
					$message = "link failed";
				}
			}
			return $this->resultReturn($result, $message);
		} catch(Exception $e) {
			$this->handleException($e);
		}
	}

	public function update($ocsource, $oclink) {
		$source = \OC\Files\Filesystem::getLocalFile($ocsource);
		$link = \OC\Files\Filesystem::getLocalFile($oclink);
		try {
			return $this->notImplemented();
		} catch(Exception $e) {
			$this->handleException($e);
		}
	}

	public function delete($oclink) {
		$link = \OC\Files\Filesystem::getLocalFile($oclink);
		$result = "";
		$message = "";
		try {
			if(file_exists($link)) {
				if(is_link($link)) {
					unlink($link);
					$result = "ok";
					$message = "$link deleted";
				} else {
					$result = "fail";
					$message = "$link exists but not symbolic link";
				}
			} else {
				$result = "fail";
				$message = "$link does not exist";
			}
			return $this->resultReturn($result, $message);
		} catch(Exception $e) {
			$this->handleException($e);
		}
	}

}
