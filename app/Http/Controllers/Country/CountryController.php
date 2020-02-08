<?php

namespace App\Http\Controllers\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CountryModel;
//Using for validation
use Validator;

class CountryController extends Controller
{
    //Simple Basic Methods
    // public function Country()
    // {
    //     return response()->json(CountryModel::get(),200);
    // }

    // public function countryByID($id){
    //     return response()->json(CountryModel::find($id),200);
    // }
    // public function countrySave(Request $request){
    //     $country = CountryModel::create($request->all());
    //     return response()->json($country,201);
    // }

    // public function countryUpdate(Request $request,CountryModel $country){
    //     $country->update($request->all());
    //     return response()->json($country,200);
    // }

    // public function countryDelete(Request $request,CountryModel $country){
    //     $country->delete();
    //     return response()->json(null,200);
    // }
    public function Country()
    {
        return response()->json(CountryModel::get(),200);
    }

    public function countryByID($id){
        $country = CountryModel::find($id);
        if(is_null($country)){
            return response()->json(["message"=>"Record not found!"],404);
        }
        return response()->json($country,200);
    }
    public function countrySave(Request $request){
        $rules = [
            'name'=>'required|min:3|unique',
            'iso'=>'required|min:2|max:2'
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }
        $country = CountryModel::create($request->all());
        return response()->json($country,201);
    }

    public function countryUpdate(Request $request,$id){
        $country = CountryModel::find($id);
        if(is_null($country)){
            return response()->json(["message"=>"Record not found!"],404);
        }
        $country->update($request->all());
        return response()->json($country,200);
    }

    public function countryDelete(Request $request,$id){
        $country = CountryModel::find($id);
        if(is_null($country)){
            return response()->json(["message"=>"Record not found!"],404);
        }
        $country->delete();
        return response()->json(null,200);
    }

}
