<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use OpenApi\Attributes as OA;

class VerifyEmailController extends Controller
{
    #[OA\Get(
        path: '/email/verify/{id}/{hash}',
        description: 'Verify a user\'s email address.',
        summary: 'Verify a user\'s email address',
        tags: ['Auth'],
        responses: [
            new OA\Response(response: 302, description: 'Redirect'),
        ]
    )]
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(
                config('app.frontend_url').RouteServiceProvider::HOME.'?verified=1'
            );
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return redirect()->intended(
            config('app.frontend_url').RouteServiceProvider::HOME.'?verified=1'
        );
    }
}
