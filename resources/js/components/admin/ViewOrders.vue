<template>
  
<div class="container">
  <div class="container-fill">
    <div class="row pt-5">
      <div class="col-5 pr-0">

        <div>
          <h4 class="text-center text-info">Customers Order</h4>
            <div class=" d-flex align-items-center">
                <div style="width:10%"> ID</div>
                <div style="width:40%"> CUST NAME</div>
                <div style="width:30%">DETAIL</div>
                
                
            </div>
            <hr>
            <div v-for="order in orders" :key="order.id">
            <div class="d-flex align-items-center"  >
                <div  style="width:10%"><span> {{order.id}}</span></div>
                <div  style="width:40%"><span> {{order.user.firstName}}</span></div>
                <div  style="width:30%"><button class="btn btn-primary" @click="showOrderedItems(order.id)" > <span> Detail</span> </button></div>
               
            </div>
            <hr>
        </div>
         </div>
         </div>


      <div class="col-7">

     <div >
       <div class="shadow pl-3 bg-light">
       <h4 class="text-center text-info"> Ordered Products</h4>
            <div class=" d-flex align-items-center">
                <div style="width:50%">ITEM</div>
                <div style="width:15%">PRICE</div>
                 <div style="width:10%">QTY</div>
                <div style="width:15%">TOTAL</div>
                
            </div>
            <hr>
            <div v-for="item in orderedItems" :key="item.id">
            <div class="d-flex align-items-center"  >
                <div  style="width:50%"><p class="p-0 m-0 font-weight-bold">{{item.name}}</p> <img
            v-bind:src="'../storage/items/' + item.image"
            class="float-left item-image"
            alt="item.image"
          /> <p  class="ml-3 text-justify">{{item.description}}</p>
          </div>
                <div  style="width:15%"><span >{{item.price}}Birr</span></div>
                <div  style="width:10%"><span >{{item.pivot.quantity}}</span></div>
                <div  style="width:15%"><span >{{item.pivot.total}}Birr</span></div>
             </div>
            <hr>
        </div>
        <div class="column-header d-flex align-items-center">
                
                <div style="width:75%" class="text-center font-weight-bold">TOTAL PRICE</div>
               
                <div class="font-weight-bold" style="width:25%">{{total}}Birr</div>
                
            </div>
                <hr>
               
                </div>
                 <br>
            <div >
              <div class="bg-warning" :class="{'d-none': needDelivery}"><p>This customer needn't delivery</p></div>
          <div :class="{'d-none': !needDelivery}">  
             <h4 class="text-center text-info">Delivery Location</h4>
            <div class="column-header d-flex align-items-center">
             <div style="width:30%" class="text-center font-weight-bold ">Address</div> 
               <div style="width:30%" class="text-center font-weight-bold">Address detail</div> 
               <div style="width:30%" class="text-center font-weight-bold">Phone Number</div> 
            </div>
             <hr>

            <div class="column-header d-flex align-items-center">
             <div style="width:30%" class="text-center ">{{deliveryLocation.address}}</div> 
               <div style="width:30%" class="text-center ">{{deliveryLocation.addressDetail}}</div> 
               <div style="width:30%" class="text-center ">{{deliveryLocation.phoneNumber}}</div> 
            </div>
            </div>
            </div>
        </div>
    </div>

 

   </div>
    </div>
     </div>
</template>

<script>
export default {
  data: function() {
    return {
      orders: [],
      orderedItems: [],
      deliveryLocation: { address:"",
                          addressDetail:"",
                          phoneNumber:"" },
      total:0,
      needDelivery: false
    };
  },

  mounted: function() {
    console.log("items Component Loaded...");
    this.fetchOrderList();
    
  },
  methods: {
    fetchOrderList: function() {
      console.log("Fetching orders...");
      self = this;
      axios
        .get("api/order")
        .then(response => {
         // console.log(response.data);
          this.orders = response.data;
          
        })
        .catch(error => {
          console.log(error);
        });

        axios.get("api/orderedItem")
        .then(response => {
        self.orderedItems = response.data;
        self.getTotal(self.orderedItems);
        //console.log(response.data);
        self.getDelivery(self.orders[0].id);
        })
        .catch(error => {
          console.log(error);
        });
    },
    showOrderedItems: function(id) {
      let self = this;
      axios.get("api/orderedItems/" + id).then(function(response) {
        self.orderedItems = response.data;
       console.log(response.data);
       self.getTotal(self.orderedItems);
          });
          console.log(id);
          self.getDelivery(id);
    },
     getTotal: function(array){
             self = this; 
             self.total = 0 ;
          for(var i in array) { 

        self.total += Number(array[i].pivot.total);
         }
    return self.total;
 },
 getDelivery: function(id){
             //self = this;
             var delivery = this.orders.filter(function(value, index, arr){ return value.id == id;})[0]; 
            // var needDelivery = this.orders[0].deliveryLocations; 
            //var needDelivery = Boolean(delivery.delivery_locations.length);
            this.needDelivery = Boolean(delivery.delivery_locations.length);
            console.log(Boolean(this.needDelivery));
            console.log(delivery.delivery_locations[0]);
             if(Boolean(this.needDelivery))
             {
                self.deliveryLocation.address = delivery.delivery_locations[0].address ;
               self.deliveryLocation.addressDetail = delivery.delivery_locations[0].addressDetail ;
               self.deliveryLocation.phoneNumber = delivery.delivery_locations[0].phoneNumber ;
              
             }  
             else
             {
             self.deliveryLocation.address = "";
             self.deliveryLocation.addressDetail = "";
             self.deliveryLocation.phoneNumber = "";
             }
 }
 
  }
};
</script>

<style  scoped>
h3{
    text-align: center;
    margin: 20px;
}
.column-header div{
    font-size:15px;
}
.item-image{
    width: 70px; 
    height: 70px;        
  }
 
  

</style>
