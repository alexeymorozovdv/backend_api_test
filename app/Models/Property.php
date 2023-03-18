<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Property extends Model
{
    use HasFactory;

    public const PROPERTIES_NAMES = ['color', 'weight'];
    public const PROPERTIES_TABLE_NAME = 'properties';
    const PROPERTIES_NAME_FIELD_NAME = 'name';
    const PROPERTIES_VALUE_FIELD_NAME = 'value';

    protected $fillable = ['name', 'value'];

    /**
     * @return BelongsToMany
     */
    public function product(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withPivot('product_id');
    }

}
