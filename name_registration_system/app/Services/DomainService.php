<?php

namespace App\Services;

use App\DomainName;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use DB;

class DomainService {
	public static function validate( $input, $domain = null ) {
		$ruleValidates = [
			'name' => 'required|unique:domain_names',
		];

		if ( $domain ) {
			$ruleValidates['name'] .= ',name,' . $domain->name;
//            var_dump($ruleValidates['name'] ); die;
		} else {

		}

		return Validator::make( $input, $ruleValidates )->setAttributeNames( trans( 'domains' ) );
	}

	public static function update( $input, $domain ) {
		DB::beginTransaction();
		try {
			$domain->update( $input );

			DB::commit();

			return $domain;
		} catch ( \Exception $e ) {
			DB::rollback();

			return false;
		}
	}

	public static function create( $input ) {
		DB::beginTransaction();
		try {
			$expiredDate              = date( 'Y-m-d H:i:s', strtotime( '+ 1 YEAR' ) );
			$registerDate             = date( 'Y-m-d H:i:s', strtotime( 'NOW' ) );
			$input['expiration_date'] = $expiredDate;
			$input['register_date']   = $registerDate;

			if ( empty( $input['user_id'] ) ) {
				$input['user_id'] = Auth::user()->id;
			}

			$domain = DomainName::create( $input );
			DB::commit();

			return $domain;
		} catch ( \Exception $e ) {
			DB::rollback();

			return false;
		}
	}

	public static function renew($domain) {
		DB::beginTransaction();
		try {
			$newExpiredDate = date( 'Y-m-d H:i:s', strtotime( "$domain->expiration_date + 1 YEAR" ) );
			$domain->update([
				'expiration_date' => $newExpiredDate
			]);
			DB::commit();
			return $domain;
		} catch ( \Exception $e ) {
			DB::rollback();

			return false;
		}
	}

	public static function register($name) {
		Session::put( 'nameToRegister', $name );
	}

	public static function removePendingDomain() {
		Session::forget('nameToRegister');
	}

	public static function getPendingDomain() {
		$name = Session::get('nameToRegister');
		return $name;
	}
}