<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['order_id', 'user_id', 'total_amount', 'status', 'payment_method', 'alamat_pengiriman', 'status_pengiriman'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(TransactionItem::class);
    }

    public function markAsSuccess()
    {
        if ($this->status !== 'success') {
            $this->update(['status' => 'success']);

            foreach ($this->items as $item) {
                if ($item->book) {
                    $item->book->decrement('stok', $item->quantity);
                }
            }
        }
    }
}
