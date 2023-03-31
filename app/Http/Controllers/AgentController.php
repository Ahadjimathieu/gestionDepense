<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Agent;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAgentRequest;
use App\Http\Requests\UpdateAgentRequest;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return Inertia::render("Agents/Index",[
            'agents' => Agent::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Agents/Create',[
            'agents' => Agent::paginate(5)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAgentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "nom" => "required",
            "prenom" => "required",
            "adresse" => "required",
            "telephone" => "required|min:8|max:11",
            "date_embauche" => "required|min:8|max:11",

        ]);
        $agent = new Agent();
        $agent->nom = $request->nom;
        $agent->prenom = $request->prenom;
        $agent->adresse = $request->adresse;
        $agent->telephone = $request->telephone;
        $agent->date_embauche = $request->date_embauche;


        $agent->save();
        return redirect()->route('agent.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function show(Agent $agent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function edit(Agent $agent)
    {
        
        $agentEdit = Agent::find($agent->id);
        return Inertia::render("Agents/Edit",[
            'agent' => $agent,
            'agents' => Agent::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAgentRequest  $request
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAgentRequest $request, Agent $agent)
    {
        $agent->update(
            $request->validate([
                'nom' => 'required',
                'prenom' => 'required',
                'adresse' => 'required',
                'telephone' => 'required',
                'date_embauche' => 'required',
            ])
            );

        return redirect()->route('agent.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agent $agent)
    {
        //
    }
}
