<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'user_id', 'category_id', 'bio', 'years_of_experience',
        'hourly_rate', 'location', 'skills', 'availability_status',
        'verification_status', 'average_rating', 'total_reviews'
    ];

    protected $casts = [
        'skills' => 'array',
        'hourly_rate' => 'decimal:2',
        'average_rating' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function updateRating()
    {
        $this->average_rating = $this->reviews()->avg('rating');
        $this->total_reviews = $this->reviews()->count();
        $this->save();
    }
}