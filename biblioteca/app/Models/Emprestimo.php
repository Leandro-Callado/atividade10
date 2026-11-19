<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Emprestimo extends Model
{
    protected $fillable = [
        'livro_id',
        'leitor_id',
        'data_emprestimo',
        'data_prevista',
        'data_devolucao',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'data_emprestimo' => 'date',
            'data_prevista' => 'date',
            'data_devolucao' => 'date',
        ];
    }

    public function livro(): BelongsTo
    {
        return $this->belongsTo(Livro::class);
    }

    public function leitor(): BelongsTo
    {
        return $this->belongsTo(Leitor::class);
    }
}
