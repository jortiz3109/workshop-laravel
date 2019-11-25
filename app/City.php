<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    /**
     * Relation between city and collaborators
     * @return HasMany
     */
    public function collaborators(): HasMany
    {
        return $this->hasMany(Collaborator::class);
    }
}
