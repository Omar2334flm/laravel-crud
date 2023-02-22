<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
protected $fillable =[ 'middle_name', 
'first_name',
'last_name',
'country_id',
'department_id',
'city_id',
'state_id',

'zip_code',      
'birthdate',       
'date_hired',
'address'];
   
public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function state()
    {
        return $this->belongsTo(State::class);
    }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
