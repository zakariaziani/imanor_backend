<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departement;

use App\Http\Resources\Departement as DepartementResource;
use App\Http\Resources\DepartementCollection;



class DepartementController extends Controller
{
    public function index()
    {
        return new DepartementCollection(Departement::all());
    }

    public function show($id)
    {
        return new DepartementResource(Departement::findOrFail($id));
    }

    public function update($id, Request $request)

    {
        $departement = Departement::findOrFail($id);
        $departement -> id = $request->input('id');
        $departement -> departement = $request->input('departement');	
        $departement -> sigle = $request->input('sigle');
        $departement -> chef_id = $request->input('chef_id');
        $departement -> parent = $request->input('parent');
        //! maybe needed : $departement-> update();
        

        $departement->save();
        return new DepartementResource($departement);
        
         
    }

    public function store(Request $request)
    {

        $departement = Departement::create($request->all());

        return (new DepartementResource($departement))
                ->response()
                ->setStatusCode(201); // needed for testing
    }

    public function delete($id)
    {
        $departement = Departement::findOrFail($id);
        $departement->delete();

        return response()->json(null, 204); //testing :) 
    }
}
