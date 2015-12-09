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

use Closure;

use OCP\AppFramework\Http;
use OCP\AppFramework\Http\DataResponse;

use OCA\SymLinks\Service\NotFoundException;


trait Errors {

	protected function handleNotFound (Closure $callback) {
		try {
			return new DataResponse($callback());
		} catch(NotFoundException $e) {
			$message = ['message' => $e->getMessage()];
			return new DataResponse($message, Http::STATUS_NOT_FOUND);
		}
	}

}
