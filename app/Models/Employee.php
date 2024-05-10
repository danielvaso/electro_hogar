<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'employee';

    protected $fillable = [
        'id',
        'user_id',
        'document_type',
        'document',
        'address',
        'start_date',
        'phone',
        'eps',
        'rh',
        'gender',
        'position',
        'dob',
        'salary',
        'status',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $guarded = [];
    protected $dates = ['start_date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
}
