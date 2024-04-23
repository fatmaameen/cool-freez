<?php

namespace App\Http\Controllers\Api\Clients\Profile;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;
use App\Http\Requests\Api\Clients\UpdateClientRequest;
use App\Http\Resources\Api\Clients\ClientInfoResource;
use App\Traits\ImageUploadTrait;

class profileController extends Controller
{
    use ImageUploadTrait;
    public function show(string $id)
    {
        $client = Client::find($id);
        return ClientInfoResource::make($client);
    }

    public function update(UpdateClientRequest $request, Client $client)
    {
        if ($request->has('image')) {
            $old_image = $client->image;
            if ($this->remove($old_image)){
                $new_image = $request->file('image');
                $image_name = $this->upload($new_image, 'clients_images');
                $client->update([
                    'image' => $image_name,
                ]);
            }
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
        return response()->json(['message' => 'Successfully updated']);
    }

    public function destroy(Client $client)
    {
        $image = $client->image;
        if ($this->remove($image)){
            $client->delete();
            return  redirect()->back()->with(['message' => 'Successfully deleted']);
        } else {
            return  redirect()->back()->with(['message' => 'Something went wrong']);
        }
    }
}
