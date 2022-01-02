<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllCompany()
    {
        return Company::latest()->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createCompany(Request $request)
    {   
        $request -> validate([
            'logo' =>'image|mimes:jpg,png,jpeg,gif|max:19999',
        ]);
        $request->file('logo')->store('public/pictures');
        $company = new Company();
        $company->companyName = $request->companyName;
        $company -> email = $request->email;
        $company->address = $request -> address;
        $company-> phone = $request->phone;
        $company->domain = $request->domain;
        $company-> logo = $request->file('logo')->hashName();
        $company->save();
        return response()->json(['message'=>'Company created','data'=>$company],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getOneCompany($id)
    {
        return Company::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateCompany(Request $request, $id)
    {
        $request -> validate([
            'logo' =>'image|mimes:jpg,png,jpeg,gif|max:19999',
        ]);
        $request->file('logo')->store('public/pictures');
        $company = Company::findOrFail($id);
        $company->companyName = $request->companyName;
        $company -> email = $request->email;
        $company->address = $request -> address;
        $company-> phone = $request->phone;
        $company-> domain = $request-> domain;
        $company-> logo = $request->file('logo')->hashName();
        // $company -> logo = $request -> logo;
        $company->save();
        return response()->json(['message'=>'Company updated','data'=>$company],201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteCompany($id)
    {
        return Company::destroy($id);
    }
}
