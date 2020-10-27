<template>
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
            <td>{{ item.name }}</td>
            <td>{{ item.price }}</td>
            <td>{{ item.quantity }}</td>
            <td>{{ item.total }}</td>
            <td>
              <span @click="deleteFromCart(1)" class="btn btn-danger">Delete</span>
            </td>
          </tr>
        </template>
      </tbody>
    </table>
    <span
      @click="createOrder()"
      class="btn btn-primary"
      data-toggle="modal"
      data-target="#addDeliveryFields"
    >Click If you want delivery</span>
    <br />
    <span @click="createOrder()" class="btn btn-primary m-5">Order</span>

    <!-- Modal -->
    <div
      class="modal fade"
      id="addDeliveryFields"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Delivery Fields</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="addToDelivery">
            <div class="modal-body">
              <div class="form-group">
                <input
                  v-model="form.phoneNumber"
                  type="text"
                  name="phoneNumber"
                  placeholder="Phone Number"
                  class="form-control"
                  :class="{
                                    'is-invalid': form.errors.has('phoneNumber')
                                }"
                />
                <has-error :form="form" field="phoneNumber"></has-error>
              </div>
              <div class="form-group">
                <input
                  v-model="form.address"
                  type="text"
                  name="address"
                  placeholder="Address "
                  class="form-control"
                  :class="{
                                    'is-invalid': form.errors.has('address')
                                }"
                />
                <has-error :form="form" field="address"></has-error>
              </div>
              <div class="form-group">
                <textarea
                  v-model="form.addressDetail"
                  type="text"
                  name="addressDetail"
                  placeholder="Address Detail"
                  class="form-control"
                  :class="{
                                    'is-invalid': form.errors.has(
                                        'addressDetail'
                                    )
                                }"
                />
                <has-error :form="form" field="addressDetail"></has-error>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary">Close</button>
              <button type="submit" class="btn btn-primary">Order</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data: function() {
    return {
      // Create a new form instance
      form: new Form({
        phoneNumber: "",
        address: "",
        addressDetail: ""
      })
    };
  },
  computed: {
    listsValue() {
      return this.$store.state.lists;
    }
  },
  methods: {
    createOrder: function() {
      console.log("Creating orders...");
      let self = this;
      //let orders = self.cart;
      let orders = Object.assign({}, self.$store.state.lists);
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

    addToDelivery: function() {
      console.log("Adding objects to delivery...");
      let self = this;
      //let orders = self.cart;
      let orders = Object.assign({}, self.$store.state.lists);
      let form = Object.assign({}, self.form);

      const requestOne = axios.post("../api/order/store", orders);
      const requestTwo = axios.post("../api/delivery/store", form);

      axios
        .all([requestOne, requestTwo])
        .then(
          axios.spread((...responses) => {
            console.log(responses[0]);
            console.log(responses[1]);
            self.form.phoneNumber = "";
            self.form.address = "";
            self.form.addressDetail = "";

            // use/access the results
          })
        )
        .catch(errors => {
          // react on errors.
          console.log(errors);
        });
    }
  }
};
</script>
