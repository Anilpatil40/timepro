<?php

namespace App\Http\Controllers;

use App\Models\Attemp;
use App\Models\Question;
use App\Models\Sector;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use stdClass;

class GameController extends Controller
{
    public function sectors($gameId)
    {
        $sectors = Sector::all();
        return view('games.sectors', ['sectors' => $sectors, 'gameId' => $gameId]);
    }

    public function userForm()
    {
        return view('games.user-form');
    }
    public function userFormSubmit(Request $request, $gameId, $sectorId)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
        ]);

        $user = User::query()->where('email', $request->get('email'))->first();
        if (!$user) {
            $user = new User();
            $user->name = $request->get('name');
            $user->email = $request->get('email');
            $user->password = Hash::make('password');
            $user->save();
        } else {
            $user->name = $request->get('name');
            $user->email = $request->get('email');
            $user->update();
        }
        Auth::login($user);

        $attempt = Attemp::where([
            'user_id' => Auth::user()->id,
        'gameId' => $gameId,
        'sectorId' => $sectorId,
        ])->first();

        if($attempt){
            return redirect()->back()->with('error', 'Already Attempted');
        }

        $questions = Question::whereRaw('FIND_IN_SET(?, sectors)', [$sectorId])->inRandomOrder()->take(10)->get();

        Attemp::create([
            'user_id' => $user->id,
            'gameId' => $gameId,
            'sectorId' => $sectorId,
            'correct' => 0,
            'outOf' => 10,
        ]);

        return  view('games.quize', compact('questions', 'gameId', 'sectorId'));
    }
    public function submit(Request $request, $gameId, $sectorId)
    {
        $answer = $request->get('answer');
        $qId = $request->get('qId');
        $questions = Question::where('id', $qId)->where('answer', $answer);
        if ($questions->count() > 0) {
            $attempt = Attemp::where([
                'user_id' => Auth::user()->id,
                'gameId' => $gameId,
                'sectorId' => $sectorId,
            ])->first();
            $attempt->correct += 1;
            $attempt->update();
            return response('SUCCESS');
        } else {
            return response('FAILURE', 400);
        }
    }
    public function result(Request $request, $gameId, $sectorId)
    {
        $attempt = Attemp::where([
            'user_id' => Auth::user()->id,
            'gameId' => $gameId,
            'sectorId' => $sectorId,
        ])->first();
        $score = $attempt->correct;
        $price = 0;
        $message = 'Sorry you scored 0';
        if ($gameId == 1) {
            if ($score >= 1 && $score <= 4) $price = 1000;
            if ($score >= 5 && $score <= 7) $price = 2500;
            if ($score >= 8 && $score <= 10) $price = 10000;
        } else {
            if ($score >= 1 && $score <= 4) $message = 'We appreciate your enthusiasm! However, we
            recommend investing more time in yourself. Enhance your skills with
            TimesPro';
            if ($score >= 5 && $score <= 7) $message = "You are nearly there! A little extra effort, and you'll be
            well-prepared in no time. Explore TimesPro programs to become job-ready";
            if ($score >= 8 && $score <= 10) $message = "Congratulations, you're job-ready! Visit TimesPro to
            discover programs that can jumpstart your career";
        }
        return view('games.score', compact('score', 'message', 'price', 'gameId'));
    }
}
