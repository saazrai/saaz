<?php

namespace App\Models;

use App\Traits\SafeSearchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Base model with secure defaults for all models
 *
 * This class provides secure defaults to prevent mass assignment vulnerabilities
 * and enforce best practices across all models.
 */
abstract class BaseModel extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     * By default, we protect all attributes unless explicitly allowed via $fillable
     *
     * @var array<string>|bool
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_secret',
        'two_factor_recovery_codes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        // Add global scopes or observers here if needed
    }

    /**
     * Get the route key for the model.
     * Override this in child models if you want to use a different column for route model binding
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        // Check if the model has a slug column, use it for SEO-friendly URLs
        if (in_array('slug', $this->getFillable()) || array_key_exists('slug', $this->getAttributes())) {
            return 'slug';
        }

        return parent::getRouteKeyName();
    }

    /**
     * Scope a query to only include active records.
     * Override this in child models if the active column is named differently
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        $activeColumns = ['is_active', 'active', 'status'];

        foreach ($activeColumns as $column) {
            if (in_array($column, $this->getFillable()) || array_key_exists($column, $this->getAttributes())) {
                if ($column === 'status') {
                    return $query->where($column, 'active');
                }

                return $query->where($column, true);
            }
        }

        return $query;
    }

    /**
     * Scope a query to order by sort order if available.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrdered($query)
    {
        $orderColumns = ['sort_order', 'order', 'position', 'sequence'];

        foreach ($orderColumns as $column) {
            if (in_array($column, $this->getFillable()) || array_key_exists($column, $this->getAttributes())) {
                return $query->orderBy($column);
            }
        }

        return $query->orderBy('created_at', 'desc');
    }

    /**
     * Convert the model instance to an array.
     * Hide sensitive fields automatically
     *
     * @return array
     */
    public function toArray()
    {
        $array = parent::toArray();

        // Remove any fields that might contain sensitive data
        $sensitiveFields = [
            'password',
            'api_key',
            'api_secret',
            'secret_key',
            'private_key',
            'access_token',
            'refresh_token',
            'webhook_secret',
            'encryption_key',
            'salt',
        ];

        foreach ($sensitiveFields as $field) {
            unset($array[$field]);
        }

        return $array;
    }

    /**
     * Determine if the model uses timestamps.
     *
     * @return bool
     */
    public function usesTimestamps()
    {
        return $this->timestamps;
    }

    /**
     * Helper method to safely update model attributes
     * This method validates that only fillable attributes are updated
     *
     * @return bool
     */
    public function safeUpdate(array $attributes)
    {
        // Filter out any non-fillable attributes
        $fillable = $this->getFillable();
        $filtered = array_intersect_key($attributes, array_flip($fillable));

        return $this->update($filtered);
    }

    /**
     * Helper method to check if an attribute is fillable
     *
     * @param  string  $key
     * @return bool
     */
    public function isFillable($key)
    {
        return in_array($key, $this->getFillable());
    }
}
