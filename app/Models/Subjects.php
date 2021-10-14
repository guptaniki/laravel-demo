<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subjects extends Model
{
    use HasFactory;
    use SoftDeletes; // <-- Use This Instead Of SoftDeletingTrait
    public $table="subjects";
    public $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'subject_title',
        'subject_name',
        'subject_description'
    ];
}
