<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    public const PROPERTIES_RELATION_NAME = 'properties';

    protected $fillable = ['name', 'price', 'qty'];

    /**
     * @return BelongsToMany
     */
    public function properties(): BelongsToMany
    {
        return $this->belongsToMany(Property::class)->withPivot('property_id');
    }

    /**
     * Adds a multiple filter
     *
     * @param Builder $query
     * @param array|null $filters
     * @return void
     */
    public function scopeFilter(Builder $query, ?array $filters): void
    {
        if ($filters) {
            $addedQueriesCount = 0;
            foreach (Property::PROPERTIES_NAMES as $property) {
                if (isset($filters[$property])) {
                    $query->whereHas(self::PROPERTIES_RELATION_NAME, function ($query) use ($filters, $property, $addedQueriesCount) {
                        // If there is already added filter then use the 'orWhere' method instead of 'where'.
                        $condition = $addedQueriesCount === 0 ? 'where' : 'orWhere';
                        $query->$condition(Property::PROPERTIES_NAME_FIELD_NAME, $property)
                            ->whereIn(Property::PROPERTIES_VALUE_FIELD_NAME, $filters[$property]);
                    });
                }

                $addedQueriesCount++;
            }
        }
    }
}
