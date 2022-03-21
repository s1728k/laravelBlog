<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use SoftDeletes;
    
    public $table = 'countries';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','iso3','iso2','numeric_code','phone_code','capital','currency','currency_name','currency_symbol','tld','native','region','subregion','latitude','longitude','emoji','emojiU',    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    public function timezone()
    {
        return $this->hasMany(Timezone::class, 'country_id', 'id');
    }

    public function translation()
    {
        return $this->hasOne(Translation::class, 'country_id', 'id');
    }
}
