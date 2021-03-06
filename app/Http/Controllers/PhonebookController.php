<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhonebookRequest;
use App\Phonebook;
use Illuminate\Http\Request;

class PhonebookController extends Controller
{
    //  protected $filable = [tn, name, lastname, patronymic];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index ()
    {
        return view('phonebook');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create ()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    // заменяем обычный Request на PhonebookRequest
    public function store (PhonebookRequest $request)
    {

        $pb = new Phonebook();
        $pb->tn = $request->tn;
        $pb->name = $request->name;
        $pb->lastname = $request->lastname;
        $pb->patronymic = $request->patronymic;
        $pb->birthday = $request->birthday;
        $pb->phone_mobile = $request->phone_mobile;
        $pb->phone_home = $request->phone_home;

        $pb->save();


        /* if ($request!='') {
             $phonebook = $request.
         }*/
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Phonebook $phonebook
     * @return \Illuminate\Http\Response
     */
    public function show (Phonebook $phonebook)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Phonebook $phonebook
     * @return \Illuminate\Http\Response
     */
    public function edit (Phonebook $phonebook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Phonebook $phonebook
     * @return \Illuminate\Http\Response
     */
    public function update (Request $request, Phonebook $phonebook)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Phonebook $phonebook
     * @return \Illuminate\Http\Response
     */
    public function destroy (Phonebook $phonebook)
    {
        //
    }
}
