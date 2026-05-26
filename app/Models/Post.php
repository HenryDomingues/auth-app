<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    protected $fillable = ['title', 'text', 'image', 'categorias_id'];
    
    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class, 'categorias_id');
    }

    // Metodo para retornar o caminho completo da imagem
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }
}
