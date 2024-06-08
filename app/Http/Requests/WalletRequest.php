<?php

namespace App\Http\Requests;

use App\Enums\WalletStatus;
use App\Models\Wallet;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WalletRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => [
                'required', 'string','max:255',
                Rule::unique('wallets')->where(function ($query) {
                    return $query->where('user_id', $this->user()->id);
                })->ignore($this->route('wallet')->id ?? null)
            ],
            'description' => 'nullable|string',
            'status' => 'required|in:' . implode(',', WalletStatus::all()),
        ];
    }
}
