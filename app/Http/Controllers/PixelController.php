<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pixel;
use App\Models\GoogleTags;
use App\Services\FacebookConversionService;

class PixelController extends Controller
{
    protected $facebookConversionService;

    public function index()
    {
        $pixels = Pixel::all();
        $tags = GoogleTags::all();
        return view('admin.pixel', compact('pixels', 'tags'));
    }

    public function __construct(FacebookConversionService $facebookConversionService)
    {
        $this->facebookConversionService = $facebookConversionService;
    }

    public function sendEvent(Request $request)
    {
        $eventName = $request->input('event_name');
        $eventData = $request->input('event_data');

        $response = $this->facebookConversionService->sendEvent($eventName, $eventData);

        return response()->json($response);
    }

    public function store(Request $request)
    {
        $request->validate([
            'pixel_id' => 'required|string|max:255|unique:pixels,pixel_id',
            'pixel_token' => 'required|string',
            'name' => 'nullable|string|max:255',
        ]);

        Pixel::create([
            'pixel_id' => $request->pixel_id,
            'name' => $request->name,
            'token' => $request->pixel_token,
        ]);

        return redirect()->back()->with('success', 'Pixel do Facebook salvo com sucesso!');
    }

    public function destroy($id)
    {
        $pixel = Pixel::findOrFail($id);
        $pixel->delete();

        return redirect()->back()->with('success', 'Pixel deletado com sucesso!');
    }


    public function GoogleStore(Request $request)
    {
        $request->validate([
            'tag_id' => 'required|string|max:255|unique:google_tags,tag_id',
            'tag_token' => 'required|string',
            'name' => 'nullable|string|max:255',
        ]);

        GoogleTags::create([
            'tag_id' => $request->tag_id,
            'name' => $request->name,
            'token' => $request->tag_token,
        ]);

        return redirect()->back()->with('success', 'Tag do Google salvo com sucesso!');
    }

    public function Googledestroy($id)
    {
        $tag = GoogleTags::findOrFail($id);
        $tag->delete();

        return redirect()->back()->with('success', 'tag deletado com sucesso!');
    }
}
