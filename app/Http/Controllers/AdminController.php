<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;


use Illuminate\Support\Facades\Notification;

use App\Notifications\YearnArtNotification;


class AdminController extends Controller
{

    public function admin_dashboard(){
        $order=order::orderBy('created_at', 'desc')->get();

        $completedOrders = Order::where('order_status', 'Order Completed')
        ->select('id', 'quantity', 'created_at') // Adjust these fields based on your Order model
        ->orderBy('created_at', 'desc')
        ->get();

    // Calculate total quantity
    $totalQuantity = $completedOrders->sum('quantity');

    return view('admin.home', compact('completedOrders', 'totalQuantity', 'order'));




    }
    public function view_category()
    {
        $data=category::all();

        return view('admin.category', compact('data'));
    }

    public function add_category(Request $request)
    {
        $data = new Category;
        $data->category_name = $request->category;
        $data->save();

        return redirect()->back()->with('message', 'Category Added Successfully');
    }

    public function delete_category($id){
        $data=category::find($id);
        $data->delete();

        return redirect()->back()->with('message', 'Category Deleted Successfully');
    }

    public function view_product(){
        $category=category::all();
        return view('admin.product', compact('category'));

    }
        public function add_product(Request $request){
            $category = Category::find($request->category);


        $product = new product;

        $product->product_name=$request->product_name;
        $product->product_description=$request->product_description;
        $product->small_price=$request->small_price;
        $product->medium_price=$request->medium_price;
        $product->large_price=$request->large_price;
        $product->small_size=$request->small_size;
        $product->medium_size=$request->medium_size;
        $product->large_size=$request->large_size;
        $product->processing_time=$request->processing_time;
        $product->category = $category->category_name;
        $product->category_id = $request->category;
        $image = $request->file('image');
        $imagename=time().'.'.$image->getClientOriginalExtension();

        $request->image->move('product',$imagename);
        $product->image=$imagename;

        $product->save();

        return redirect()->back()->with('message', 'Product Added Successfully');;


        }
    public function show_product(){
        $product=product::all();
      return view ('admin.show_product', compact('product'));
    }

    public function delete_product($id){
        $product=product::find($id);
        $product->delete();

        return redirect()->back()->with('message', 'Product Deleted Successfully');
    }

    public function update_product($id){
        $product=product::find($id);

        $category=category::all();
      return view ('admin.update_product', compact('product','category'));
    }

    public function  update_product_confirm(Request $request, $id){
        $product=product::find($id);


        $product->product_name=$request->product_name;
        $product->product_description=$request->product_description;
        $product->small_price=$request->small_price;
        $product->medium_price=$request->medium_price;
        $product->large_price=$request->large_price;
        $product->small_size=$request->small_size;
        $product->medium_size=$request->medium_size;
        $product->large_size=$request->large_size;
        $product->processing_time=$request->processing_time;
        $product->category=$request->category;

        $image = $request->image;
        if($image){
            $imagename=time().'.'.$image->getClientOriginalExtension();

            $request->image->move('product',$imagename);
            $product->image=$imagename;
        }
        $product->save();
        return redirect()->back()->with('message', 'Product Updated Successfully');
    }

    public function order(){
        $order=order::all();



        return view ('admin.order', compact('order'));
    }


    public function pending(){
        $order=order::all();

        return view ('admin.pending', compact('order'));
    }
    public function dpayment(){
        $order=order::all();

        return view ('admin.dpayment', compact('order'));
    }
    public function onprocess(){
        $order=order::all();

        return view ('admin.onprocess', compact('order'));
    }


    public function to_dpay($id){

        $order = Order::find($id); // Assuming your model is named Order, not order
        $order->order_status = "Downpayment";
        $order->save();

        $details = [
            'subject' => 'Down Payment Requirement',
            'greeting' => 'greeting',
            'firstline' => 'firstline',
            'button' => 'Track Order',
            'url' => 'http://127.0.0.1:8000/track_Sorder/' . $id,
            'lastline' => 'lastline',
        ];

        Notification::send($order, new YearnArtNotification($details));

        return redirect()->back();
    }
    public function to_onprocess($id){

        $order=order::find($id);

        $order->order_status="On Process";

        $order->save();

        $details = [

            'subject' => 'Downpayment Paid',
            'greeting' => 'greeting',
            'firstline' => 'firstline',
            'button' => 'Print Receipt',
            'url' => 'http://127.0.0.1:8000/track_Sorder/' . $id,
            'lastline' => 'lastline',
        ];

        Notification::send($order, new YearnArtNotification($details));


        return redirect()->back();
    }
    public function to_fpay($id){

        $order=order::find($id);

        $order->order_status="To Pay";

        $order->save();
        $details = [
            'subject' => 'On Process Done (Mag babayad na)',
            'greeting' => 'greeting',
            'firstline' => 'firstline',
            'button' => 'Track Order',
            'url' => 'http://127.0.0.1:8000/track_Sorder/' . $id,
            'lastline' => 'lastline',
        ];

        Notification::send($order, new YearnArtNotification($details));

        return redirect()->back();
    }
    public function to_ship($id){

        $order=order::find($id);

        $order->order_status="Shipping";
        $order->save();

        $details = [
            'subject' => 'Full Payment Done (Will Ship)',
            'greeting' => 'greeting',
            'firstline' => 'firstline',
            'button' => 'Track Order',
            'url' => 'http://127.0.0.1:8000/track_Sorder/' . $id,
            'lastline' => 'lastline',
        ];

        Notification::send($order, new YearnArtNotification($details));



        return redirect()->back();
    }


    public function customer_list(){
        $order=order::all();



        return view ('admin.customerlist', compact('order'));
    }

    public function search(Request $request){

        $searchtext= $request->search;

        $order=order::where('name','LIKE', "%$searchtext%")
        ->orWhere('email','LIKE', "%$searchtext%")
        ->orWhere('product_name','LIKE', "%$searchtext%")
        ->orWhere('size','LIKE', "%$searchtext%")
        ->orWhere('order_id','LIKE', "%$searchtext%")
        ->get();


        return view('admin.order', compact('order'));
    }

    public function searchDpayment(Request $request){

        $searchtext= $request->search;

        $order=order::where('name','LIKE', "%$searchtext%")
        ->orWhere('email','LIKE', "%$searchtext%")
        ->orWhere('product_name','LIKE', "%$searchtext%")
        ->orWhere('size','LIKE', "%$searchtext%")
        ->orWhere('order_id','LIKE', "%$searchtext%")
        ->get();


        return view('admin.dpayment', compact('order'));
    }
    public function to_order_completed($id){

        $order=order::find($id);

        $order->order_status="Order Completed";
        $order->completed_at=now();

        $order->save();

        $details = [

            'subject' => 'Order Completed',
            'greeting' => 'Dear ' . $order['name'] . ',',
            'firstline' => '
            We are delighted to inform you that your order has been successfully completed! Thank you for choosing Yearn Art for your purchase. To view and print your receipt, click on the following button:',
            'button' => 'Print Receipt',
            'url' => 'http://127.0.0.1:8000/fullpayment_receipt/' . $id,
            'lastline' => 'lastline',
        ];

        Notification::send($order, new YearnArtNotification($details));


        return redirect()->back();
    }


// chart
public function get_data(Request $request)
{
    // Get the selected year from the request or use the current year as a default
    $selectedYear = $request->input('selected_year', date('Y'));

    $monthLabels = [
        'Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'
    ];

    // Initialize an array with zero values for each month
    $completedOrders = array_fill_keys($monthLabels, 0);

    // Fetch data from the database and update the array
    $ordersData = Order::where('order_status', 'Order Completed')
        ->whereYear('completed_at', $selectedYear) // Filter by the selected year
        ->selectRaw('MONTH(completed_at) as month, SUM(quantity) as total_quantity')
        ->groupBy(DB::raw('MONTH(completed_at)'))
        ->get();

    foreach ($ordersData as $data) {
        $completedOrders[$monthLabels[$data->month - 1]] = $data->total_quantity;
    }

    return response()->json(['data' => array_values($completedOrders), 'labels' => $monthLabels]);
}

public function get_data_category(Request $request)
{
    // Get the selected year from the request or use the current year as a default
    $selectedYear = $request->input('selected_year', date('Y'));

    // Get all distinct categories from the database
    $allCategories = Order::distinct()->pluck('category');

    // Initialize category counts array with all categories set to 0
    $categoryCountsArray = $allCategories->mapWithKeys(function ($category) {
        return [$category => 0];
    })->toArray();

    // Fetch data from the database and update the array
    $categoryCounts = Order::whereYear('created_at', $selectedYear) // Filter by the selected year
        ->selectRaw('category, COUNT(*) as total')
        ->groupBy('category')
        ->get();

    // Update the counts for categories with orders
    foreach ($categoryCounts as $categoryCount) {
        $categoryCountsArray[$categoryCount->category] = $categoryCount->total;
    }

    return response()->json(['data' => $categoryCountsArray, 'selected_year' => $selectedYear]);
}







}
