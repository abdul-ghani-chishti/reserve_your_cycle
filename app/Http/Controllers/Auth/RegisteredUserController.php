<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserDocuments;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        try {
//            dd($request->all());
            $uploadedImages = [];
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'have_cycle' => ['required']
            ]);

            DB::beginTransaction();
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'is_cycle' => $request->have_cycle,
            ]);

            if ($request->have_cycle)
            {
//                dd(1);
                if ($request->hasFile('matriculation')) {

                    foreach ($request->file('matriculation') as $image) {
                        // Generate unique file name
                        $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

                        // Store image in "public/uploads"
                        $image->move(public_path('user_docs'), $imageName);

                        // Store file path
                        $uploadedImages[] = 'user_docs/' . $imageName;
//                        dd($uploadedImages);
                    }
                }
//                dd($uploadedImages);
                foreach ($uploadedImages as $imagePath) {
//                    dd(1);
                    $userdoc = new UserDocuments();
                    $userdoc->user_id = $user->id;
                    $userdoc->user_docs_img_path = $imagePath;
                    $userdoc->save();
                }
            }

//            event(new Registered($user));
//            Auth::login($user);

            DB::commit();
            return redirect(route('login', absolute: false));
        } catch (Exception $ex)
        {
            DB::rollback();
            dd('something wrong',$ex);
        }
    }
}
