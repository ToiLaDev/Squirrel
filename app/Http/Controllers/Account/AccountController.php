<?php namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function profile()
    {
        return baseView('account.profile');
    }

    public function referral()
    {
        return baseView('account.referral');
    }

    public function general(Request $request)
    {
        $datas = $request->only(['first_name', 'last_name', 'email', 'phone', 'birthday', 'gender']);

        if ($datas['email'] != $this->user->email && User::where('email', $datas['email'])->count() > 0) {
            unset($datas['email']);
        }

        $this->user->fill($datas);
//        if ($request->has('address')) {
//            $request->user()->address = $request->input('address');
//        }
        $this->user->save();
        return back()->with('success', 'Your info changed successfully!');
    }

    public function password(Request $request)
    {
        $datas = $request->only(['password', 'new-password', 'confirm-new-password']);

        if (
            Hash::check($datas['password'], $this->user->password)
            && strlen($datas['new-password']) > 7
            && $datas['new-password'] == $datas['confirm-new-password']
        ) {
            $this->user->fill([
                'password' => Hash::make($datas['new-password'])
            ])->save();

            return back()->with('success', 'Password changed successfully!');
        }
        else {
            return back()->withErrors(['password' => 'Password change failed']);
        }
    }
}
