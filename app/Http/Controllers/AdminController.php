<?php

namespace App\Http\Controllers;

use Storage;
use Validator;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //change Password Page

    public function changePasswordPage()
    {
        return view('admin.account.changePassword');
    }

    //change password
    public function changePassword(Request $request)
    {
        /*
        1. all field must fill
        2. new password & confirm password must be greather than 6
        3. new password & confirm password must be same
        4. client old password must be same with db password
        5. password change
        */

        $this->passwordValidationCheck($request);
        $user = User::select('password')->where('id', Auth::user()->id)->first();
        $dbHashPassword = $user->password;

        if (Hash::check($request->oldPassword, $dbHashPassword)) {
            $changePassword = [
                'password' => Hash::make($request->newPassword)
            ];

            User::where('id', Auth::user()->id)->update($changePassword);

            // Auth::logout();
            // return redirect()->route('auth#loginPage');

            return redirect()->route('category#list')->with(['changeSuccess' => 'Password has changed!']);

        } else {
            return back()->with(['notMatch' => 'The old password not match. Try Again!']);
        }

        // $password = 'sithu';
        // $hashPassword = Hash::make('sithu');

        // if (Hash::check($password, $hashPassword)) {
        //     dd('password are same');
        // } else {
        //     dd("password aren't same");
        // }
    }

    // direct admin account details
    public function details()
    {
        return view('admin.account.details');
    }

    // direct admin account edit

    public function edit()
    {
        return view('admin.account.edit');
    }

    //update account
    public function update($id, Request $request)
    {
        $this->accountValidationCheck($request);
        $data = $this->getUserData($request);

        //for image
        if ($request->hasFile('image')) {
            // 1 get old img name | check => delete | store
            $dbImgName = User::where('id', $id)->first();
            $dbImgName = $dbImgName->image;

            if ($dbImgName != null) {
                Storage::delete('public/' . $dbImgName);
            }

            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $fileName);
            $data['image'] = $fileName;
        }

        User::where('id', $id)->update($data);
        return redirect()->route('admin#details')->with(['updateSuccess' => 'Account Updated...']);
    }

    //admin list
    public function list()
    {
        $admins = User::when(request('key'), function ($query) {
            $query->orWhere('name', 'like', '%' . request('key') . '%')
                ->orWhere('email', 'like', '%' . request('key') . '%')
                ->orWhere('phone', 'like', '%' . request('key') . '%')
                ->orWhere('gender', 'like', '%' . request('key') . '%')
                ->orWhere('address', 'like', '%' . request('key') . '%');
        })
            ->where('role', 'admin')
            ->paginate(3);
        $admins->appends(request()->all());
        return view('admin.account.list', compact('admins'));
    }

    // delete admin account
    public function delete($id)
    {
        $data = User::select('image')->where('id', $id)->first();
        $imgName = $data['image'];
        Storage::delete('public/' . $imgName);

        User::where('id', $id)->delete();
        return back()->with(['deletedSuccess' => 'Account Deleted !']);
    }

    //direct admin change role
    public function changeRole($id)
    {
        $account = User::where('id', $id)->first();
        return view('admin.account.changeRole', compact('account'));
    }

    //change role
    public function change(Request $request)
    {
        $roleChange = [
            'role' => $request->role
        ];
        User::where('id', $request->userId)->update($roleChange);
    }


    //request user data
    private function requestUserData($request)
    {
        return [
            'role' => $request->role
        ];
    }

    //get user data
    private function getUserData($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address,
            'updated_at' => Carbon::now()
        ];
    }

    //account validation check

    private function accountValidationCheck($request)
    {
        validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'image' => 'mimes:png,jpg,jpeg,webp|file',
            'address' => 'required',
        ])->validate();
    }

    //password validation check
    private function passwordValidationCheck($request)
    {
        validator::make($request->all(), [
            'oldPassword' => 'required|min:6|max:12',
            'newPassword' => 'required|min:6|max:12',
            'confirmPassword' => 'required|min:6|max:12|same:newPassword'
        ], [
                'oldPassword.required' => 'Password ဖြည့်ရန်လိုအပ်ပါသည်...',
                'newPassword.required' => 'Password အသစ် ဖြည့်ရန်လိုအပ်ပါသည်...',
                'confirmPassword.required' => 'Password အသစ်အတည်ပြုရန်လိုအပ်ပါသည်...',
                'oldPassword.min' => 'Password အနည်းဆုံး ၆ လုံးရှိရပါမည်...',
                'newPassword.min' => 'Password အသစ် အနည်းဆုံး ၆ လုံးရှိရပါမည်...',
                'confirmPassword.min' => 'Password အသစ်အတည်ပြု အနည်းဆုံး ၆ လုံးရှိရပါမည်...',
                'confirmPassword.same' => 'New Password နှင့် Confirm Password တူညီရပါမည်...',
                'oldPassword.max' => 'Password အနည်းဆုံ 6 လုံး နှင့် အများဆုံး 12 လုံးသာရှိရမည်...',
                'newPassword.max' => 'Password အနည်းဆုံ 6 လုံး နှင့် အများဆုံး 12 လုံးသာရှိရမည်...',
                'confirmPassword.max' => 'Password အနည်းဆုံ 6 လုံး နှင့် အများဆုံး 12 လုံးသာရှိရမည်...',
            ])->validate();
    }
}