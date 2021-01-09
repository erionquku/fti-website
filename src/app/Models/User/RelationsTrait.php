<?php

namespace App\Models\User;

use App\Repositories\Classes\SessionRepository;

trait RelationsTrait
{
    public function sessions()
    {
        $this->sessions = (new SessionRepository())->findAllBy('user_id', $this->id);
    }

}