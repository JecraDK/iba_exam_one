<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

   // protected $fillable = [
     //   'name', 'email', 'birth_date', 'user_city', 'user_country', 'languages', 'competences', 'phone_number', 'password'
    //];

    //I used guarded instead of fillable because of mass input.
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $primaryKey = 'user_id';

    //name uppercase
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords($value);
    }
    //user_city uppercase
    public function setUserCityAttribute($value)
    {
        $this->attributes['user_city'] = ucwords($value);
    }
    //user_county uppercase
    public function setUserCountryAttribute($value)
    {
        $this->attributes['user_country'] = ucwords($value);
    }
    //languages uppercase
    public function setLanguagesAttribute($value)
    {
        $this->attributes['languages'] = ucwords($value);
    }
    //competences uppercase
    public function setCompetencesAttribute($value)
    {
        $this->attributes['competences'] = ucwords($value);
    }

    protected $casts =
        [
            'is_available' => 'boolean',
           'is_freelancer' => 'boolean',
           'is_permanent' => 'boolean'

        ];

}
