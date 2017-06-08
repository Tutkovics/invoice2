<?php

namespace App\Http\Controllers;

use App\Bill;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;


class UserController extends Controller
{

    public function showProfilePicture()
    {
        if( Auth::user()->picture)
        {
            $file = Storage::get("public/img/" . Auth::user()->id . ".jpg");
            $size = Storage::size("public/img/" . Auth::user()->id . ".jpg");

            return \Response::make($file, 200, [
                'Content-Type' => 'image/jpeg',
                'Content-Length' => $size,
                'Content-Disposition' => 'inline; filename="picture.jpg'
            ]);
        } else
        {
            // has no uploaded picture
            $file = Storage::get("public/img/unknown.jpg");
            $size = Storage::size("public/img/unknown.jpg");

            return \Response::make($file, 200, [
                'Content-Type' => 'image/jpeg',
                'Content-Length' => $size,
                'Content-Disposition' => 'inline; filename="picture.jpg'
            ]);
        }
    }

    public function uploadProfilePicture(Request $request)
    {
        //upload profile picture
        if ($request->file('profilepicture')->isValid()) {

            $image = \Image::make( \File::get($request->file('profilepicture')));
            $image->orientate();
            $edited = $image->encode('jpg');

            $user = Auth::user();

            $imageName = $user->id . '.jpg';

            $user->picture = true;
            $user->save();


            Storage::put('public/img/'.$imageName, $edited);

            return redirect()->route('showUser');
        }
    }

    // auth sch
    public function redirect(){
        return Socialite::with('sch')->redirect();
    }

    public function callback(){
        $user = Socialite::with('sch')->user();

        $res = User::where('authsch_id', $user->provideUserId)->get();

        if( $res->count() == 0){
            $newUser = new User();
            $newUser->nick = $user->name;
            $newUser->email = $user->email;
            $newUser->authsch_id = $user->provideUserId;

            $newUser->save();

            Auth::login( $newUser );
        } else {
            Auth::login($res->first());
        }

        return redirect()->route('myBills');
    }

    public function getDashboard(){
        return view('dashboard');
    }

    public function getShowUser(){
        //return bcrypt(' ');
        return view('showProfile');
    }

    public function postUpdateUser(Request $request){
        //Mi a faszért nem megy????
        $this->validate($request, [
            'name' => 'required|max:120',
            'password' => 'max:120',
            'authpassword' => 'required',
            'email' => 'null',
        ]);

        if( Hash::check($request->authpassword, Auth::user()->password) ){

            User::where('id', Auth::user()->id)->update(['nick' => $request->name]);

            if( ! $request->password ){
                //need update password
                User::where('id', Auth::user()->id)->update(['password' => bcrypt($request->password) ]);
            }

            return redirect()->route('showUser');
        } else {

            return redirect()->route('showUser');
        }
    }

    public function getLogin()
    {
        // show the form
        return view('form');
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    public function postLogin(Request $request)
    {
        // process the form

        //validating
        $this->validate($request, [
            'email' => 'required|email|max:120',
            'password' => 'required|min:4|max:120'
        ]);


        //autehnticateion
        if( Auth::attempt( ['email' => $request['email'], 'password' => $request['password']] )) {
            $user_id = $request->user()->id;
            //$bills = DB::table('bills')->where('user_id', 1);

            return redirect()->route('myBills',['id' => $user_id]);
        }
        return "Nincs ilyen felhasználó/jelszó páros";

    }

    public function postSignUp(Request $request)
    {
        //validating
        $this->validate($request, [
            'email' => 'required|email|max:120|unique:users',
            'nick' => 'required|max:120|min:2',
            'again_password' => 'required|max:120',
            'password' => 'required|min:4|max:120|same:again_password'
        ]);

        // store the new user
        $pass = $request['password'];
        $again = $request['again_password'];

        if( $pass != $again ){
            //not necessary  because of laravel validation
            $error = 'Egyeznie kell a két jelszónak! <a href="\login">Vissza</a>';
            return $error;
        } else {
            // "correct datas"

            $user = new User();
            $user->nick = $request['nick'];
            $user->email = $request['email'];
            $user->password = bcrypt($pass);

            $user->save();

            return 'Mostmár be tudsz <a href="\login"> jelentkezni</a>!';
        }

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
