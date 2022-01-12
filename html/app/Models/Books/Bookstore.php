<?php

namespace App\Models\Books;

use Orchid\Screen\AsSource;
use App\Models\Address\City;
use App\Models\Manager\Manager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bookstore extends Model
{
    use HasFactory;
    use AsSource;

    protected $fillable = [
        'name',
        'address',
        'manager_id',
    ];

    public function manager()
    {
        return $this->belongsTo(Manager::class, 'manager_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}
