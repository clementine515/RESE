<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateReservationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'reservation_date' => 'required',
            'reservation_time' => 'required',
            'guest_count' => 'required',
            'menu' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'reservation_date.required' => '予約日付を選択してください！',
            'reservation_time.required' => '予約時間を選択してください！',
            'guest_count.required' => '人数を選択してください！',
        ];
    }
}
