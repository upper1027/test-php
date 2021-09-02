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
namespace App\Job;

use Exception;
use App\Model\User;
use Hyperf\AsyncQueue\Job;
use Hyperf\DbConnection\Db;

class TestJob extends Job
{
    public int $flag;

    public function __construct(int $flag)
    {
        $this->flag = $flag;
    }

    public function handle()
    {
        Db::beginTransaction();
        try {
            $data = ['正常情况', '异常情况'];
            $user = new User();
            $user->user_name = $data[$this->flag];
            $user->password = $data[$this->flag];
            $user->mobile = $data[$this->flag];
            $user->save();
            if ($this->flag) {
                throw new Exception('异常');
            }
        } catch (\Throwable $e) {
//            Db::rollBack();
        }
    }
}
