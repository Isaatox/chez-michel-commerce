<?php


namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UtilisateurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewUtilisateur()
    {
        $users = User::paginate(10);

        return view('admin.utilisateurDetail', compact('users'));
    }
    

    public function getUtilisateur(Request $request, $id)
    {
        $user = User::find($id);
        return view('admin.utilisateurModifier', ['user' => $user]);
    }

    public function modifierUtilisateur(Request $request, $id)
    {
    $user = User::find($id);
    
    $request->validate([
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'password' => 'nullable|string|min:8|confirmed',
        'role' => 'required|in:admin,client',
    ]);

    $user->nom = $request->nom;
    $user->prenom = $request->prenom;
    $user->email = $request->email;
    if (!empty($request->password)) {
        $user->password = bcrypt($request->password);
    }
    $user->role = $request->role;
    $user->save();

    return redirect()->route('utilisateur')
        ->with('success', 'L\'utilisateur a été modifié avec succès.');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function supprimerUtilisteur($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
    
        return redirect()->route('utilisateur')->with('success', 'Utilisateur supprimé avec succès');
    }
}
