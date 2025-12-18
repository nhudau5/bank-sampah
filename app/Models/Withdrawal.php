<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'withdrawal_code',
        'amount',
        'status',
        'notes',
        'approved_at',
        'approved_by',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'approved_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public static function generateCode()
    {
        $prefix = 'WD';
        $date = date('Ymd');
        $random = strtoupper(substr(md5(uniqid()), 0, 6));
        return $prefix . $date . $random;
    }

    public function approve($adminId)
    {
        if ($this->user->deductSaldo($this->amount)) {
            $this->status = 'approved';
            $this->approved_at = now();
            $this->approved_by = $adminId;
            $this->save();
            return true;
        }
        return false;
    }

    public function reject()
    {
        $this->status = 'rejected';
        $this->save();
    }
}
