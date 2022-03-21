<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Timezone;
use App\Models\Translation;
use App\Models\State;
use App\Models\City;

use Illuminate\Http\Request;

class HomeController extends Controller
{

	public function __construct()
    {
        
    }

	public function save()
	{
		$api = file_get_contents("https://raw.githubusercontent.com/dr5hn/countries-states-cities-database/master/countries.json");
		$api = json_decode($api,true);
	    foreach($api as $ap){
	    	// dd($ap);exit;
	    	$country = Country::firstOrCreate([
	    		'name'=>$ap['name'],
				'iso3'=>$ap['iso3'],
				'iso2'=>$ap['iso2'],
				'numeric_code'=>$ap['numeric_code'],
				'phone_code'=>$ap['phone_code'],
				'capital'=>$ap['capital'],
				'currency'=>$ap['currency'],
				'currency_name'=>$ap['currency_name'],
				'currency_symbol'=>$ap['currency_symbol'],
				'tld'=>$ap['tld'],
				'native'=>$ap['native'],
				'region'=>$ap['region'],
				'subregion'=>$ap['subregion'],
				'latitude'=>$ap['latitude'],
				'longitude'=>$ap['longitude'],
				'emoji'=>$ap['emoji'],
				'emojiU'=>$ap['emojiU'],
	    	]);
	    	foreach ($ap['timezones'] as $tz) {
	    		Timezone::firstOrCreate([
		    		'country_id'=>$country->id,
		    		'zoneName'=>$tz['zoneName'],
					'gmtOffset'=>$tz['gmtOffset'],
					'gmtOffsetName'=>$tz['gmtOffsetName'],
					'abbreviation'=>$tz['abbreviation'],
					'tzName'=>$tz['tzName'],
		    	]);
	    	}
	    	$ar = ['country_id'=>$country->id];
	    	foreach ($ap['translations'] as $key => $val){
	    		$ar[$key] = $val;
	    	}
	    	Translation::firstOrCreate($ar);
	   //  	$country->timezones()->create([
				// 'zoneName'=>$ap['timezones'][0]['zoneName'],
				// 'gmtOffset'=>$ap['timezones'][0]['gmtOffset'],
				// 'gmtOffsetName'=>$ap['timezones'][0]['gmtOffsetName'],
				// 'abbreviation'=>$ap['timezones'][0]['abbreviation'],
				// 'tzName'=>$ap['timezones'][0]['tzName'],
	   //  	]);
	   //  	$country->translation()->create([
				// 'kr'=>$ap['translations']['kr'],
				// 'br'=>$ap['translations']['br'],
				// 'pt'=>$ap['translations']['pt'],
				// 'nl'=>$ap['translations']['nl'],
				// 'hr'=>$ap['translations']['hr'],
				// 'fa'=>$ap['translations']['fa'],
				// 'de'=>$ap['translations']['de'],
				// 'es'=>$ap['translations']['es'],
				// 'fr'=>$ap['translations']['fr'],
				// 'ja'=>$ap['translations']['ja'],
				// 'it'=>$ap['translations']['it'],
				// 'cn'=>$ap['translations']['cn'],
	   //  	]);
	    }
	}

	public function save_states()
	{
		$api = file_get_contents("https://raw.githubusercontent.com/dr5hn/countries-states-cities-database/master/countries%2Bstates%2Bcities.json");
		$api = json_decode($api,true);
	    foreach($api as $ap){
	    	// dd($ap);exit;
	    	$cnt = Country::firstOrCreate([
	    		'name'=>$ap['name'],
				'iso3'=>$ap['iso3'],
				'iso2'=>$ap['iso2'],
				'numeric_code'=>$ap['numeric_code'],
				'phone_code'=>$ap['phone_code'],
				'capital'=>$ap['capital'],
				'currency'=>$ap['currency'],
				'currency_name'=>$ap['currency_name'],
				'currency_symbol'=>$ap['currency_symbol'],
				'tld'=>$ap['tld'],
				'native'=>$ap['native'],
				'region'=>$ap['region'],
				'subregion'=>$ap['subregion'],
				'latitude'=>$ap['latitude'],
				'longitude'=>$ap['longitude'],
				'emoji'=>$ap['emoji'],
				'emojiU'=>$ap['emojiU'],
	    	]);
	    	foreach ($ap['states'] as $state) {
	    		$st = State::firstOrCreate([
		    		'name'=>$state['name'],
					'country_id'=>$cnt->id,
					'country_code'=>$cnt->iso2,
					'country_name'=>$cnt->name,
					'state_code'=>$state['state_code'],
					'type'=>$state['type'],
					'latitude'=>$state['latitude'],
					'longitude'=>$state['longitude'],
		    	]);
		    	foreach ($state['cities'] as $city) {
		    		$ct = City::firstOrCreate([
			    		'name'=>$city['name'],
						'state_id'=>$st->id,
						'state_code'=>$st->state_code,
						'state_name'=>$st->name,
						'country_id'=>$cnt->id,
						'country_code'=>$cnt->iso2,
						'country_name'=>$cnt->name,
						'latitude'=>$city['latitude'],
						'longitude'=>$city['longitude'],
						// 'wikiDataId'=>$city['wikiDataId'],
			    	]);
			    	
		    	}
	    	}
	    	
	    }
	}

	public function save_cities()
	{
		$api = file_get_contents("https://raw.githubusercontent.com/dr5hn/countries-states-cities-database/master/cities.json");
		$api = json_decode($api,true);
	    foreach($api as $ap){
	    	// dd($ap);exit;
	    	$city = City::firstOrCreate([
	    		'name'=>$ap['name'],
				'state_id'=>$ap['state_id'],
				'state_code'=>$ap['state_code'],
				'state_name'=>$ap['state_name'],
				'country_id'=>$ap['country_id'],
				'country_code'=>$ap['country_code'],
				'country_name'=>$ap['country_name'],
				'latitude'=>$ap['latitude'],
				'longitude'=>$ap['longitude'],
				'wikiDataId'=>$ap['wikiDataId'],
	    	]);
	    }
	}

	public function display(Request $request)
	{
		$countries = Country::all();
		// dd($countries[0]->id);
		$states = State::where('country_id',$request->query('country_id')??$countries[0]->id)->get();
		// dd($states[0]->id);
		$cities = City::where('state_id',$request->query('state_id')??$states[0]->id)->get();
		return view("home")->with(['countries'=>$countries, 'states'=>$states, 'cities'=>$cities]);
	}

	public function wire(Request $request)
	{
		return view("wire");
	}

	public function wire_csc(Request $request)
	{
		return view("wire_csc");
	}

	public function power_table(Request $request)
	{
		return view("power_table");
	}

	public function country_destroy($id)
	{
		Country::destroy($id);
	}
}