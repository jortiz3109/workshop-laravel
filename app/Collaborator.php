<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Collaborator extends Model
{
    /**
     * Relationship between collaborator and role
     * @return BelongsTo
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Relationship between collaborator and city
     * @return BelongsTo
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function isEnabled(): bool
    {
        return is_null($this->disabled_at);
    }

    public function hasTasks(): bool
    {
        //@TODO refactor when tasks module is finished
        return false;
    }
}
