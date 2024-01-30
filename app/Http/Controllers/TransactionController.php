<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function store(Request $request): RedirectResponse
    {

        $validatedData = $request->validate([
            'from_wallet_id' => 'required|exists:wallets,id',
            'to_wallet_id' => 'required|exists:wallets,id',
            'amount' => 'required|numeric|min:1',
        ]);

        $fromWallet = Wallet::findOrFail($validatedData['from_wallet_id']);
        $toWallet = Wallet::findOrFail($validatedData['to_wallet_id']);


        if ($fromWallet->user_id !== Auth::user()->id) {
            return redirect()->back();
        }


        if ($fromWallet->balance < $validatedData['amount']) {
            return redirect()->back();
        }


        $exchangeRate = $this->getExchangeRate($fromWallet->currency_code, $toWallet->currency_code);


        if ($exchangeRate === null) {
            return redirect()->back();
        }

        $convertedAmount = $validatedData['amount'] * $exchangeRate;

        $fromWallet->decrement('balance', $validatedData['amount']);
        $toWallet->increment('balance', $convertedAmount);

        $this->createTransaction(
            $fromWallet,
            'out',
            $validatedData['amount'],
        );

        $this->createTransaction(
            $toWallet,
            'in',
            $convertedAmount,
        );

        return redirect()->route('wallets.index');
    }

    private function getExchangeRate(string $fromCurrency, string $toCurrency): ?float
    {
        if ($fromCurrency === $toCurrency) {
            return 1;
        }

        $fromRate = Currency::where('code', $fromCurrency)->value('rate');
        $toRate = Currency::where('code', $toCurrency)->value('rate');

        return $toRate / $fromRate;
    }

    private function createTransaction
    (
        Wallet $wallet,
        string  $direction,
        string  $amount,
    ): void
    {
        $wallet->transactions()->create([
            'user_id' => Auth::user()->id,
            'type' => 'transfer',
            'amount' => $amount,
            'direction' => $direction,
            'timestamp' => now(),
        ]);
    }

    public function create()
    {
        $wallets = Wallet::where('user_id', auth()->user()->id)->get();
        return view('wallets.transaction', compact('wallets'));
    }

    public function destroy(Transaction $transaction): RedirectResponse
    {
        $transaction->delete();

        return redirect()->back();
    }
    public function markAsFraudulent(Transaction $transaction): RedirectResponse
    {
        $transaction->update(['fraudulent' => true]);

        return redirect()->back();
    }
}
