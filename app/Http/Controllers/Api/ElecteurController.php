<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Validator;

use App\Models\Role;
use App\Models\Permission;

use App\Models\Electeur;
use App\Models\User;

class ElecteurController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('role:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->user()->hasRole('super_admin')) {
            $Electeurs = Electeur::all();
        }
        else{           
            $user_id = $request->user()->id;
            $Electeurs = Electeur::where('user_id', $user_id);                      
        }
        return response()->json(["success" => true, "message" => "Electeur List", "data" =>$Electeurs]);
        
    }

    /**
     * Store a newly created resource in storagrolee.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $user_id = $request->user()->id;

        $validator = Validator::make($input, ['numero_cin' => 'required|unique:electeurs,numero_cin','numero_electeur' => 'required|unique:electeurs,numero_electeur','region' => 'required','departement' => 'required','commune' => 'required','prenom' => 'required','nom' => 'required','date_expiration' => 'required','numero_electeur_responsable' => 'required','prenom_responsable' => 'required','nom_responsable' => 'required']);

        if ($validator->fails())
        {
            return response()
            ->json($validator->errors());
        }
        else{ 
                       
            $Electeur = Electeur::create(
                ['numero_cedeao'=>$input['numero_cedeao'],
                'prenom'=>$input['prenom'],
                'nom'=>$input['nom'],
                'date_naissance'=>$input['date_naissance'],
                'lieu_naissance'=>$input['lieu_naissance'],
                'taille'=>$input['taille'],
                'sexe'=>$input['sexe'],
                'numero_electeur'=>$input['numero_electeur'],
                'centre_vote'=>$input['centre_vote'],
                'bureau_vote'=>$input['bureau_vote'],
                'numero_cin'=>$input['numero_cin'],
                'telephone'=>$input['telephone'],
                'date_expiration'=>$input['date_expiration'],
                'numero_electeur_responsable'=>$input['numero_electeur_responsable'],
                'prenom_responsable'=>$input['prenom_responsable'],
                'nom_responsable'=>$input['nom_responsable'],
                'telephone_responsable'=>$input['telephone_responsable'],
                'region'=>$input['region'],
                'departement'=>$input['departement'],
                'commune'=>$input['commune'],
                'status'=>'actif',
                'lot'=>'reserve',
                'user_id'=>$user_id]
            );

            return response()->json(["success" => true, "message" => "Electeur enregistré avec succès."]);
        }

           
    
        
  
        
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Electeur = Electeur::get()
        ->find($id);
        if (is_null($Electeur))
        {
   /*          return $this->sendError('Product not found.'); */
            return response()
            ->json(["success" => true, "message" => "Electeur not found."]);
        }
        return response()
            ->json(["success" => true, "message" => "Electeur retrieved successfully.", "data" => $Electeur]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Electeur $Electeur)
    {
        $input = $request->all();

        $user_id = $request->user()->id;

        $validator = Validator::make($input, ['numero_cin' => 'required','numero_electeur' => 'required','region' => 'required','departement' => 'required','commune' => 'required','prenom' => 'required','nom' => 'required','date_expiration' => 'required','numero_electeur_responsable' => 'required','prenom_responsable' => 'required','nom_responsable' => 'required']);

        if ($validator->fails())
        {
            return response()
            ->json($validator->errors());
        }
        else{

            $Electeur->numero_cedeao = $input['numero_cedeao'];
            $Electeur->prenom = $input['prenom'];
            $Electeur->nom = $input['nom'];
            $Electeur->date_naissance = $input['date_naissance'];
            $Electeur->lieu_naissance = $input['lieu_naissance'];
            $Electeur->taille = $input['taille'];
            $Electeur->sexe = $input['sexe'];
            $Electeur->numero_electeur = $input['numero_electeur'];
            $Electeur->centre_vote = $input['centre_vote'];
            $Electeur->bureau_vote = $input['bureau_vote'];
            $Electeur->numero_cin = $input['numero_cin'];
            $Electeur->date_expiration = $input['date_expiration'];
            $Electeur->numero_electeur_responsable = $input['numero_electeur_responsable'];
            $Electeur->telephone = $input['telephone'];
            $Electeur->prenom_responsable = $input['prenom_responsable'];
            $Electeur->nom_responsable = $input['nom_responsable'];
            $Electeur->telephone_responsable = $input['telephone_responsable'];
            $Electeur->region = $input['region'];
            $Electeur->departement = $input['departement'];
            $Electeur->commune = $input['commune'];
            

            $Electeur->save();

            

            return response()
                ->json(["success" => true, "message" => "Electeur updated successfully.", "data" => $Electeur]);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Electeur $Electeur)
    {
        $Electeur->delete();
        return response()
            ->json(["success" => true, "message" => "Electeur supprimé.", "data" => $Electeur]);
    }
}
