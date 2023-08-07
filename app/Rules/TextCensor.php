<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Luffy\TextCensor\Core;

class TextCensor implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (env('COMMENT_TEXT_CENSOR') && env('BAIDU_APP_ID') && env('BAIDU_API_KEY') && env('BAIDU_SECRET_KEY')) {
            $client = new Core(env('BAIDU_APP_ID'), env('BAIDU_API_KEY'), env('BAIDU_SECRET_KEY'));
            $result = $client->textCensorUserDefined($value);
            if ($result['conclusionType'] !== 1) {
                if (isset($result['data'][0]['hits'][0]['words'][0])) {
                    $fail(__('This :attribute contains the sensitive word :sensitive', ['attribute' => $attribute, 'sensitive' => $result['data'][0]['hits'][0]['words'][0]]));
                } else {
                    $fail($result['data'][0]['msg']);
                }
            }
        }
    }
}
