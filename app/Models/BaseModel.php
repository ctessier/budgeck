<?php

namespace Budgeck\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaseModel extends Model
{
    /**
     * Add trait for soft deleting
     */
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Add trait for getting application namespace
     */
    use \Illuminate\Console\AppNamespaceDetectorTrait;

    /**
     * Initialize models base namespace
     *
     * @return string
     */
    protected function getBaseNamespace()
    {
        return $this->getAppNamespace() . 'Models';
    }
}
