<?php

use App\Models\LoanContract;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanContractsTable extends Migration
{
    public function up()
    {
        Schema::create('loan_contracts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();
            $table->longText('contract_text');
            $table->timestamps();
        });

        foreach (User::cursor() as $user) {
            LoanContract::firstOrCreate(
                ['user_id' => $user->id],
                ['contract_text' => LoanContract::defaultContractText()]
            );
        }
    }

    public function down()
    {
        Schema::dropIfExists('loan_contracts');
    }
}
