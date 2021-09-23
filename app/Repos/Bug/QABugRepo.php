<?php

namespace App\Repos\Bug;

use App\Models\Bug;

class QABugRepo extends BugRepo
{
    protected function baseQuery()
    {
        return Bug::where(['created_user_id' => $this->user->id]);
    }

    public function search(string $status)
    {
        return $this->baseQuery()->where(['status' => $status])->get();
    }
}
