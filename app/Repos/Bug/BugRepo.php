<?php

namespace App\Repos\Bug;

use App\Models\Bug;
use App\Models\User;

abstract class BugRepo
{
    /**
     * @var User
     */
    protected $user;

    /**
     * RDBugRepo constructor.
     * @param  User  $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public static function update(Bug $bug, $data)
    {
        $bug->fill($data);
        $bug->save();
        return $bug->refresh();
    }

    public static function create($data, int $userId)
    {
        return Bug::create([
            "summary" => $data['summary'],
            "description" => $data['description'],
            'created_user_id' => $userId,
            'status' => Bug::STATUS_PENDING,
        ]);
    }

    public static function getRepo(User $user)
    {
        if ($user->isRoleOf('RD')) {
            return new RDBugRepo($user);
        } elseif ($user->isRoleOf('QA')) {
            return new QABugRepo($user);
        }
    }

    abstract public function search(string $status);

    abstract protected function baseQuery();
}
