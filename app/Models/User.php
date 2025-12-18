<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'password',
        'role',
        'saldo',
        'total_points',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'saldo' => 'decimal:2',
    ];

    // Relationships
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function withdrawals()
    {
        return $this->hasMany(Withdrawal::class);
    }

    // Helper methods
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function addSaldo($amount)
    {
        $this->saldo += $amount;
        $this->save();
    }

    public function deductSaldo($amount)
    {
        if ($this->saldo >= $amount) {
            $this->saldo -= $amount;
            $this->save();
            return true;
        }
        return false;
    }

    public function addPoints($points)
    {
        $this->total_points += $points;
        $this->save();
    }
}
