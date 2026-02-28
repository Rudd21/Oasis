<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Project extends Model{
    use HasFactory, HasUlids;

    protected $keyType = 'string';
    public $incrementing = false;

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