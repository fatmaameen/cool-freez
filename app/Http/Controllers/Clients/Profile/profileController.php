<?php

namespace App\Http\Controllers\Clients\Profile;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Clients\UpdateClientRequest;
use App\Http\Resources\Clients\ClientInfoResource;

class profileController extends Controller
{
    public function show(string $id)
    {
        $client = Client::find($id);
        return ClientInfoResource::make($client);
    }

    public function update(UpdateClientRequest $request, Client $client)
    {
        if ($request->has('image')) {
            $img = $client->image;
            $imagePath = public_path('clients_images/' . $img);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            $new_image = $request->file('image');
            $image_name = time() . $new_image->getClientOriginalName();
            $new_image->move(public_path('clients_images'), $image_name);
            $client->update([
                'image' => $image_name,
                //  'image' => url('clients_images/' . $image_name),
            ]);
        };

        if ($request->has('password')) {
            $client->update([
                'password' => Hash::make($request->password),
            ]);
        };

        $client->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number
        ]);
        return response()->json(['message' => 'client updated successfully'], 200);
    }

    public function destroy(Client $client)
    {
        $img = $client->image;
        $imagePath = public_path('clients_images/' . $img);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        $client->delete();
        return response()->json(['message' => 'client deleted successfully'], 200);
    }
}
