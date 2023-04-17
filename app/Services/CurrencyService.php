<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Exceptions\BadRequestException;

class CurrencyService{

	private $apiKey;
	private $rootUrl;

	public function __construct(){

		$this->apiKey = config('currency.key');
		$this->rootUrl = config('currency.url');

	}
	

	public function convertCurrencies(string $method,string $endpoint, array $cur) : array {
		
		$base = $cur['base_currency'];
		$to = isset( $cur['currency'] ) ? $cur['currency'] : '';
		try{
			$res = Http::withHeaders([
				"apiKey" => $this->apiKey
			])->get("{$this->rootUrl}$endpoint?currencies=$to&base_currency=$base");

			return json_decode($res->getBody(),true);

		}catch(\Exception $ee){
			
			throw new BadRequestException();
			
		}
		
	}

	public function getCur(string $method,string $endpoint,array $qParams){
		
		$cur = !empty($qParams) ? isset($qParams['currencies']) ? implode('%2C',$qParams['currencies']) : '' : '';
		try{

			$res = Http::withHeaders([
				"apiKey" => $this->apiKey
			])->get("{$this->rootUrl}$endpoint?currencies=$cur");
			$res->throw();

		}catch(\Exception $ee){
			
			throw new BadRequestException();
			
		}

		
		return json_decode($res->getBody(),true);

	}

}