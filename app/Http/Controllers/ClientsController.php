<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    public function index()
    {
        $clients = auth()->user()->clients;

        foreach ($clients as $client) {
            $client->append('bookings_count');
        }

        return view('clients.index', ['clients' => $clients]);
    }

    public function create()
    {
        return view('clients.create');
    }

    public function show($client)
    {
        $client = Client::with('bookings')->where('id', $client)->first();

        return view('clients.show', ['client' => $client]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:190',
            'email' => 'email|nullable|required_without:phone',
            'phone' => 'nullable|regex:/^\+?[0-9\s]+$/',
        ]);

        $client = $request->user()->clients()->create($validated);

        return $client;
    }

    public function destroy($client)
    {
        Client::where('id', $client)->delete();

        return 'Deleted';
    }
}
