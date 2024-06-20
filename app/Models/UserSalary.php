<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserSalary extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['user', 'salary'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function salary(): BelongsTo
    {
        return $this->belongsTo(Salary::class, 'salary_id', 'id');
    }
  
}
