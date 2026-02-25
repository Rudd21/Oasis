<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'sprints',
        'status',
        'idOwner',
        'idManager',
        'members',
        'createdAt',
    ];

    protected $casts = [
        'members' => 'array',
        'sprints' => 'array',
    ];

}