<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class LikeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
//        dd(\request()->tweet_id);
        return [
            'user_id' => 'required|unique:likes,user_id,NULL,id,tweet_id,' . \request()->tweet_id,
            'tweet_id' => 'required|unique:likes,tweet_id,NULL,id,user_id,' . \request()->user_id,
//            'user_id' => 'required|unique:likes',
//            'tweet_id' => 'required|unique:likes'
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //
        ];
    }
}
