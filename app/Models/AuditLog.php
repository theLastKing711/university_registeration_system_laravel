<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AuditLog extends Model
{
    /** @use HasFactory<\Database\Factories\AuditLogFactory> */
    use HasFactory;

    /**
     * Get the user that owns the AuditLog
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // protected function action(): Attribute
    // {
    //     return
    //         Attribute::make(
    //             get: fn (mixed $value, array $attributes) => config('constants.audit_logs.actions')[$value]
    //         );
    // }

    // protected function resource(): Attribute
    // {
    //     return
    //         Attribute::make(
    //             get: fn (mixed $value, array $attributes) => config('constants.audit_logs.recources')[$value]
    //         );
    // }

    protected $casts = [
        'details' => 'array', // Casts the JSON column to a PHP array
    ];
}
