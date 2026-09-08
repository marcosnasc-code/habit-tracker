<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Habit extends Model
{
    protected $fillable = [
        'user_id',
        'name',
    ];

    // Relação com a tabela de usuários
    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    // Relação com a tabela de logs de habilidades
    public function habitLogs(): HasMany
    {
        return $this->hasMany (HabitLog::class);
    }
}
