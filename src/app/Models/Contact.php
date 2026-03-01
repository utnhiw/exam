<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'first_name',
        'last_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'detail'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeSearch($query, $params)
    {
        if (!empty($params['keyword'])) {
            $query->where(function ($q) use ($params) {
                $keyword = $params['keyword'];
                $q->where('first_name', 'like', "%{$keyword}%")
                    ->orWhere('last_name', 'like', "%{$keyword}%")
                    ->orWhere('email', 'like', "%{$keyword}%")
                    ->orWhereRaw("CONCAT(last_name, first_name) LIKE ?", ["%{$keyword}%"])
                    ->orWhereRaw("CONCAT(last_name, ' ', first_name) LIKE ?", ["%{$keyword}%"]);
            });
        }
        if (!empty($params['gender']) && $params['gender'] !== 'all') {
            $query->where('gender', $params['gender']);
        }
        if (!empty($params['category_id'])) {
            $query->where('category_id', $params['category_id']);
        }
        if (!empty($params['date'])) {
            $query->whereDate('created_at', $params['date']);
        }

        return $query;
    }
}
