<?php

  class Companyavatar extends Model {
    
    protected $table = 'companyavatars';
    protected $fillable = ['company_id', 'file_id_logo', 'file_id_lg', 'file_id_sm'];
    
    // relation
    public function company() {
      return $this->belongsTo('App\Models\Company');
    }
    
    public function getCompanyAvatar($id) {
      // Grab currently logged on user record (username, email, password)
      $image = DB::table('companyavatars')
              ->leftjoin('s3files', 'companyavatars.file_id_lg', '=', 's3files.id')
              ->where('companyavatars.company_id', '=', $id)
              ->first();
      if($image->id != null) {
        $s3 = App::make('aws')->get('s3');
        return $s3->getObjectUrl($image->file_bucket, $image->file_path . '/' . $image->file_name);
      } else {
        return URL::asset('images/icons/company-avatar-60.png'); 
      }
    }
    
    public function getCompanyLogo($id) {
      // Grab currently logged on user record (username, email, password)
      $image = DB::table('companyavatars')
              ->leftjoin('s3files', 'companyavatars.file_id_logo', '=', 's3files.id')
              ->where('companyavatars.company_id', '=', $id)
              ->first();
      if($image->id != null) {
        $s3 = App::make('aws')->get('s3');
        return $s3->getObjectUrl($image->file_bucket, $image->file_path . '/' . $image->file_name);
      } else {
        return URL::asset('images/logos/default.png'); 
      }
    }
    
  }