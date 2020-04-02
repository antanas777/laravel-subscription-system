<?php

declare(strict_types=1);

namespace Rinvex\Subscriptions\Models;

use Carbon\Carbon;
use Spatie\EloquentSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Rinvex\Subscriptions\Services\Period;
use Rinvex\Support\Traits\ValidatingTrait;
use Spatie\EloquentSortable\SortableTrait;
use Rinvex\Subscriptions\Traits\BelongsToPlan;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Rinvex\Subscriptions\Models\PlanPrice.
 *
 * @property int                                                                                                $id
 * @property int                                                                                                $plan_id
 * @property int                                                                                                $month
 * @property float                                                                                              $price
 * @property \Carbon\Carbon|null                                                                                $created_at
 * @property \Carbon\Carbon|null                                                                                $updated_at
 * @property \Carbon\Carbon|null                                                                                $deleted_at
 */
class PlanPrice extends Model
{
    use BelongsToPlan;
    use ValidatingTrait;

    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'plan_id',
        'month',
        'price',
    ];

    /**
     * {@inheritdoc}
     */
    protected $casts = [
        'plan_id' => 'integer',
        'month' => 'integer',
        'price' => 'float',
        'deleted_at' => 'datetime',
    ];

    /**
     * {@inheritdoc}
     */
    protected $observables = [
        'validating',
        'validated',
    ];

    /**
     * The sortable settings.
     *
     * @var array
     */
    public $sortable = [
    ];

    /**
     * The default rules that the model will validate against.
     *
     * @var array
     */
    protected $rules = [];

    /**
     * Whether the model should throw a
     * ValidationException if it fails validation.
     *
     * @var bool
     */
    protected $throwValidationExceptions = true;

    /**
     * Create a new Eloquent model instance.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(config('rinvex.subscriptions.tables.plan_prices'));
        $this->setRules([
            'plan_id' => 'required|integer|exists:'.config('rinvex.subscriptions.tables.plans').',id',
            'month' => 'required|integer',
            'price' => 'required|float',
        ]);
    }
}
