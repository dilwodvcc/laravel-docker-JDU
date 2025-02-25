<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    /** @use HasFactory<\Database\Factories\SubjectFactory> */
    use HasFactory;
    protected $fillable = [
        'name'
    ];
    protected $table = 'subjects';

    public $timestamps = true;
    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_subject', 'subject_id', 'group_id');
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'subject_user', 'subject_id', 'user_id');
    }
}
