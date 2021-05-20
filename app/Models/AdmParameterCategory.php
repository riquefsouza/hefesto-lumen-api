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
    //protected $fillable = ['pmc_seq', 'pmc_description', 'pmc_order'];

    protected $maps = ['pmc_seq' => 'id', 'pmc_description' => 'description', 'pmc_order' => 'order'];
    protected $hidden = ['pmc_seq', 'pmc_description', 'pmc_order'];
    protected $visible = ['id', 'description', 'order'];
    protected $appends = ['id', 'description', 'order'];
    protected $fillable = ['id', 'description', 'order'];

    public function admParameters()
    {
        return $this->hasMany(AdmParameter::class);
    }

    public function getIdAttribute()
    {
        return $this->attributes['pmc_seq'];
    }

    public function setIdAttribute($value)
    {
        $this->attributes['pmc_seq'] = $value;
    }

    public function getDescriptionAttribute()
    {
        return $this->attributes['pmc_description'];
    }

    public function setDescriptionAttribute($value)
    {
        $this->attributes['pmc_description'] = $value;
    }

    public function getOrderAttribute()
    {
        return $this->attributes['pmc_order'];
    }

    public function setOrderAttribute($value)
    {
        $this->attributes['pmc_order'] = $value;
    }

}
