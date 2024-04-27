<?php

namespace App\Http\Controllers\Dashboard\MainDashboard\clients;

use App\Models\Role;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Traits\ImageUploadTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;

class AdminClientsController extends Controller
{
    use ImageUploadTrait;
    protected $appUrl;
    public function __construct()
    {
        $this->appUrl = Config::get('app.url');
    }
    public function index()
    {
        $clients = Client::all();

        return view('MainDashboard.clients.client_list', compact('clients'));
    }
    public function banned(Request $request, Client $client)
    {
        $request->validate([
            'is_banned' => ['required'],
        ]);

        try {
            $client->update([
                'is_banned' => $request->is_banned,
            ]);

            // Notification here

            return redirect()->back()->with(['message' => 'Updated successfully']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['message' => 'Something went wrong' . $e->getMessage()], 500);
        }
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'is_banned' => ['required', 'boolean'],
        ]);
        Client::find($id)->update([
            'is_banned' => $request->is_banned,
        ]);
        return redirect()->back()->with(['Message' => "Updated successfully"]);
    }

    public function destroy(Client $client)
    {
        $old_image = $client->image;
        if ($old_image == $this->appUrl . '/' . 'defaults_images' . '/' . 'image.png') {
            $client->delete();
            return  redirect()->back()->with(['message' => 'Successfully deleted']);
        } else {
            if ($this->remove($old_image)) {
                $client->delete();
                return  redirect()->back()->with(['message' => 'Successfully deleted']);
            } else {
                return  redirect()->back()->with(['message' => 'Something went wrong']);
            }
        }
    }

    public function search(Request $request)
    {
        $request->validate([
            'search' => ['required', 'string'],
        ]);
        $search = $request->search;
        $clients = Client::where('name', 'LIKE', '%' . $search . '%')
            ->orWhere('email', 'LIKE', '%' . $search . '%')->get();
        if ($clients) {
            return redirect()->back()->with($clients);
        } else {
            return redirect()->back()->with(['Message' => "No Data Found"]);
        }
    }
}
