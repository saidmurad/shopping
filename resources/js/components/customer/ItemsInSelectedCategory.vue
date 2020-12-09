<template>
  <div>
    <div class="col-md-8">
      <div class="input-group">
        <input type="text" v-model="search" class="form-control" />
        <div class="input-group-prepend">
          <button @click.prevent="searchCategory()" class="btn btn-primary">
            <i class="fa fa-search"></i>
          </button>
        </div>
      </div>
    </div>

    <h3 class="text-center text-primary"> {{category.name}}</h3>

<div  v-if="showSearch==true" class="container">
  <div class="row">
      <div class="col-12 col-sm-6 col-md-4 col-lg-3  grid-onepart"  v-for="item in caris"
        :key="item.id">
        <!-- id is user id and item.id is category id , don't be confused -->
        <div class="item-box">
        <router-link :to="'/item/' + item.id ">
          <img
            v-bind:src="'../storage/items/' + item.image"
            class="item-image"
            alt="item.image"
          />
           </router-link>
          <h4 class="item-name " v-html="item.name"></h4>
          <p class="item-description text-muted">{{ item.description }}</p>
          <input class="float-left" type="number" v-model="quantity" style="width:60px" />
          <span class="item-price   float-right">{{item.price}}birr</span>
          <br><br>
          <div class="d-flex justify-content-center">
           <span
              @click="addToCart( item.id, item.name, item.price, item.image, item.description )"
              class="btn btn-primary"
             
            >Add To Cart</span>
            </div>
          </div>
          </div>
       
      </div>
   
    </div>

    <div  v-if="showSearch==false" class="container">
  <div class="row">
      <div class="col-12 col-sm-6 col-md-4 col-lg-3  grid-onepart"  v-for="item in list"
        :key="item.id">
        <!-- id is user id and item.id is category id , don't be confused -->
        <div class="item-box">
        <router-link :to="'/item/' + item.id ">
          <img
            v-bind:src="'../storage/items/' + item.image"
            class="item-image"
            alt="item.image"
          />
           </router-link>
          <h4 class="item-name " v-html="item.name"></h4>
          <p class="item-description text-muted">{{ item.description }}</p>
          <input class="float-left" type="number" v-model="quantity" style="width:60px" />
          <span class="item-price   float-right">{{item.price}}birr</span>
          <br><br>
          <div class="d-flex justify-content-center">
           <span
              @click="addToCart( item.id, item.name, item.price, item.image, item.description )"
              class="btn btn-primary"
             
            >Add To Cart</span>
            </div>
          </div>
          </div>
       
      </div>
   
    </div>

    <!-- <div>
      <h1>items</h1>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Item Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total Price</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <template v-for="item in listsValue">
            <tr v-bind:key="item.id">
              <td>{{item.name}}</td>
              <td>{{item.price}}</td>
              <td>{{item.quantity}}</td>
              <td>{{item.total}}</td>
              <td>
                <span @click="deleteFromCart(1 )" class="btn btn-danger">Delete</span>
              </td>
            </tr>
          </template>
        </tbody>
      </table>

      <span @click="createOrder()" class="btn btn-primary">Order</span>
    </div> -->
  </div>
</template>

<script>
export default {
  data: function() {
    return {
      search: "",
      showSearch: false,
      caris: [],
      id: this.$route.params.id,
      quantity: "1",
      category: {},
      list: [],
      //cart: [],
      cart: [
        // { item_id: 5, quantity: "99", total: "66" },
        // { item_id: 4, quantity: "4", total: "172" },
        // { item_id: 3, quantity: "2", total: "66" }
      ],
      item: { name: "div", price: "33", quantity: "2", total: "66" }
    };
  },
  computed: {
    listsValue() {
      return this.$store.state.lists;
    }
  },
  mounted() {
    console.log("Component mounted.");
    this.fetchItemList();
    //this.addToCart();
    this.fetchCategoryList();
  },
  methods: {
    fetchItemList: function() {
      console.log("Fetching items...");

      axios
        .get("../api/items", {
          params: {
            id: this.id
          }
        })
        .then(response => {
          console.log(response.data);
          this.list = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
    fetchCategoryList: function() {
      console.log("Fetching categories...");

      axios
        .get("../api/category1", {
          params: {
            id: this.id
          }
        })
        .then(response => {
          console.log(response.data);
          this.category = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    },

    createOrder: function() {
      console.log("Creating orders...");
      let self = this;
      //let orders = self.cart;
      let orders = Object.assign({}, self.cart);
      axios
        .post("../api/order/store", orders)
        .then(response => {
          console.log(orders);
          console.log(response.data);
          this.quantity = "0";
        })
        .catch(function(error) {
          console.log(error);
        });
    },

    addToCart: function(id, name, price, image, description) {
      console.log("adding to cart...");
      let self = this;
      let quantity = this.quantity;
      let total = quantity * price;
      self.cart.push({
        item_id: id,
        name: name,
        price: price,
        image: image,
        description: description,
        quantity: quantity,
        total: total
      });
      self.$store.state.lists.push({
        item_id: id,
        name: name,
        price: price,
        image: image,
        description: description,
        quantity: quantity,
        total: total
      });
      self.quantity = "0";
    },

    deleteFromCart: function(item_id) {
      this.cart.splice(this.cart, item_id);
    },
    searchCategory: function() {
      console.log("Fetching search categorys...");
      
      axios
        .get("../api/searchItem", {
          params: {
            q: this.search,
          }
        })
        //.then(res => res.json())
        .then(response => {
          console.log(response.data);
          this.caris = response.data;
          this.search = "";
          this.showSearch = true;
        })
        .catch(error => {
          console.log(error);
        });
    }
  }
};
</script>

<style scoped>
.image-wrapper{
  padding-top: 10px;
}
.grid-onepart{
  padding: 10px;
}
.item-box{
    /* box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); */
  /* border: 3px solid #c59d5f; */
   border: 1px solid rgba(0, 0, 0, 0.2);
  border-radius:0.5rem;
  }
  .item-box:hover{
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  }
  
  .item-image{
    width: 100%; 
    height: 170px;        
  }
  .item-name{
    padding: 3px;         
    margin-bottom:0 ;
    text-transform: capitalize;
  }
  .item-description{
    color: #617d98;
   
   
  }
  .item-price{
    font-weight: 700;
    
  }
  .add-tocart{
     text-align: center;
  }
</style>



