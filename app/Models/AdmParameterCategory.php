<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdmParameterCategory extends Model
{
    /**
     * @var string
     */
    protected $table = 'adm_parameter_category';

    /**
     * @var string
     */
    protected $primaryKey = 'pmc_seq';

    /**
     * @var bool
     */
    public $incrementing = true;

    public $timestamps = false;
    protected $fillable = ['pmc_description','pmc_order'];

    public function admParameters()
    {
        return $this->hasMany(AdmParameter::class);
    }
}
