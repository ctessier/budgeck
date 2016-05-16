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
     * @var string
     */
    protected function getBaseNamespace()
    {
        return $this->getAppNamespace() . 'Models';
    }

    /**
     * Validation errors will go in here
     *
     * @var array
     */
    public $errors;

    /**
     * Validate or not data on given rules
     *
     * @param array $data
     * @param array $rules
     * @param array $messages
     * @return boolean
     */
    public function validate($data, $rules = null, $messages = null)
    {
        if ($rules == null && $messages == null)
        {
            $rules = $this->rules;
            $messages = $this->messages;
        }

        $v = \Validator::make($data, $rules, $messages);
        if ($v->fails())
        {
            $this->errors = $v->errors();
            return false;
        }
        return true;
    }
}
