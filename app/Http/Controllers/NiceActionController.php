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

    public function postInsertNiceAction(Request $request) 
    {
        // Define the validations. Required and only accept alphabetics for a name.
        $this->validate($request, [
            'name' => 'required|alpha|unique:nice_actions',
            'niceness' => 'required|numeric'
        ]);

        $action = new NiceAction();
        $action->name = ucfirst(strtolower($request['name']));
        $action->niceness = $request['niceness'];
        $action->save();

        $actions = NiceAction::all();

        return redirect()->route('home', ['actions' => $actions]);
    }



    private function transformName($name)
    {   
        $prefix = 'KING ';
        return $prefix . strtoupper($name);
    }
}