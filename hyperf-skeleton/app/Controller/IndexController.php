<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace App\Controller;

use App\Job\TestJob;
use Hyperf\AsyncQueue\Driver\DriverFactory;
use Hyperf\Utils\ApplicationContext;

class IndexController extends AbstractController
{
    public function index()
    {
        $container = ApplicationContext::getContainer();

        $driver = $container->get(DriverFactory::class)->get('default');

        $driver->push(new TestJob(1));
        sleep(1);
        $driver->push(new TestJob(0));

        return true;
    }
}
