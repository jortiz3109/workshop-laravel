<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    /**
     * Relationship between role and collaborator
     * @return HasMany
     */
    public function collaborators(): HasMany
    {
        return $this->hasMany(Colaborator::class);
    }
}
