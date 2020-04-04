<?php

namespace App\Rules;

use App\Claim;
use Illuminate\Contracts\Validation\Rule;

class ClaimInterval implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     *
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $claims = Claim::on()
                       ->where('user_id', auth()->user()->id)
                       ->whereDate('created_at', '>', now()->subDay())
                       ->get();

        return $claims->isEmpty();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'За сутки можно создать не более одной заявки.';
    }
}
