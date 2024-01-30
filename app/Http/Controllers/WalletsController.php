<?php

namespace App\Http\Controllers;


use App\Models\Wallet;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class WalletsController extends Controller
{
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $wallets = Wallet::where('user_id', auth()->user()->id)->get();
        return view('wallets.index', compact('wallets'));
    }

    public function show(Wallet $wallet): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('wallets.show', compact('wallet'));
    }

    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('wallets.create');
    }

    public function store(Request $request): RedirectResponse
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'currency_code' => 'required|exists:currencies,code',

        ]);

        $balance = 0;

        Wallet::create([
            'user_id' => auth()->user()->id,
            'name' => $validatedData['name'],
            'balance' => $balance,
            'currency_code' => $request->input('currency_code'),
            'opened_at' => now(),
        ]);


        return redirect()->route('wallets.index');
    }

    public function edit(wallet $wallet): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('wallets.edit', compact('wallet'));
    }

    public function update(Request $request, wallet $wallet): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $wallet->update(['name' => $validatedData['name']]);

        return redirect()->route('wallets.index', $wallet);
    }

    public function destroy(wallet $wallet): RedirectResponse
    {
        $wallet->delete();

        return redirect()->route('wallets.index');
    }
}
