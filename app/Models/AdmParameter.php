<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdmParameter extends Model
{
    /**
     * @var string
     */
    protected $table = 'adm_parameter';

    /**
     * @var string
     */
    protected $primaryKey = 'par_seq';

    /**
     * @var bool
     */
    public $incrementing = true;

    public $timestamps = false;
    protected $fillable = ['par_code', 'par_description', 'par_pmc_seq', 'par_value'];

    public function admParameterCategory()
    {
        return $this->hasOne(AdmParameterCategory::class);
    }
}
