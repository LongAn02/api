<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


/**
 *--------------------------------------------------------------------------
 *  Command Custom
 *---------------------------------------------------------------------------
 *
 * Save time when creating folders and assigning permissions for folders.
 *
 * This command can create Model, Controller, Request, Resource
 * and can pass in some parameters that match the creation directory.
 *
 * In the indispensable --module and --control statements,
 * --module... helps to initialize the common name,
 * --control=... is the directories to be created.
 *
 * Example : php artisan makeCommand --module=Post --control=c,m,rq,rs
 * Create App/Models/Post.php, App/Http/Controllers/PostController.php
 *        App/Requests/PostRequest, App/Resources/PostResource.php
 *
 * Example : php artisan makeCommand --module=Post --control=c --c_path=Api\
 * Create App/Http/Controllers/Api/PostController.php
 *
 * Example : php artisan makeCommand --module=Post --control=c --c_path=Api\ --api=true
 * Create App/Http/Controllers/Api/PostController.php
 *        <- PostController there are functions of api ->
 *
 */
Artisan::command('makeCommand {--module=} {--c_path=} {--m_path=} {--rq_path=} {--rs_path=} {--control=} {--api=} {--collection=}',
    function ($module, $c_path = '', $m_path = '', $rq_path = '', $rs_path = '', $control, $api = false, $collection = false) {
    $control = explode(',', $control);

    if(in_array('c', $control)) {
        $api = $api ? '--api' : '';
        $controller = isset($c_path) ? $c_path . $module : $module;
        Artisan::call("make:controller {$controller}Controller {$api}");
    }

    if(in_array('m', $control)) {
        $model = isset($m_path) ? $m_path . $module : $module;
        Artisan::call("make:model {$model}");
    }

    if (in_array('rq', $control)) {
        $request = isset($rq_path) ? $rq_path . $module : $module;
        Artisan::call("make:request {$request}Request");
    }

    if (in_array('rs', $control)) {
        $collection = $collection ? '--collection' : '';
        $resource = isset($rs_path) ? $rs_path . $module : $module;
        Artisan::call("make:resource {$resource}Resource {$collection}");
    }

})->describe('Create folder MC');

