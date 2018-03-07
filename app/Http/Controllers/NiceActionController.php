<?php

namespace App\Http\Controllers;

use \Illuminate\Http\Request;
use App\NiceAction;

class NiceActionController extends Controller
{
    public function getHome() 
    {
        $actions = NiceAction::all();
        return view('home', ['actions' => $actions]);
    }

    public function getNiceAction($action, $name = null) 
    {
        if($name === null) {
            $name = 'you';
        }
        
        return view('actions.nice', ['action' => $action, 'name' => $name]);
    }

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