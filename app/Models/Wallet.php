<?php

namespace App\Models;

use App\Enums\TransactionType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Ramsey\Uuid\Uuid;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'uuid',
        'title',
        'description',
        'status',
    ];

    protected $with = ['transactions'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Uuid::uuid4();
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function lastTransactionDate()
    {
        $lastTransaction = $this->transactions()->latest()->first();
        return $lastTransaction?->created_at;
    }

    public function getBalanceAttribute(): float
    {
        return $this->transactions()
            ->selectRaw('SUM(CASE WHEN type = ? THEN amount ELSE 0 END) - SUM(CASE WHEN type = ? THEN amount ELSE 0 END) AS balance',
                [TransactionType::Deposit, TransactionType::Withdraw])
            ->value('balance') ?? 0.00;
    }
}
