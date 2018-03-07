<?php

namespace App\Http\Controllers;

use \Illuminate\Http\Request;

class NiceActionController extends Controller
{
    public function getNiceAction($action, $name = null) 
    {
        
        return view('actions.'. $action, ['name' => $name]);
    }

    /*
    public function postNiceAction(Request $request) 
    {
        // Check if the values for select-input named "action" and the input-field named "name" have been given. 
        if(isset($request['action']) && $request['name']) {
    
            // Check if the input-field named "name" is not empty.
            if(strlen($request['name']) > 0) {
                // Return view named "nice" with an array including the "action" and the "name".
                return view('actions.nice', ['action' => $request['action'], 'name' => $this->transformName($request['name'])]);
            }
            return redirect()->back();
        }
        return redirect()->back();
    }
    */

    public function postNiceAction(Request $request) 
    {
        // Define the validations. Required and only accept alphabetics for a name.
        $this->validate($request, [
            'action' => 'required',
            'name' => 'required|alpha'
        ]);
        // Return view named "nice" with an array including the "action" and the "name".
        return view('actions.nice', ['action' => $request['action'], 'name' => $this->transformName($request['name'])]);

    }



    private function transformName($name)
    {   
        $prefix = 'KING ';
        return $prefix . strtoupper($name);
    }
}