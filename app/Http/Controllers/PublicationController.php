<?php

namespace App\Http\Controllers;

use App\Http\Resources\PublicationResource;
use App\Publication;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);

        $publication = Publication::create([
            'name' => $request->name,
        ]);

        return response()->json(new PublicationResource($publication), 201);
    }

    public function show(Publication $publication)
    {
        return response()->json(new PublicationResource($publication), 200);
    }

    public function update(Publication $publication)
    {
        $publication->name = request('name');
        $publication->save();

        return response()->json(new PublicationResource($publication), 200);
    }

    public function destroy(Publication $publication)
    {
        $publication->delete();
        return response()->json(null, 204);
    }
}
