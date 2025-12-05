<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'booking_id', 'customer_id', 'service_id', 'rating', 'review_text'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    protected static function booted()
    {
        static::created(function ($review) {
            $review->service->updateRating();
        });

        static::updated(function ($review) {
            $review->service->updateRating();
        });

        static::deleted(function ($review) {
            $review->service->updateRating();
        });
    }
}