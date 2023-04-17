<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;

    public function admin()
    {
        return $this->hasOne(Admin::class, 'id', 'admin_id');
    }
}
