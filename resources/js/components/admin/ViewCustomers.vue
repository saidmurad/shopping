<template>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Firs tName</th>
        <th>Last Name</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <template v-for="customer in customers">
        <tr v-bind:key="customer.firstName">
          <td>{{customer.firstName}}</td>
          <td>{{customer.lastName}}</td>
          <td>
            <router-link to="/userDetail" class="btn btn-info">View Detail</router-link>
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
      customers: []
    };
  },

  mounted: function() {
    console.log("items Component Loaded...");
    this.fetchCustomerList();
  },
  methods: {
    fetchCustomerList: function() {
      console.log("Fetching items...");
      axios
        .get("api/customer")
        .then(response => {
          console.log(response.data);
          this.customers = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    }
  }
};
</script>
