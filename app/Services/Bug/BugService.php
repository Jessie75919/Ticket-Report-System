<?php

namespace App\Services\Bug;

use App\Models\Bug;
use App\Repos\Bug\BugRepo;

class BugService
{
    public function mark(Bug $bug, string $status, int $userId)
    {
        switch ($status) {
            case Bug::STATUS_PENDING:
                return BugRepo::update($bug, ['resolved_user_id' => null, 'status' => $status]);
            case Bug::STATUS_PROCESSING:
                return BugRepo::update($bug, ['resolved_user_id' => $userId, 'status' => $status]);
            case Bug::STATUS_RESOLVED:
                return BugRepo::update($bug, [
                    'resolved_user_id' => $userId,
                    'resolved_at' => now(),
                    'status' => $status
                ]);
            default:
                throw new \Exception("Status is not recognized!!");
        }
    }
}
