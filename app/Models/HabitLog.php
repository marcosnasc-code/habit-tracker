<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HabitLog extends Model
{
    protected $fillable = [
        'user_id',
        'habit_id',
        'completed_at',
    ];

    // Relação com a tabela de usuários
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relação com a tabela de habilidades
    public function habit(): BelongsTo
    {
        return $this->belongsTo(Habit::class);
    }
}
