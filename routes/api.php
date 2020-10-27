<?php

//use Request;
use Illuminate\Http\Request;
 use Illuminate\Support\Facades\Auth;
use App\category;
use App\item;
use App\order;
use App\User;
use App\deliveryAddress;


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

Route::post('delivery/store', function(Request $request){
  
 return deliveryAddress::create(['phoneNumber' => $request->input(['phoneNumber']), 'address' => $request->input(['address']), 'addressDetail' => $request->input(['addressDetail']), 'user_id' => 1]);
  });




//crete ordered items
Route::post('order/store', function(Request $request){
$data= $request->input();

$order = new order();        
$order->user_id = 1;  
$order->save();
$order_id = $order->id;

 foreach ( $data as $temp )
    {

        $item = new App\item();
        $item = $item::find($temp['item_id']);
        $item->orders()->attach($order_id,[ 'quantity'=>$temp['quantity'], 'total' => $temp['total']]);
    }

 return $data;
  
});


  //get customers
  Route::get('customer', function(){
    return User::latest()->where('roll','2')->orderBy('created_at', 'desc')->get();
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();

    
});




  
  
