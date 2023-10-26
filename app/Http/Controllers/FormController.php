<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FormController extends Controller
{
    /**
     * Show the form page
     */
    public function indexForm()
    {
        return view('form');
    }

    /**
     * Handle the form submission
     */
    public function submitForm(Request $request)
    {   
        // validate data
        $request->validate([
            'name' => 'required|string|min:3|max:255',
			'email' => 'required|string|email|max:255|unique:users',
            'file' => 'mimes:png,jpg,jpeg,gif|max:5000'
        ]);

        // create db entry
        $form = Form::create([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // get dropzone image
        if ($request->file('file')) {
            $file = $request->file('file');
            $filename = time().'_'.$file->getClientOriginalName();
            $request->file->storeAs('uploads/', $filename, 'public');
            $form->update([
                'image' => '/storage/uploads/'.$filename
            ]);
        }

        // return the result
        return response()->json($form);
    } 

}
