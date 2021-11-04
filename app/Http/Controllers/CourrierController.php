<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Models\Courrier;

use App\Http\Resources\Courrier as CourrierResource;
use App\Http\Resources\CourrierCollection;
use Carbon\Carbon;

class CourrierController extends Controller
{
    public function index()
    {
        return new CourrierCollection(Courrier::all());
    }

    public function show($id)
    {
        return new CourrierResource(Courrier::findOrFail($id));
    }

    public function update($id, Request $request)

    {
        $courrier = Courrier::findOrFail($id);
        $courrier -> client = $request->input('client');	
        $courrier -> date = $request->input('date');
        $courrier -> status = $request->input('status');
        $courrier -> fileUrl = $request->input('fileUrl');
        $courrier -> departement_affecte = $request->input('departement_affecte');
        $courrier -> agent_affecte = $request->input('agent_affecte');
        //! maybe needed : $courrier-> update();
        

        $courrier->save();
        return new CourrierResource($courrier);
        
         
    }

    public function store(Request $request)
    {
        if ($request->has('file')) {
            $file = $request->file('file');
        }
        $date = Carbon::now()->toDateString();
        $filename = $request->input('client').'_'.$date.'.'.$file->getClientOriginalExtension();
        move_uploaded_file($_FILES['file']['tmp_name'], 'uploaded/'.$filename);

        $phpDate = $request->input('date');
        $dbDate = date('Y-m-d', strtotime(str_replace('-', '/', $phpDate)));

        $courrier = Courrier::create([
            'client' => $request->input('client'),
            'date' => $dbDate,
            'status' => 'AFF',
            'fileUrl' => 'uploaded/'.$filename,
            'departement_affecte'  => $request->input('departement'),
            'agent_affecte'  => $request->input('agent')]
        );

        return (new CourrierResource($courrier))
                ->response()
                ->setStatusCode(201); // needed for testing
    }

    public function delete($id)
    {
        $courrier = Courrier::findOrFail($id);
        $courrier->delete();

        return response()->json(null, 204); //testing :) 
    }
}
