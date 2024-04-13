<?php

namespace App\Http\Controllers\MainDashboard\clients;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class AdminClientsController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        return view('clients.client_list' ,compact('clients'));
    }

    public function update(Request $request,Client $client){
        $request->validate([
            'is_banned' => ['required','boolean'],
        ]);
        $client->update([
            'is_banned' => $request->is_banned,
        ]);
        return response()->json(['Message'=>"Updated Successfully"]);
    }

    public function destroy(Client $client){
        if (!empty($client->image)) {
            $img = $client->image;
            $imagePath = public_path('clients_images/' . $img);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        $client->delete();
        return response()->json(['Message'=>"Deleted Successfully"]);
    }

    public function search(Request $request){
        $request->validate([
           'search' => ['required','string'],
        ]);
        $search = $request->search;
        $clients = Client::where('name', 'LIKE', '%'. $search. '%')
                            ->orWhere('email', 'LIKE', '%'. $search. '%')->get();
        if ($clients){
            return response()->json($clients);
        }else{
            return response()->json(['Message'=>"No Data Found"]);
        }
    }
}
