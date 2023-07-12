<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Film extends Model
{
    use HasFactory;

    protected $fillable = [
        'id','name','year','running_h','running_m','rating','image'
    ];
    
    public function genres(): BelongsToMany {
        //OVO JE QB I MOZETE DA SIRITE I WHERE USLOVIMA ORDERBY ITD.
        // $locale = App::currentLocale();

        return $this->belongsToMany(Genre::class)->orderBy('name_en');
    }        

    protected function runningTime(): Attribute{


        return Attribute::make(
            get: fn () => trim(( $this -> running_h ? ($this -> running_h . " h ") : "").
            ( $this -> running_m ? ($this -> running_m . " min ") : "")),
        );
    }
   
    public function writers(): BelongsToMany {
        

        return $this->belongsToMany(People::class,'film_writer');
    }        

    public function stars(): BelongsToMany {
        return $this->belongsToMany(People::class, 'film_star');
     }

     public function directors(): BelongsToMany {
        return $this->belongsToMany(People::class, 'film_director');
     }


}
