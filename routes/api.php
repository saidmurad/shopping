<?php

//use Request;
use Illuminate\Http\Request;
 use Illuminate\Support\Facades\Auth;
use App\category;
use App\item;
use App\order;
use App\User;
use App\deliveryAddress;
use App\deliveryLocation;


Route::group(['middleware' => 'api'], function(){

    //these routes are to hundle edit categry page

  // Fetch categorys
Route::get('category', function(){
    return category::latest()->orderBy('created_at', 'desc')->get();
  });
  
  //for home page
  Route::get('homeCategory', function(){
    return DB::table('categories')->orderBy('name', 'desc')->get();
  });

  // Get Single category
  Route::get('category/{id}', function($id){
    return category::findOrFail($id);
  });

  // Add category
  Route::post('category/store', function(Request $request){
    return category::create(['name' => $request->input(['name']), 'description' => $request->input(['description']), 'image' => $request->input(['image'])]);
  });

  

  // Update category
  Route::patch('category/{id}', function(Request $request, $id){
   // $image =  $request['file']->getClientOriginalName();
    //$path = $request['file']->storeAs('public/categories', $image);
    category::findOrFail($id)->update(['name' =>$request->input(['name']) , 'description' => "hhh", 'image' => "check"]);
   // return $request->input(['name']);
  });

  // Delete category
  Route::delete('category/{id}', function($id){
     return category::destroy($id);

  });



//these routes are to hundle edit item page

Route::get('item', function(){
    return item::latest()->orderBy('created_at', 'desc')->get();
  });
 
  // Get Single item
  Route::get('item/{id}', function($id){
    return item::findOrFail($id);
    
  });
 
  // Add item
//   Route::post('item/store', function(Request $request){
//     return item::create(['name' => 'dove', 'description' => 'se', 'image','price' => 32,'isDeleted' =>'No','category_id' =>1]);
//   });
Route::post('item/store', function(Request $request){
    return item::create(['name' => $request->input(['name']), 'description' => $request->input(['description']), 'image' => $request->input(['image']),'price' => $request->input(['price']),'isDeleted' =>'no','category_id'=>3 ]);
  });
  

 
 
 
 
  // Update item
  Route::patch('item/{id}', function(Request $request, $id){
    item::findOrFail($id)->update(['name' => $request->input(['name']), 'description' => $request->input(['description']), 'image' => $request->input(['image']),'price' => $request->input(['price'])]);
  });
 
  // Delete item
  Route::delete('item/{id}', function($id){
   return item::destroy($id);
    //return $id;
  });

  // Add category2
  Route::post('category/store2', function(Request $request){
    // return category::create(['name' => $request->input(['name']), 'description' => $request->input(['description']), 'image' => $request->file('file')->getClientOriginalName()]);
    // $image = Input::file('file')->getClientOriginalName();
     $image =  $request['file']->getClientOriginalName();
     $path = $request['file']->storeAs('public/categories', $image);
    return category::create(['name' => $request->input(['name']), 'description' => $request->input(['description']), 'image' => $request['file']->getClientOriginalName()]);
    
    
  });

  // Add item in a given category
  Route::post('item/store2', function(Request $request){
    // return category::create(['name' => $request->input(['name']), 'description' => $request->input(['description']), 'image' => $request->file('file')->getClientOriginalName()]);
    // $image = Input::file('file')->getClientOriginalName();
     $image =  $request['file']->getClientOriginalName();
     $path = $request['file']->storeAs('public/items', $image);
    return item::create(['name' => $request->input(['name']), 'description' => $request->input(['description']), 'category_id' => $request->input(['category_id']), 'price' => $request->input(['price']),'isDeleted' =>'no' ,  'image' => $request['file']->getClientOriginalName(), 'barcode' => $request->input(['barcode'])]);
    });

    //for update category
    Route::post('category/store4', function(Request $request){
      // return category::create(['name' => $request->input(['name']), 'description' => $request->input(['description']), 'image' => $request->file('file')->getClientOriginalName()]);
      // $image = Input::file('file')->getClientOriginalName();
       $image =  $request['file']->getClientOriginalName();
       $path = $request['file']->storeAs('public/categories', $image);
      return category::create(['id' => $request->input(['id']),'name' => $request->input(['name']), 'description' => $request->input(['description']), 'image' => $request['file']->getClientOriginalName()]);
      
      });


      //for update item
      Route::post('item/store4', function(Request $request){
        // return category::create(['name' => $request->input(['name']), 'description' => $request->input(['description']), 'image' => $request->file('file')->getClientOriginalName()]);
        // $image = Input::file('file')->getClientOriginalName();
         $image =  $request['file']->getClientOriginalName();
         $path = $request['file']->storeAs('public/items', $image);
        return item::create(['id' => $request->input(['id']),'name' => $request->input(['name']), 'description' => $request->input(['description']), 'category_id' => $request->input(['category_id']), 'price' => $request->input(['price']),'isDeleted' =>'no' ,  'image' => $request['file']->getClientOriginalName()]);
        });


  // Get  items for a given categoryId
  Route::get('items', function(Request $request){
    $id = $request->query('id');
    return App\category::find($id)->items;
  });

  // Get  category for a given categoryId
  Route::get('category1', function(Request $request){
    $id = $request->query('id');
    return category::findOrFail($id);
  });
 
//store order in order table
Route::post('order/store2', function(Request $request){
dd( $request->all());
//$request->var_dump();
});

Route::get('getOrderId', function(Request $request){
  $order_id = order::get()->last()->id;
  return $order_id;
});
// function getOrderId(){
//   $order_id = order::get()->last()->id;
//   return $order_id;
// }

Route::post('delivery/store', function(Request $request){
   $data= $request->input();
//    $deliveryAddress = new deliveryAddress();        
// $deliveryAddress->phoneNumber = "090909";
// $deliveryAddress->address = "address"; 
// $deliveryAddress->addressDetail = "address"; 
// $deliveryAddress->order_id = 268; 
//  $deliveryAddress->save();

 $id = $request->query('id');

$order = new order();        
$order->user_id = $id; 
$order->save();
$order_id = $order->id;

deliveryLocation::create(['phoneNumber' => $data[1]['phoneNumber'],'address' => $data[1]['address'], 'addressDetail' => $data[1]['addressDetail'], 'order_id' => $order_id]);

$length = count($data[0]);
for($i=0; $i < $length ; $i++) {
  $item = new App\item();
 
  $item = $item::find($data[0][$i]['item_id']);
  $item->orders()->attach($order_id,[ 'quantity'=>$data[0][$i]['quantity'], 'total' => $data[0][$i]['total']]);
 
}

  
  
return count($data[0])-1;
});




//crete ordered items
Route::post('order/store', function(Request $request){
$data= $request->input();
$id = $request->query('id');

$order = new order();        
$order->user_id = $id; 
$order->save();
$order_id = $order->id;

$length = count($data)-1;
for($i=0; $i < $length ; $i++) {
  $item = new App\item();
 
  $item = $item::find($data[$i]['item_id']);
  $item->orders()->attach($order_id,[ 'quantity'=>$data[$i]['quantity'], 'total' => $data[$i]['total']]);
 
}




//  foreach ( $data as $obj )
//     {
//         $item = new App\item();
//         // $item = $item::find($temp['item_id']);
//         $item = $item::find(2);
//         // $item->orders()->attach($order_id,[ 'quantity'=>$temp['quantity'], 'total' => $temp['total']]);
//         $i = count($data);
//         // $item->orders()->attach($order_id,[ 'quantity'=>$quantity, 'total' => '35']);
//     }

 return $data;

});


  //get customers
  Route::get('customers', function(){
    return User::latest()->where('roll','2')->orderBy('created_at', 'desc')->get();
  });

  // Get Single user
  Route::get('user/{id}', function($id){
    return User::findOrFail($id);
  });

 // Get the last user
  Route::get('customer', function(){
    return User::orderBy('id', 'desc')->first();
  });



  // Add user it is for update purpose
  Route::post('user/store', function(Request $request){
    $id = $request->query('id');
    $image =  $request['file']->getClientOriginalName();
     $path = $request['file']->storeAs('public/users', $image);
  
   $user = User::findOrFail($id);
   $user->firstName = "taked";
   $user->lastName = $request->input(['lastName']);
   $user->sex = $request->input(['sex']);
   $user->phoneNumber = $request->input(['phoneNumber']);
   $user->image = $image;
  // $user->rate = $request->input(['rate']);
   $user->save();

    return  $request->input(['firstName']);
 // return $request->input(['rate']);
  });


   // Add user it is for giving rate purpose
  Route::post('user/giveRate', function(Request $request){
    $id = $request->query('id');
    $image =  $request['file']->getClientOriginalName();
     $path = $request['file']->storeAs('public/users', $image);
  
   $user = User::findOrFail($id);
   $user->firstName = "taked";
   $user->lastName = $request->input(['lastName']);
   $user->sex = $request->input(['sex']);
   $user->phoneNumber = $request->input(['phoneNumber']);
   $user->image = $image;
   $user->rate = $request->input(['rate']);
   $user->save();

    return  $request->input(['firstName']);
 // return $request->input(['rate']);
  });


  //search item by barcode
  Route::get('itembarcode', function(Request $request){
    $barcode = $request->query('barcode');
    // return $barcode;
    return item::where('barcode', $barcode)->get()[0];
    // $barcode =  $request->query('result');
    // return category::findOrFail($id);->where('name', 'John')->first();
    // return item:: ->firstOrFail();
    // return item::latest()->orderBy('created_at', 'desc')->get();
   
    // ->where('barcode', $barcode)->first();
  });

  //search bar
  Route::get('searchCategory', function(Request $request ){
    $search = $request->input(['q']);
    return category::query()->where('name','like','%'.$search.'%')->get();
    //return $request->all();
  });

});

//for orders
Route::get('order', function(){
  return order::latest()->orderBy('created_at', 'desc')->get();
});

//for ordered items
Route::get('orderedItems/{id}', function($id){
 $order = order::findOrFail($id);
   return $order->items()->get();
});

//Get the last ordered item
Route::get('orderedItem', function(){
   $order = order::orderBy('id', 'desc')->first();
  return $order->items()->get();
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();

    
});




  
  
