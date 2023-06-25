<?php

namespace App\Http\Controllers\User;

use App\Models\Contact;
use App\Models\Order;
use Storage;
use Validator;
use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //direct user home page
    public function home()
    {
        $pizzas = Product::orderBy('created_at', 'desc')->get();
        $category = Category::get();
        $carts = Cart::where('user_id', Auth::user()->id)->get();
        $orders = Order::where('user_id', Auth::user()->id)->get();

        return view('user.main.home', compact('pizzas', 'category', 'carts', 'orders'));
    }

    //direct user list
    public function userList()
    {
        $users = User::where('role', 'user')->paginate(4);
        return view('admin.user.list', compact('users'));
    }

    //change user role
    public function userChangeRole(Request $request)
    {
        $updateData = [
            'role' => $request->role
        ];
        User::where('id', $request->userId)->update($updateData);
    }

    //delete user from admin Page
    public function deleteUser(Request $request)
    {
        Storage::delete('public/' . $request->userImg);

        User::where('id', $request->userId)->delete();
    }

    //direct user change password page
    public function changePasswordPage()
    {
        return view('user.password.change');
    }

    // user password change
    public function change(Request $request)
    {
        $this->passwordValidationCheck($request);
        $user = User::select('password')->where('id', Auth::user()->id)->first();
        $dbHashValue = $user->password;

        if (Hash::check($request->oldPassword, $dbHashValue)) {
            $data = [
                'password' => Hash::make($request->newPassword)
            ];
            User::where('id', Auth::user()->id)->update($data);

            return redirect()->route('user#home')->with(['changeSuccess' => 'Password has changed !']);
        } else {
            return back()->with(['notMatch' => 'The old password not match. Try Again!']);
        }
    }

    //account change page
    public function accountChangePage()
    {
        return view('user.profile.account');
    }

    //filter pizza
    public function filter($categoryId)
    {
        $pizzas = Product::where('category_id', $categoryId)->orderBy('created_at', 'desc')->get();
        $category = Category::get();
        $carts = Cart::where('user_id', Auth::user()->id)->get();
        $orders = Order::where('user_id', Auth::user()->id)->get();
        return view('user.main.home', compact('pizzas', 'category', 'carts', 'orders'));
    }

    //pizza details
    public function pizzaDetails($pizzaId)
    {
        $pizzas = Product::where('id', $pizzaId)->first();
        $pizzaList = Product::get();
        return view('user.main.details', compact('pizzas', 'pizzaList'));
    }

    // user change account
    public function accountChange($id, Request $request)
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
        return back()->with(['updateSuccess' => 'Account Successfully Updated ...']);
    }


    //direct cart list
    public function cartList()
    {
        $cartLists = Cart::select('carts.*', 'products.name as pizza_name', 'products.price as pizza_price', 'products.image as product_image')
            ->leftJoin('products', 'products.id', 'carts.product_id')
            ->where('carts.user_id', Auth::user()->id)
            ->get();

        $totalPrice = 0;
        foreach ($cartLists as $cartList) {
            $totalPrice += $cartList->pizza_price * $cartList->qty;
        }

        return view('user.main.cart', compact('cartLists', 'totalPrice'));
    }


    //direct history page
    public function history()
    {
        $orders = Order::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(5);
        return view('user.main.history', compact('orders'));
    }

    //direct contact Page
    public function contactPage()
    {
        return view('user.contact.contact');
    }

    // customer sent message
    public function messageSent(Request $request)
    {
        $this->messageValidation($request);
        $messages = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
        ];
        Contact::create($messages);
        return back()->with(['success' => 'Message Sent Success']);
    }

    //message validation check
    private function messageValidation($request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'message' => 'required'
        ], [
                'name.required' => 'Please Fill Your Name...',
                'email.required' => 'Please Fill Your Email...',
                'message.required' => 'Please Fill Your Message...'
            ])->validate();
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
}