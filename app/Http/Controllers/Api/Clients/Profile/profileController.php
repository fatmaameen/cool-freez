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
    protected $appUrl;
    public function __construct()
    {
        $this->appUrl = Config::get('app.url');
    }
    public function show(string $id)
    {
        $client = Client::find($id);
        return ClientInfoResource::make($client);
    }

    public function update(UpdateClientRequest $request, Client $client)
    {
        if ($request->has('image')) {
            $old_image = $client->image;
            $image = $request->file('image');
            if ($old_image == $this->appUrl . '/' . 'defaults_images' . '/' . 'image.png') {
                $image_name = $this->upload($image, 'clients_images');
                $client->update([
                    'image' => $image_name,
                ]);
            } else {
                if ($this->remove($old_image)) {
                    $image_name = $this->upload($image, 'clients_images');
                    $client->update([
                        'image' => $image_name,
                    ]);
                }
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
        $old_image = $client->image;
        if ($old_image == $this->appUrl . '/' . 'defaults_images' . '/' . 'image.png') {
            $client->delete();
            return  response()->json(['message' => 'Successfully deleted']);
        } else {
            if ($this->remove($old_image)) {
                $client->delete();
                return  response()->json(['message' => 'Successfully deleted']);
            } else {
                return  response()->json(['message' => 'Something went wrong']);
            }
        }
    }
}
