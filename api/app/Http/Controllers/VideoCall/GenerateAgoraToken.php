<?php

namespace App\Http\Controllers\VideoCall;

use App\Helper\AgoraDynamicKey\RtcTokenBuilder;
use App\Http\Controllers\Controller;
use App\Http\Requests\VideoCall\GenerateAgoraTokenRequest;
use App\Http\Resources\StaffResource;
use App\Http\Resources\UserResource;
use App\Models\Interview;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GenerateAgoraToken extends Controller
{
    public function __invoke(GenerateAgoraTokenRequest $request, Interview $interview)
    {
        $interviewers = $interview->interviewers->pluck('user_id')->toArray();
        $canJoin = $interview->scheduler->user_id === Auth::id()
            || in_array(Auth::id(), $interviewers, true);
        abort_if(!$canJoin, 403, 'No permission to join this meeting');

        try {
            $appId = env('AGORA_APP_ID');
            $appCertificate = env('AGORA_APP_CERTIFICATE');
            $channelName = $request->input('channelName');
            $role = RtcTokenBuilder::RoleAttendee;
            $expireTimeInSeconds = 3600;
            $currentTimestamp = now()->getTimestamp();
            $privilegeExpiredTs = $currentTimestamp + $expireTimeInSeconds;
            $agoraToken = RtcTokenBuilder::buildTokenWithUserAccount($appId, $appCertificate, $channelName, 0, $role, $privilegeExpiredTs);

            return response()->json([
                'token' => $agoraToken,
            ], 200);
        } catch (Exception $e) {
            logger($e);
            return response()->json('false');
        }
    }
}
