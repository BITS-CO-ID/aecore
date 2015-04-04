<?php

  class Companyphone extends Model {
    
    protected $table = 'companyphones';
    protected $fillable = ['company_id', 'type', 'number'];
    
    // relation
    public function company() {
      return $this->belongsTo('App\Models\Company');
    }
    
  }