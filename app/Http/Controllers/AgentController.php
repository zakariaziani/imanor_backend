<?php

namespace App\Http\Controllers;

use App\Models\Agent;

use App\Http\Resources\Agent as AgentResource;
use App\Http\Resources\AgentCollection;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;

class AgentController extends Controller 
{
    public function index()
    {
        return new AgentCollection(Agent::all());
    }

    public function show($id)
    {
        return new AgentResource(Agent::findOrFail($id));
    }

    public function update($id, Request $request)

    {
        $agent = Agent::findOrFail($id);
        $agent -> nom = $request->input('nom');	
        $agent -> prenom = $request->input('prenom');
        $agent -> email = $request->input('email');
        $agent -> password = Hash::make($request->input('password'));
        $agent -> departement = $request->input('departement');
        $agent -> role = $request->input('role');
        //! maybe needed : $agent-> update();
        

        $agent->save();
        return new AgentResource($agent);
        
         
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
            'role' => 'required',
        ]);

        $agent = Agent::create(
            [
                'nom' => $request->input('nom'),
                'prenom' => $request->input('prenom'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'departement' => $request->input('departement'),
                'role' => $request->input('role'),
            ]
        );

        return (new AgentResource($agent))
                ->response()
                ->setStatusCode(201); // needed for testing
    }

    public function delete($id)
    {
        $agent = Agent::findOrFail($id);
        $agent->delete();

        return response()->json(null, 204); //testing :) 
    }


    // login function uses the automatic authentication provided by laravel
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email','password'))) {
            return response([
                'message' => 'invalid credentials',
            ], 401);
        }

        $agent = Auth::user();
        $token = $agent->createToken('agentToken')->plainTextToken;
        $cookie = cookie('jwt', $token, 60*24);

        // return response(['message'=>'authenticated'])->withCookie($cookie);
        return response([
            'accessToken' => $token,
            'user' => $agent
        ],200);
    }

    public function register(Request $request)
    {
        $agent = Agent::create([
            'nom' => $request->input('nom'),
            'prenom' => $request->input('prenom'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'departement' => $request->input('departement'),
            'role' => $request->input('role'),

        ]);

        return response()->json('user added :)', 201);
    }


    public function profile()
    {
        return Auth::user();
    }


    public function logout()
    {
        $cookie = Cookie::forget('jwt');
        //the front end will no longer have access to the cookie therefor do nothing with it
        return response([
            'message' => 'Logged Out'
        ])->withCookie($cookie);
    }

}
