<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomMarket extends Model
{
    use HasFactory;
    protected $table = 'custom_market';

    protected $fillable = ['brand', 'model', 'year', 'cc', 'km'];

    public function appointments()
    {
        return $this->belongsToMany(Appointment::class, 'appointment_has_custom_market', 'custom_market_id', 'appointment_id');
    }

    public function customers()
    {
        return $this->belongsToMany(Customer::class, 'customer_has_custom_market', 'custom_market_id', 'customer_id');
    }
}
