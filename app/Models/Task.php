<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'long_description'];
    // do not add those password/secret into fillable
    // protected $guarded = ['secret'];

    public function toggleComplete() {
        $this->completed = !$this->completed;
        $this->save();
    }
}
