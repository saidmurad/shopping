<template>
  <div>
    <h1>{{category.name}}</h1>
    <br />
    <div>
      <!-- <div>
        <h1>{{category.name}}</h1>
        <router-link
          :to="'/categoryItems/' + category.id"
          class="btn btn-primary"
        >Edit item InCategory</router-link>
        <router-link to="/viewCategory" class="btn btn-primary">Go Back</router-link>
      </div>-->

      <div class="image-wrapper">
        <div v-for="item in list" :key="item.id">
          <img v-bind:src="'../storage/items/' + item.image" class="gallery__img" alt="Image 1" />
          <h3 class="title" v-html="item.name"></h3>
          <p class="text-muted">{{item.description}}</p>
          <h4>
            <span class="small-text text-muted float-left">{{item.price}}birr</span>

            <span
              @click="addToCart( item.id, item.name, item.price )"
              class="btn btn-primary"
            >Add To Cart</span>

            <input type="number" v-model="quantity" style="width:60px" />
          </h4>
        </div>
      </div>
    </div>
    <div>
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
            <tr v-bind:key="item.name">
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
    </div>
  </div>
</template>

<script>
export default {
  data: function() {
    return {
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

    addToCart: function(id, name, price) {
      console.log("adding to cart...");
      let self = this;
      let quantity = this.quantity;
      let total = quantity * price;
      self.cart.push({
        item_id: id,
        name: name,
        price: price,
        quantity: quantity,
        total: total
      });
      self.$store.state.lists.push({
        item_id: id,
        name: name,
        price: price,
        quantity: quantity,
        total: total
      });
      self.quantity = "0";
    },

    deleteFromCart: function(item_id) {
      this.cart.splice(this.cart, item_id);
    }
  }
};
</script>


