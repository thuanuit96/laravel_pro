<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DomainName extends Model
{
    protected $table = 'domain_names';

    protected $fillable = [
        'id', 'name', 'description', 'register_date', 'expiration_date', 'user_id',
    ];

    public function user() {
    	return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function canRenew() {
    	$currentYear = date('Y');
    	$expirationYear = date('Y', strtotime($this->expiration_date));

    	if ($expirationYear - $currentYear >= 1)
    		return false;
    	return true;
    }
}
