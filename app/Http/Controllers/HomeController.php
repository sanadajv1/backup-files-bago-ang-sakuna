<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Str;


use Barryvdh\DomPDF\Facade\Pdf;

class HomeController extends Controller
{
    public function home()
    {
        $order=order::orderBy('created_at', 'desc')->get();

        $usertype=Auth::user()->usertype;

        if($usertype=='1')
        {


                $completedOrders = Order::where('order_status', 'Order Completed')
                ->select('id', 'quantity', 'created_at') // Adjust these fields based on your Order model
                ->orderBy('created_at', 'desc')
                ->get();

            // Calculate total quantity
            $totalQuantity = $completedOrders->sum('quantity');

            return view('admin.home', compact('completedOrders', 'totalQuantity', 'order'));


        }
        else
        {
            return view('home.userpage');
        }
    }

    public function index()
    {
        return view ('YearnArt.Home');
    }
    public function About(){
        return view ('YearnArt.About');



    }

    public function Products(){
    //pag hindi naka login yung user
    $categories = Category::all();
    $products = Product::all();

    return view('YearnArt.Products', compact( 'categories', 'products'));

    }


    public function product_details($id)
    {
    //pag hindi naka login yung user
    $products=product::find($id);
    return view('YearnArt.Product_Details', compact('products'));


    // PAg naka login yung users


    }

    public function add_cart(Request $request, $id) {
        if (Auth::id()) {
            $user = Auth::user();
            $products = Product::find($id);
            $cart=Cart::find($id);




            $secondaryclr = $request->secondaryColor;
            $primaryclr = $request->colorOption;

            switch ($request->sizeOption) {
                case 'small':
                        $size = $products->small_size;
                    break;
                case 'medium':
                        $size = $products->medium_size;
                    break;
                case 'large':
                        $size = $products->large_size;
                    break;
            }
            switch ($request->secondaryColor) {
                case 'A3D0EF':
                        $secondaryclr = 'A3D0EF';
                    break;
                case 'D66B78':
                        $secondaryclr = 'D66B78';
                    break;
                case 'D4D66B':
                        $secondaryclr = 'D4D66B';
                    break;
                case '6BD689':
                        $secondaryclr = '6BD689';
                    break;
                case 'D6986B':
                        $secondaryclr = 'D6986B';
                    break;
                case 'D46BD6':
                        $secondaryclr = 'D46BD6';
                    break;
                case 'none':
                        $secondaryclr = 'none';
                    break;
            }
            switch ($request->colorOption) {
                case 'A3D0EF':
                        $primaryclr = '67598E';
                    break;
                case 'D66B78':
                        $primaryclr = 'D66B78';
                    break;
                case 'D4D66B':
                        $primaryclr = 'D4D66B';
                    break;
                case '6BD689':
                        $primaryclr = '6BD689';
                    break;
                case 'D6986B':
                        $primaryclr = 'D6986B';
                    break;
                case 'D46BD6':
                        $primaryclr = 'D46BD6';
                    break;

            }





            $existingCartItem = Cart::where('user_id', $user->id)
            ->where('product_id', $products->id)
            ->where('secondaryclr', $secondaryclr)
            ->where('primaryclr', $primaryclr)

            ->where('size', $size)
            ->first();


            if ($existingCartItem) {
                // Update the quantity if the same product is found
                $existingCartItem->quantity += $request->quantity;
                $existingCartItem->save();
            } else {
                // Create a new cart item if the product with the same attributes is not found
                $cart = new Cart;

                $cart->name = $user->name;
                $cart->email = $user->email;
                $cart->phone = $user->phone;
                $cart->address = $user->address;
                $cart->user_id = $user->id;
                $cart->product_name = $products->product_name;
                $cart->category = $products->category;
                $cart->price = $products->price;
                $cart->processing_time = $products->processing_time;
                $cart->image = $products->image;
                $cart->product_id = $products->id;
                $cart->quantity = $request->quantity;
                $cart->primaryclr = $request->colorOption;
                $cart->secondaryclr = $request->secondaryColor;

                // Set the size and price based on the selected sizeOption
                switch ($request->sizeOption) {
                    case 'small':
                        if ($products->small_price !== null) {
                            $cart->price = $products->small_price;
                            $cart->size = $products->small_size;
                        }
                        break;
                    case 'medium':
                        if ($products->medium_price !== null) {
                            $cart->price = $products->medium_price;
                            $cart->size = $products->medium_size;
                        }
                        break;
                    case 'large':
                        if ($products->large_price !== null) {
                            $cart->price = $products->large_price;
                            $cart->size = $products->large_size;
                        }
                        break;
                    default:
                        // Handle the case where sizeOption does not match any condition
                        // You may want to set a default value or handle it as needed
                        $cart->price = 0; // Set a default value for the price
                        break;
                }


                $cart->save();
            }

            return redirect()->back()->with('message', 'Added to Cart');
        } else {
            return redirect('login');
        }
    }



    public function show_cart(){

        if(Auth::id()){
        $id=Auth::user()->id;

        $cart=cart::where('user_id', '=', $id)->orderBy('created_at', 'desc')->get();

        return view('YearnArt.MyOrders', compact('cart'));


        }
        else{
            return redirect('login');
        }


    }
    public function remove_cart($id){

        $cart=cart::find($id);

        $cart->delete();

        return redirect()->back()->with('message', 'Successfully Deleted');
    }

    public function cash_order(Request $request){

        $user=Auth::user();

        $userid=$user->id;


        $data=cart::where('user_id','=', $userid)->get();


        foreach($data as $data){

            $quantity = $request->input('quantity.' . $data->id);

            $orderId = strtoupper(Str::random(10));

            $order=new order;



                $order->name=$data->name;
                $order->email=$data->email;
                $order->phone=$data->phone;
                $order->address=$data->address;
                $order->user_id=$data->user_id;


                $order->order_id = $orderId;
                $order->product_name=$data->product_name;
                $order->category=$data->category;
                $order->quantity = $quantity;
                $order->price = $data->price;
                $order->image=$data->image;
                $order->processing_time=$data->processing_time;
                $order->primaryclr=$data->primaryclr;
                $order->secondaryclr=$data->secondaryclr;
                $order->size=$data->size;
                $order->product_id=$data->product_id;




                $order->order_status='Downpayment';

            $order->save();

            $cart_id=$data->id;
            $cart=cart::find($cart_id);
            $cart->delete();


        }

        return redirect()->back()->with('message', 'Successfully Placed Order');

    }

    // start of order tracking (not specific)

    public function show_orders(){
        if(Auth::id()){
            $id=Auth::user()->id;

            $order=order::where('user_id', '=', $id)->orderBy('created_at', 'desc')->get();

            return view('YearnArt.Order-Tracking.ShowOrders', compact('order'));


            }
            else{
                return redirect('login');
            }


    }



    public function show_pending(){
        if(Auth::id()){
            $id=Auth::user()->id;

            $order=order::where('user_id', '=', $id)->orderBy('created_at', 'desc')->get();

            return view('YearnArt.Order-Tracking.pending', compact('order'));


            }
            else{
                return redirect('login');
            }


    }

    public function show_Dpayment(){
        if(Auth::id()){
            $id=Auth::user()->id;

            $order=order::where('user_id', '=', $id)->orderBy('created_at', 'desc')->get();

            return view('YearnArt.Order-Tracking.Dpayment', compact('order'));


            }
            else{
                return redirect('login');
            }


    }

    public function show_on_process(){
        if(Auth::id()){
            $id=Auth::user()->id;

            $order=order::where('user_id', '=', $id)->orderBy('created_at', 'desc')->get();

            return view('YearnArt.Order-Tracking.OnProcess', compact('order'));


            }
            else{
                return redirect('login');
            }


    }

    public function show_Fpayment(){
        if(Auth::id()){
            $id=Auth::user()->id;

            $order=order::where('user_id', '=', $id)->orderBy('created_at', 'desc')->get();

            return view('YearnArt.Order-Tracking.Fpayment', compact('order'));


            }
            else{
                return redirect('login');
            }


    }

    public function show_shipping(){
        if(Auth::id()){
            $id=Auth::user()->id;

            $order=order::where('user_id', '=', $id)->orderBy('created_at', 'desc')->get();

            return view('YearnArt.Order-Tracking.Shipping', compact('order'));


            }
            else{
                return redirect('login');
            }


    }
    public function show_order_received(){
        if(Auth::id()){
            $id=Auth::user()->id;

            $order=order::where('user_id', '=', $id)->orderBy('created_at', 'desc')->get();

            return view('YearnArt.Order-Tracking.OrderReceived', compact('order'));


            }
            else{
                return redirect('login');
            }


    }

    public function show_order_completed(){
        if(Auth::id()){
            $id=Auth::user()->id;

            $order=order::where('user_id', '=', $id)->orderBy('created_at', 'desc')->get();

            return view('YearnArt.Order-Tracking.OrderCompleted', compact('order'));


            }
            else{
                return redirect('login');
            }


    }
// end of order tracking (not specific)
//show specific na order (track order clinick ni customer)

    public function track_Sorder($id)
    {
        if(Auth::id()){
            $order = order::find($id);

        if (!$order) {
            // Handle the case where the order is not found
            return redirect()->route('track_orders')->with('error', 'Order not found');
        }

        // Get the order status
        $orderStatus = $order->order_status;

        // Check the order status and redirect accordingly
        switch ($orderStatus) {
            case 'Order Placed':
                return view('YearnArt.Specific-Order-Tracking.SPending', compact('order'));
            case 'Downpayment':
                return view('YearnArt.Specific-Order-Tracking.SDpayment', compact('order'));
            case 'On Process':
                return view('YearnArt.Specific-Order-Tracking.SOnProcess', compact('order'));
            case 'To Pay':
                return view('YearnArt.Specific-Order-Tracking.SFpayment', compact('order'));
            case 'Shipping':
                return view('YearnArt.Specific-Order-Tracking.Sshipping', compact('order'));
            case 'Order Received':
                return view('YearnArt.Specific-Order-Tracking.SOrderReceived', compact('order'));
            case 'Order Completed':
                return view('YearnArt.Specific-Order-Tracking.SOrderCompleted', compact('order'));
            // Add more cases for other order statuses

            default:
                // Handle the case where the order status is not recognized
                return redirect()->route('track_orders')->with('error', 'Unknown order status');

        }
        }
                    else{
        return redirect('login');
        }

    }
    // //pag hindi naka login yung user
    // $order=order::find($id);
    // return view('YearnArt.track_Sorder', compact('order'));




    public function receive_order($id){

        $order=order::find($id);

        $order->order_status="Order Received";
        $order->order_received_at=now();

        $order->save();

        return view('YearnArt.Specific-Order-Tracking.SOrderReceived', compact('order'));


    }

    public function fullpayment_receipt($id){
        $order=order::find($id);

        $data = [
            'title' => 'Sales Invoice',
            'date' => date('Y-m-d'),
            'orderid' => $order->order_id,
            'image' => public_path('logo/YearnArt.png'),
            'order' => $order,
            'peso' => '₱',
        ];



        $pdf = Pdf::loadView('admin.fpayment_receipt', $data);
        return $pdf->download('Sales Invoice.pdf');

    }

    public function cancel_order($id){

        $order=order::find($id);

        $order->order_status="Cancel Order";


        $order->save();

        return view('YearnArt.Specific-Order-Tracking.SOrderReceived', compact('order'));


    }


    public function fullpayment_receipt_edit(){

        $order=order::get();

        $data = [
            'title' => 'Downpayment Receipt',
            'date' => date('Y-m-d'),
            'orderid' => 'Order ID',
        ];
        return view('admin.fpayment_receipt', compact('data','order'));


    }








}
