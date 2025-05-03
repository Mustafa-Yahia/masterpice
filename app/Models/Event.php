<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    /**
     * الحقول القابلة للتعبئة
     */
    protected $fillable = [
        'title',
        'description',
        'date',
        'time',
        'location',
        'location_url',
        'image',
        'mission',
        'latitude',
        'longitude',
        'mission_point_1',
        'mission_point_2',
        'mission_point_3',
        'volunteers_needed',
    ];

    /**
     * الحقول التي يجب معاملتها كتواريخ
     */
    protected $dates = ['date'];

    /**
     * علاقة العديد إلى العديد مع المستخدمين (المشاركون في الحدث)
     * مع تضمين عمود الحالة (status) في الجدول الوسيط
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'event_user')
                    ->withPivot('status')
                    ->withTimestamps(); // إضافة تلقائية لتواريخ الإنشاء والتحديث
    }

    /**
     * علاقة العديد إلى العديد مع المتطوعين
     * مع تحديد اسم الجدول الوسيط والأعمدة المخصصة
     */
    public function volunteers()
    {
        return $this->belongsToMany(User::class, 'event_volunteer', 'event_id', 'user_id')
                    ->withTimestamps(); // إضافة تلقائية لتواريخ الإنشاء والتحديث
    }

    

    /**
     * علاقة مع المنظمين (إذا كانت لديك علاقة منفصلة)
     */
    public function organizers()
    {
        return $this->belongsToMany(User::class, 'event_organizers')
                    ->withTimestamps();
    }

    /**
     * سكوب للاستعلام عن الأحداث النشطة
     */
    public function scopeActive($query)
    {
        return $query->where('date', '>=', now());
    }

    /**
     * سكوب للاستعلام عن الأحداث المنتهية
     */
    public function scopeExpired($query)
    {
        return $query->where('date', '<', now());
    }

    /**
     * سكوب للاستعلام عن الأحداث التي تحتاج متطوعين
     */
    public function scopeNeedsVolunteers($query)
    {
        return $query->where('volunteers_needed', '>', 0);
    }

    /**
     * مسار الصورة الكامل
     */
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : asset('images/default-event.jpg');
    }
}
