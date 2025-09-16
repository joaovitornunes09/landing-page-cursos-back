<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'type',
        'main_category',
        'duration_hours',
        'modules_count',
        'access_period_months',
        'modality',
        'price',
        'enrollment_fee',
        'max_installments',
        'installment_value',
        'featured',
        'active',
        'target_audience',
        'payment_info',
        'payment_conditions',
        'instructor',
        'level',
        'category',
        'owner',
        'image',
        'banner'
    ];

    protected $casts = [
        'featured' => 'boolean',
        'active' => 'boolean',
        'price' => 'decimal:2',
        'enrollment_fee' => 'decimal:2',
        'installment_value' => 'decimal:2'
    ];

    protected $appends = [
        'image_url',
        'banner_url'
    ];

    public function modules()
    {
        return $this->hasMany(CourseModule::class);
    }

    public function competencies()
    {
        return $this->hasMany(Competency::class);
    }

    public function decisionInfos()
    {
        return $this->hasMany(DecisionInfo::class);
    }

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            // Se a imagem está no storage público, usa a URL do storage
            if (Storage::disk('public')->exists($this->image)) {
                return Storage::disk('public')->url($this->image);
            }
            // Fallback para diretório public
            if (file_exists(public_path($this->image))) {
                return asset($this->image);
            }
            // Se não encontrar, retorna a URL assumindo que está no storage
            return Storage::disk('public')->url($this->image);
        }
        return null;
    }

    public function getBannerUrlAttribute()
    {
        if ($this->banner) {
            // Se o banner está no storage público, usa a URL do storage
            if (Storage::disk('public')->exists($this->banner)) {
                return Storage::disk('public')->url($this->banner);
            }
            // Fallback para diretório public
            if (file_exists(public_path($this->banner))) {
                return asset($this->banner);
            }
            // Se não encontrar, retorna a URL assumindo que está no storage
            return Storage::disk('public')->url($this->banner);
        }
        return null;
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }
}