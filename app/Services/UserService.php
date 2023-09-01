<?php

namespace App\Services;

use App\Models\User;
use App\Traits\SortTrait;
use App\Traits\PaginationTrait;

class UserService
{
    use PaginationTrait, SortTrait;

    private $userObj;

    public function __construct(User $userObj)
    {
        $this->userObj = $userObj;
    }

    public function resource($id, $inputs = null)
    {
        $user = $this->userObj->select(isset($inputs['select']) ? $inputs['select'] : '*')->where("id", $id);

        if (isset($inputs['with'])) {
            $user = $user->with($inputs['with']);
        }

        return $user->firstOrFail();
    }
}
