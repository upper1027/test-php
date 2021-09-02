<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Exception;

class CloseOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected int $flag;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(int $flag)
    {
        $this->flag = $flag;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Db::beginTransaction();
        try {
            $data = ['正常情况', '异常情况'];
            $user = new User;
            $user->user_name = $data[$this->flag];
            $user->password = $data[$this->flag];
            $user->mobile = $data[$this->flag];
            $user->save();
            if ($this->flag) {
                throw new Exception('异常');
            }
            Db::commit();
        } catch (\Throwable $e) {
 //           Db::rollBack();
        }
    }
}
