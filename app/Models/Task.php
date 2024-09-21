<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['task','description','due_date','status','user_id'];
    public $timestamps = true;

      public function tags()
    {
        return $this->belongsToMany(Tag::class, 'task_tag');
    }
}
