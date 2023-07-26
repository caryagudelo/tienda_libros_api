<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;
    protected $timestamps=true;

protected $fillable =['name','description'];
    public function book()
    {
        return $this->belongsTo(book::Class);
    }
}
