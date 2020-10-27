<template>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Order Id</th>
        <!-- <th>User Name</th> -->
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <template v-for="order in orders">
        <tr v-bind:key="order.id">
          <td>{{order.id}}</td>
          <!-- <td>{{order.user_name}}</td> -->
          <td>
            <router-link to="/viewOrderedItem" class="btn btn-info">View Detail</router-link>
          </td>
        </tr>
      </template>
    </tbody>
  </table>
</template>

<script>
export default {
  data: function() {
    return {
      orders: []
    };
  },

  mounted: function() {
    console.log("items Component Loaded...");
    this.fetchOrderList();
  },
  methods: {
    fetchOrderList: function() {
      console.log("Fetching orders...");
      axios
        .get("api/order")
        .then(response => {
          console.log(response.data);
          this.orders = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    }
  }
};
</script>
