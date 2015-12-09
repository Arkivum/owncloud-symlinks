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

return ['routes' => [
    // page
    ['name' => 'page#index', 'url' => '/', 'verb' => 'GET'],
    // api
    ['name' => 'symlinkapi#show', 'url' => '/api/0.1/symlinks', 'verb' => 'GET'],
    ['name' => 'symlinkapi#create', 'url' => '/api/0.1/symlinks', 'verb' => 'POST'],
    ['name' => 'symlinkapi#update', 'url' => '/api/0.1/symlinks/{link}', 'verb' => 'PUT'],
    ['name' => 'symlinkapi#destroy', 'url' => '/api/0.1/symlinks', 'verb' => 'DELETE'],
    ['name' => 'symlinkapi#preflighted_cors', 'url' => '/api/0.1/{path}',
     'verb' => 'OPTIONS', 'requirements' => ['path' => '.+']],
]];
