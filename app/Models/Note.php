<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Note extends Model
{
    /**

     * The users that belong to the role.

     */

     public function users(): BelongsToMany

     {
 
         return $this->belongsToMany(User::class,'user_notes');
 
     }
}
