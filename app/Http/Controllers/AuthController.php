<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Traits\HttpResponse;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\ForgotPasswordRequest;

class AuthController extends Controller
{
    use HttpResponse;
    public function login(LoginUserRequest $request){

        $request->validated($request->all());
        if (!Auth::attempt($request->only('email', 'password'))) {
            return $this->error('', 'Credentials do not match', 401); //user is not authorized
        }

        // uncomment this for token
        $user = User::where('email',$request->email)->first();
        return $this->success([
            'user' => $user,
            'token' => $user->createToken('Api Token of '.$user->name)->plainTextToken,
            
        ]);
        // return response()->json('Login Endpoint');
        // for debug
        
    }

    public function register(StoreUserRequest $request){
        // return response()->json('register Endpoint');
        $request->validated($request->all());
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'name' => $request->name,
            'matric' => $request->matric,
            'speciality' => $request->speciality,
            'about' => $request->about,
        ]);

        return $this->success([
            'user' => $user,
            'token' => $user->createToken('API token of '.$user->name)->plainTextToken,
        ]);
    }
    public function logout(){
        Auth::user()->currentAccessToken()->delete();
        return $this->success([
            'message' => 'You have successfully been logged out, Token Deleted Successfully!'
        ]);
    }

    // forgot password
    public function forgotPassword(ForgotPasswordRequest $request){
        try {
            $request->validated($request->all());
            $user = User::where('email',$request->email)->first();
            if($user){
                $token = $user->createToken('Reset Password Token for '.$user->name)->plainTextToken;
                $domain = URL::to('/');
                $url = $domain."/reset-password"."/".$token."/".$user->id;

                $data['url'] = $url;
                $data['email'] = $request->email;
                $data['title'] = 'Reset your UTM password';
                $data['body'] = 'Please Click the link below to reset your password.';

                Mail::send('reset-password', ['data'=>$data], function ($message) use ($data) {
                    // $message->from('john@johndoe.com', 'John Doe');
                    // $message->sender('john@johndoe.com', 'John Doe');
                    $message->to($data['email'])->subject($data['title']);
                    // $message->cc('john@johndoe.com', 'John Doe');
                    // $message->bcc('john@johndoe.com', 'John Doe');
                    // $message->replyTo('john@johndoe.com', 'John Doe');
                    // $message->subject('Subject');
                    // $message->priority(3);
                    // $message->attach('pathToFile');
                });

                $datetime = Carbon::now()->format('Y-m-d H:i:s');
                PasswordReset::updateOrCreate(
                    ['email' => $request->email],
                    [
                        'email' => $request->email,
                        'token' => $token,
                        'created_at' => $datetime
                    ]
                );

                
                return $this->success([
                    'user' => $user,
                    // 'token' => $user->createToken('Api Token of '.$user->name)->plainTextToken,
                    'message' => 'Password reset link sent to your mail'
                    
                ]);
            }else{
                return $this->error('', 'There is no user/email record corresponding to this identifier', 404); //email is not recognized
            }    
        } catch (\Throwable $th) {

            return $this->error('', $th->getMessage(), 404); //user is not authorized
        }
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // reset
    public function update(ResetPasswordRequest $request){
        $request->validated($request->all());
        // uncomment this for token
        $user = User::find($request->id);
        
        // return $this->success([
        //     'user' => $user->name,
        //     'data' => $user->password
        // ]);
        if($user){
            $user->password = Hash::make($request->password);
            $user->save();
            return $this->success([
                'user' => $user,
                'message'=>'You Successfully Reset your password...',
                'token' => $user->createToken('Api Token of '.$user->name)->plainTextToken,
                
            ]);
        }else{
            return $this->error('', 'Check your credentials before submitting!', 401);
        }
        
    }

    public function updateProfile(UpdateProfileRequest $request){
        $request->validated($request->all());
        // uncomment this for token
        $user = User::find($request->id);
        // return Hash::make($request->password);
        if($user->email == $request->email && Hash::check($request->current_password, $user->password)){
            $user->password = Hash::make($request->new_password);
            $user->name = $request->name;
            $user->save();
            return $this->success([
                'user' => $user,
                'message'=>'You Successfully Reset your password...',
                'token' => $user->createToken('Api Token of '.$user->name)->plainTextToken,
                
            ]);
        }else{
            return $this->error('', 'Check your credentials before submitting!', 401);
        }
    }

    // working on delete
    // public function destroy(User $users)
    // {
    //     // $task->delete();
    //     // return response(null, 204);
    //     return $users;
    //     // return $this->isNotAuthorized($users) ? $this->isNotAuthorized($users) :  $users->delete();
    // }
    // private function isNotAuthorized($users){
    //     if(Auth::user()->id !== $users->user_id) {
    //         return $this->error('', 'you are not Authorized to make this request', 403);
    //     }
    // }
}
