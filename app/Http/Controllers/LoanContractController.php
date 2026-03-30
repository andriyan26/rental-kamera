<?php

namespace App\Http\Controllers;

use App\Models\LoanContract;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoanContractController extends Controller
{
    public function memberShow()
    {
        if ((int) Auth::user()->role !== 0) {
            return redirect()->route('admin.kontrak.index');
        }

        $user = Auth::user();
        $contract = $this->ensureContract($user);

        return view('member.kontrak', [
            'contract' => $contract,
            'user' => $user,
        ]);
    }

    public function adminIndex()
    {
        $penyewa = User::where('role', 0)
            ->with('loanContract')
            ->orderBy('name')
            ->get();

        return view('admin.kontrak.index', [
            'penyewa' => $penyewa,
        ]);
    }

    public function adminEdit(User $user)
    {
        if ((int) $user->role !== 0) {
            abort(404);
        }

        $contract = $this->ensureContract($user);

        return view('admin.kontrak.edit', [
            'targetUser' => $user,
            'contract' => $contract,
        ]);
    }

    public function adminUpdate(Request $request, User $user)
    {
        if ((int) $user->role !== 0) {
            abort(404);
        }

        $contract = $this->ensureContract($user);

        $validated = $request->validate([
            'contract_text' => 'required|string|max:65535',
        ]);

        $this->assertLateFeeClause($validated['contract_text']);

        $contract->update(['contract_text' => $validated['contract_text']]);

        return redirect()->route('admin.kontrak.edit', $user)->with('success', 'Kontrak cadangan penyewa berhasil diperbarui.');
    }

    private function ensureContract(User $user): LoanContract
    {
        return LoanContract::firstOrCreate(
            ['user_id' => $user->id],
            ['contract_text' => LoanContract::defaultContractText()]
        );
    }

    private function assertLateFeeClause(string $text): void
    {
        $lower = mb_strtolower($text);
        if (mb_strpos($lower, 'denda') === false || mb_strpos($lower, 'terlambat') === false || mb_strpos($lower, 'pembayaran') === false) {
            throw ValidationException::withMessages([
                'contract_text' => 'Kontrak wajib mencantumkan ketentuan denda atas keterlambatan pembayaran (minimal menyertakan kata: denda, terlambat, pembayaran).',
            ]);
        }
    }
}
