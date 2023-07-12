<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class People extends Model
{
    use HasFactory;

    protected $fillable = ['name','surname','b_date'];


    protected function fullName(): Attribute{
        return Attribute::make(
            get: fn () => ($this->name . " " . $this->surname)
            ,
        );
    }   

}
