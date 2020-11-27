<template>
  
<div class="container">
  <div class="container-fill">
    <div class="row pt-5">
      <div class="col-3 pr-5">

        <div>
            <div class=" d-flex align-items-center">
                <div style="width:40%"> ID</div>
                <div style="width:60%">DETAIL</div>
                
            </div>
            <hr>
            <div v-for="order in orders" :key="order.id">
            <div class="d-flex align-items-center"  >
                <div  style="width:20%"><span> {{order.id}}</span></div>
                <div  style="width:60%"><button class="btn btn-primary" @click="showOrderedItems(order.id)" > <span> Detail</span> </button></div>
                
            </div>
            <hr>
        </div>
         </div>
         </div>


      <div class="col-9">

     <div>
            <div class=" d-flex align-items-center">
                <div style="width:50%">ITEM</div>
                <div style="width:25%">PRICE</div>
                <div style="width:25%">TOTAL</div>
                
            </div>
            <hr>
            <div v-for="item in orderedItems" :key="item.name">
            <div class="d-flex align-items-center"  >
                <div  style="width:50%"><p class="p-0 m-0 font-weight-bold">{{item.name}}</p> <img
            v-bind:src="'../storage/items/' + item.image"
            class="float-left item-image"
            alt="item.image"
          /> <span  class="ml-3">{{item.description}}</span>
          </div>
                <div  style="width:25%"><span >{{item.price}}</span></div>
                <div  style="width:25%"><span >{{item.pivot.total}}</span></div>
               
               
               
                
            </div>
            <hr>
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
      orderedItems: []
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
          console.log(response.data);
          this.orders = response.data;
        })
        .catch(error => {
          console.log(error);
        });

        axios.get("api/orderedItem")
        .then(response => {
        self.orderedItems = response.data;
        console.log(response.data);
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
          });
    },
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
