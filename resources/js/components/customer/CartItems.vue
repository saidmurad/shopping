<template>
    <div>
        <h3>SHOPPING CART</h3>
        <!-- <table class="table table-bordered">
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
                            <span
                                @click="deleteFromCart(item.item_id)"
                                class="btn btn-danger"
                                >Delete</span
                            >
                        </td>
                    </tr>
                </template>
            </tbody>
        </table> -->

        <div>
            <div class="column-header d-flex align-items-center">
                <div style="width:50%">PRODUCT</div>
                <div style="width:14%">PRICE</div>
                <div style="width:14%">QUANTITY</div>
                <div style="width:14%">TOTAL</div>
                <div style="width:8%">DELETE</div>
            </div>
            <hr>
            <div v-for="item in listsValue" :key="item.name">
            <div class="d-flex align-items-center"  >
                <div  style="width:50%"> <img
            v-bind:src="'../storage/items/' + item.image"
            class="float-left item-image"
            alt="item.image"
          /> <span class="item-description ml-3">{{item.description}}</span>
          </div>
                <div class="item-price" style="width:14%">{{item.price}}Birr</div>
                <div class="item-quantity" style="width:14%">{{item.quantity}}</div>
                <div class="item-price" style="width:14%">{{item.total}}Birr</div>
                <div  style="width:8%"><button class="btn btn-danger" @click="deleteFromCart(item.item_id)" ><i class="fas fa-trash-alt"> <span> Delete</span> </i></button></div>
            </div>
            <hr>
        </div>
         
        <div class="column-header d-flex align-items-center">
                
                <div style="width:78%" class="text-center">TOTAL PRICE</div>
               
                <div style="width:14%">{{total}}</div>
                <div style="width:8%"></div>
            </div>
        </div>

         <span @click="createOrder()" class="btn btn-success m-5">Order</span>
          <br />
          <span
        @click="openModalWindow()"
            class="btn btn-info"
            data-toggle="modal"
            data-target="#addDeliveryFields"
            >Click If you want delivery</span
        >
       
       

        <!-- Modal -->
        <div
            class="modal fade"
            id="addDeliveryFields"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
        >
            <div  class="modal-dialog modalform" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Add Delivery Fields
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="modalform" @submit.prevent="addToDelivery">
                        <div class="modal-body">
                            <div class="form-group">
                                <input
                                    v-model="form.phoneNumber"
                                    type="text"
                                    name="phoneNumber"
                                    placeholder="Phone Number"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has(
                                            'phoneNumber'
                                        )
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="phoneNumber"
                                ></has-error>
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
                                <has-error
                                    :form="form"
                                    field="address"
                                ></has-error>
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
                                <has-error
                                    :form="form"
                                    field="addressDetail"
                                ></has-error>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" >
                                Close
                            </button>
                            <button type="submit" class="btn btn-primary">
                                Order
                            </button>
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
            id: this.$route.query.id,
            order_id: 4,
            total:0,
            // Create a new form instance
            form: new Form({
                phoneNumber: "",
                address: "",
                addressDetail: ""
            })
        };
    },
    mounted() {
    console.log("Component mounted.");
    this.getTotal(this.$store.state.lists);
  },
    computed: {
        listsValue() {
            return this.$store.state.lists;
        }
    },
    methods: {
        getOrderId: function() {
            console.log("Fetching items...");

            const sendGetRequest = async () => {
                try {
                    const resp = await axios.get("../api/getOrderId");
                    this.order_id = resp.data;
                } catch (err) {
                    // Handle Error Here
                    console.error(err);
                }
            };
            sendGetRequest();

            //   axios
            //     .get("../api/getOrderId")
            //     .then(response => {
            //       //console.log(response.data);
            //       this.order_id = response.data;
            //     })
            //     .catch(error => {
            //       console.log(error);
            //     });
        },

        createOrder: function() {
            console.log("Creating orders...");
            let self = this;
            //let orders = self.cart;
            let orders = Object.assign({}, self.$store.state.lists);
            axios
                .post("../api/order/store", orders, {
                    params: {
                        id: this.id
                    }
                })
                .then(response => {
                   // self.formData.phoneNumber = "";
            
                    self.$store.state.lists = [];
                    // this.listsValue();
                   // console.log(orders);
                    console.log(response.data);
                    this.quantity = "0";
                })
                .catch(function(error) {
                    console.log(error);
                });
        },

        addToDelivery: function() {
            var modalform = document.querySelector(".modalform");
            console.log(this.order_id);
            // this.getOrderId();
            console.log("Adding objects to delivery...");
            //console.log(this.order_id);
            let self = this;
            //let orders = self.cart;
            let orders = Object.assign({}, self.$store.state.lists);
            
            let formData = Object.assign({}, self.form);
            let array = [orders, formData];

            axios
                .post("../api/delivery/store", array, {
                    params: {
                        id: this.id
                    }
                })
                .then(response => {
                    modalform.style.display = "none";
                    self.$store.state.lists = [];
                    // this.listsValue();
                    // console.log(array);
                    console.log(response.data);
                    this.quantity = "0";
                })
                .catch(function(error) {
                    console.log(error);
                });


            // const requestOne = axios.post("../api/order/store", orders ,  {
            //         params: {
            //             id: this.id
            //         }
            //     });
            // const requestTwo = axios.post("../api/delivery/store", array,  {
            //         params: {
            //             id: this.id
            //         }
            //     });

            // axios
            //     .all([  requestTwo])
            //     .then(
            //         axios.spread((...responses) => {
            //             // console.log(responses[0]);
            //             console.log(responses[0].data);
            //             // self.form.phoneNumber = "";
            //             // self.form.address = "";
            //             // self.form.addressDetail = "";
            //             //console.log(this.order_id);
            //             // use/access the results
            //         })
            //     )
            //     .catch(errors => {
            //         // react on errors.
            //         console.log(errors);
            //     });
        },
         openModalWindow: function() {
             var modalform = document.querySelector(".modalform");
             modalform.style.display = "block";

         },
         deleteFromCart: function(id){
              this.$store.state.lists = this.$store.state.lists.filter(function(value, index, arr){ return value.item_id != id;});
              console.log(this.$store.state.lists);
              console.log(id);

         },
         getTotal: function(array){
             self = this; 
          for(var i in array) { 
        self.total += array[i].total;
         }
    return self.total;
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
  .item-price{
      font-weight: 700;
  }
  

</style>
