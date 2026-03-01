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
        // if (!empty($params['keyword'])) {
        //     $query->where('first_name', 'like', '%' . $params['keyword'] . '%')
        //         ->orWhere('last_name', 'like', '%' . $params['keyword'] . '%')
        //         ->orWhere('email', 'like', '%' . $params['keyword'] . '%')
        //         ->orWhereRaw("CONCAT(last_name, first_name) LIKE ?", ['%' . $params['keyword'] . '%'])
        //         ->orWhereRaw("CONCAT(last_name, ' ', first_name) LIKE ?", ['%' . $params['keyword'] . '%']);
        // }
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

    // public function scopeGenderSearch($query, $gender)
    // {
    //     if (!empty($gender) && $gender > 0) {
    //         $query->where('gender', $gender);
    //     }
    // }

    // public function scopeCategorySearch($query, $category_id)
    // {
    //     if (!empty($category_id)) {
    //         $query->where('category_id', $category_id);
    //     }
    // }

    // public function scopeDateSearch($query, $date)
    // {
    //     if (!empty($date)) {
    //         $query->whereDate('created_at', $date);
    //     }
    // }

    // public function scopeKeywordSearch($query, $keyword)
    // {
    //     if (!empty($keyword)) {
    //         $query->where('content', 'like', '%' . $keyword . '%');
    //     }
    //     return $query;
    // }
}
