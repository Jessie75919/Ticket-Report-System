<?php

namespace App\Repos\Bug;

use App\Models\Bug;

class RDBugRepo extends BugRepo
{
    public function search(string $status)
    {
        switch ($status) {
            case Bug::STATUS_PENDING:
                return Bug::where(['status' => $status])->get();
            case Bug::STATUS_PROCESSING:
            case Bug::STATUS_RESOLVED:
                return $this->baseQuery()->where(['status' => $status])->get();
            default:
                throw new \Exception("Status is not recognized!!");
        }
    }

    protected function baseQuery()
    {
        return Bug::where(['resolved_user_id' => $this->user->id]);
    }
}
