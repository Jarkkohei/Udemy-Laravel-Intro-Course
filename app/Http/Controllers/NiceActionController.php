<?php

namespace App\Http\Controllers;

use \Illuminate\Http\Request;
use App\NiceAction;
use App\NiceActionLog;

class NiceActionController extends Controller
{
    public function getHome() 
    {
        $actions = NiceAction::all();
        $logged_actions = NiceActionLog::all();
        return view('home', ['actions' => $actions, 'logged_actions' => $logged_actions]);
    }

    public function getNiceAction($action, $name = null) 
    {
        if($name === null) {
            $name = 'you';
        }
        // Sama kuin sql: (SELECT * FROM NiceAction WHERE 'name' = $action LIMIT 1)
        $nice_action = NiceAction::where('name', $action)->first();

        $nice_action_log = new NiceActionLog();
        $nice_action->logged_actions()->save($nice_action_log);

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