<?php

namespace App\Http\Controllers;

use App\Models\Speler;
use App\Models\Bericht;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($ontvangerEmail)
    {
        $afzender = auth()->user();

        // Haal de ontvanger op basis van email
        $ontvanger = Speler::where('email', $ontvangerEmail)->firstOrFail();

        // Haal alle berichten tussen afzender en ontvanger
        $berichten = Bericht::where(function($q) use ($afzender, $ontvanger) {
                $q->where('afzender_id', $afzender->id)
                  ->where('ontvanger_id', $ontvanger->id);
            })->orWhere(function($q) use ($afzender, $ontvanger) {
                $q->where('afzender_id', $ontvanger->id)
                  ->where('ontvanger_id', $afzender->id);
            })
            ->orderBy('created_at', 'asc')
            ->get();

        // Markeer ongelezen berichten van de ontvanger als gelezen
        Bericht::where('afzender_id', $ontvanger->id)
            ->where('ontvanger_id', $afzender->id)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        // Haal alle unieke gesprekspartners op
        $allSenderIds = Bericht::where('ontvanger_id', $afzender->id)->pluck('afzender_id');
        $allReceiverIds = Bericht::where('afzender_id', $afzender->id)->pluck('ontvanger_id');
        $allIds = $allSenderIds->merge($allReceiverIds)->unique()->toArray();

        $gesprekken = Speler::whereIn('id', $allIds)->get();

        // Sorteer de gesprekken op basis van het meest recente bericht
        $gesprekken = $gesprekken->sortByDesc(function ($gesprek) use ($afzender) {
            return Bericht::where(function($q) use ($afzender, $gesprek) {
                    $q->where('afzender_id', $afzender->id)->where('ontvanger_id', $gesprek->id);
                })->orWhere(function($q) use ($afzender, $gesprek) {
                    $q->where('afzender_id', $gesprek->id)->where('ontvanger_id', $afzender->id);
                })
                ->max('created_at');
        });

        // Bepaal voor elk gesprek of er ongelezen berichten zijn
        $gesprekken->transform(function($gesprek) use ($afzender) {
            $unreadCount = Bericht::where('afzender_id', $gesprek->id)
                ->where('ontvanger_id', $afzender->id)
                ->whereNull('read_at')
                ->count();

            $gesprek->has_unread = $unreadCount > 0;
            return $gesprek;
        });

        return view('chat.index', compact('berichten', 'ontvanger', 'gesprekken'));
    }

    public function store(Request $request, $ontvangerEmail)
    {
        $afzender = auth()->user();
        $ontvanger = Speler::where('email', $ontvangerEmail)->firstOrFail();

        $request->validate([
            'inhoud' => 'required|string',
        ]);

        Bericht::create([
            'afzender_id' => $afzender->id,
            'ontvanger_id' => $ontvanger->id,
            'inhoud' => $request->inhoud,
        ]);

        return redirect()->route('chat.show', $ontvanger->email);
    }

    public function search(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $speler = Speler::where('email', $request->email)->first();

        if (!$speler) {
            return redirect()->back()->withErrors('Geen speler gevonden met dit e-mailadres.');
        }

        return redirect()->route('chat.show', $speler->email);
    }
}
