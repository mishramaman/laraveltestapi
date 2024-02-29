<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use Illuminate\Http\Request;

class empController extends Controller
{
    function postApi(Request $req){
        // Create a new instance of the Detail model
        $employee = new Detail();
        // Retrieve all existing records from the Detail model
        $existingEmployees = Detail::all();
        // Extract emails from existing records
        $existingEmails = $existingEmployees->pluck('email')->toArray();
        // Check if the provided email already exists
        if (in_array($req->email, $existingEmails)) {
            echo "Data already exists for this email";
        } else {
            $employee->empName = $req->empName;
            $employee->email = $req->email;
            $employee->designation = $req->designation;
            $result = $employee->save();
            if ($result) {
                echo "Data saved successfully";
            }
        }
    }
    
    function put(Request $req){
        $data=Detail::find($req->id);
        $data->empName = $req->empName;
        $data->email = $req->email;
        $data->designation = $req->designation;
        $result=$data->save();
        if($result){
            echo "Data has been successfully changed";
        }else{
            echo "Data has not been changed";
        }
    }

    function getApi($id=null){
        return $id?Detail::find($id):Detail::all();
    }

    function delete($id){
        $data=Detail::find($id);
        $data->delete();
    }

}
