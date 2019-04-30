<?php

namespace App\Http\Controllers;

use App\Http\Requests\Notifications\PushSubscriptionDelete;
use App\Http\Requests\Notifications\PushSubscriptionUpdate;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;

class PushSubscriptionController extends Controller
{
    use ValidatesRequests;
    public function update(PushSubscriptionUpdate $request)
    {
        $this->validate($request, ['endpoint' => 'required']);
        $request->user()->updatePushSubscription(
            $request->endpoint,
            $request->key,
            $request->token
        );
    }
    public function destroy(PushSubscriptionDelete $request)
    {
        $this->validate($request, ['endpoint' => 'required']);
        $request->user()->deletePushSubscription($request->endpoint);
        return response()->json(null, 204);
    }
}