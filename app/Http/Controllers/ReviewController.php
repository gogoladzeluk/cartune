<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ReviewController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function showReviewForm($id)
    {
        $mechanic = User::getActiveMechanicById($id);
        return view('reviews.review', ['mechanic' => $mechanic]);
    }

    public function review($id, Request $request)
    {
        $request->merge([
            'user_id'     => Auth::id(),
            'mechanic_id' => $id,
        ]);
        $this->validator($request->all())->validate();

        Review::create($request->all());

        return redirect(route('mechanics.show', ['id' => $id]));
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'user_id'     => ['required', Rule::exists('users', 'id')],
            'mechanic_id' => ['required', Rule::exists('users', 'id')],
            'rating'      => ['required', 'integer', 'between:1,5'],
            'content'     => ['nullable', 'string', 'max:500'],
        ]);
    }
}
