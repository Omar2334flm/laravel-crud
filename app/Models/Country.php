<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\State;
class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'counrty_code','name'
    ];

    public function state()
    {
        return $this->hasMany(State::class);
    }
    public function employee()
    {
        return $this->hasMany(Employee::class);
    }

}
