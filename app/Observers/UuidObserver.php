<?php

namespace App\Observers;

use Ramsey\Uuid\Uuid;

class UuidObserver
{
    public function creating($model)
    {
        $model->uuid = Uuid::uuid1();
    }
}
