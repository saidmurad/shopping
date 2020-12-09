<template>
  <div class="container-fill">
    <StreamBarcodeReader class="scan" style="display:none;"
          @decode="onDecode"></StreamBarcodeReader>
    <div class="row">
      <div class="col-5">
        <div class="shadow p-2 bg-light ">
    <h4 class="text-center text-info"> Add Product</h4>
    <form
      action="#"
      @submit.prevent="edit ? updateItem(id) : createItem()"
      enctype="multipart/form-data"
    >
      <div class="form-group">
        <label>Name</label>
        <input v-model="name" type="text" name="name" class="form-control" />
      </div>
      <div class="form-group">
        <label>description</label>
        <input v-model="description" type="text" name="description" class="form-control" />
      </div>
      <div class="form-group">
        <label>Price</label>
        <input v-model="price" type="text" name="price" class="form-control" />
      </div>
           <button @click="startScan" class="btn btn-primary btn-xs">Scan</button>

      <div class="form-group">
        <label>Barcode</label>
        <input v-model="barcode" type="text" name="barcode" class="form-control" />
      </div>
      <div class="form-group">
        <label>image</label>
        <input type="file" class="form-control" v-on:change="onFileChange" />
      </div>
      <div class="form-group">
        <button v-show="!edit" type="submit" class="btn btn-primary">New Item</button>
        <button v-show="edit" type="submit" class="btn btn-primary">Update item</button>
      </div>
    </form>
    </div>
    </div>
   
      <div class="col-7">
    <h4 class="text-center text-info"> Products</h4>
<div>
            <div class=" d-flex align-items-center">
                <div style="width:45%">ITEM</div>
                <div style="width:15%">PRICE</div>
                <div style="width:20%">EDIT</div>
                <div style="width:20%">DELETE</div>
                
            </div>
            <hr>
            <div v-for="item in list" :key="item.id">
            <div class="d-flex align-items-center"  >
                <div  style="width:50%"><p class="p-0 m-0 font-weight-bold">{{item.name}}</p> <img
            v-bind:src="'../storage/items/' + item.image"
            class="float-left item-image"
            alt="item.image"
          /> <span class="item-description ml-3">{{item.description}}</span>
          </div>
                <div  style="width:15%"><span >{{item.price}}</span></div>
                <div  style="width:20%"><button class="btn btn-primary" @click="showItem(item.id)" ><i class="fas fa-edit cyan-text"></i><span> Edit</span></button></div>
                <div  style="width:20%"><button class="btn btn-danger" @click="deleteItem(item.id)" ><i class="fas fa-trash-alt"> <span> Delete</span> </i></button></div>
               
                
            </div>
            <hr>
        </div>
        </div>

    </div>
    </div>
  </div>
</template>

<script>
import { StreamBarcodeReader  } from "vue-barcode-reader";
import  VueBarcode  from "vue-barcode";


export default {
    components: { StreamBarcodeReader , VueBarcode },
  data: function() {
    return {
      result:"",
      edit: false,
      id: "",
      name: "",
      description: "",
      price: "",
      image:"",
      barcode: "",
      file: "",
      list: [],
      category_id: this.$route.params.id
    };
  },

  mounted: function() {
    console.log("items Component Loaded...");
    this.fetchItem();
  },

  methods: {
    onFileChange(e) {
      console.log(e.target.files[0]);
      this.file = e.target.files[0];
    },

    fetchItem: function() {
      console.log("Fetching items...");
      axios
        .get("../api/items", {
          params: {
            id: this.category_id
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

    createItem: function() {
      let self = this;
      let formData = new FormData();
      var file = document.querySelector("#report");
      formData.append("file", this.file);
      formData.append("name", this.name);
      formData.append("category_id", this.category_id);
      formData.append("price", this.price);
       formData.append("barcode", this.barcode);
      formData.append("description", this.description);
      formData.append("_method", "POST"); // ADD THIS LINE
      // axios({
      //   method: "post",
      //   url: "api/category/store2",
      //   headers: {
      //     "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
      //   },
      //   data: formData
      // });
      axios
        .post("../api/item/store2", formData)
        .then(function() {
          self.name = "";
          self.description = "";
          self.price = "";
          self.barcode = "";
          self.file = "";
          self.fetchItem();
        })
        .catch(function(error) {
          console.log(error);
        });
    },

    showItem: function(id) {
      let self = this;
      axios.get("../api/item/" + id).then(function(response) {
        self.id = response.data.id;
        self.name = response.data.name;
        self.price = response.data.price;
        self.barcode = response.data.barcode;
        self.description = response.data.description;
        self.image = response.data.image;

         let fileUrl ="../storage/items/" + self.image;
         self.urlToBlob(fileUrl).then(function(blob){
         self.file = new File([blob], self.image);})
      });
      self.edit = true;
    },

    updateItem: function(id) {
      console.log("Updating item " + id + "...");
      //this.deleteItem(id);
      let self = this;

      let formData = new FormData();
      var file = document.querySelector("#report");
      formData.append("file", this.file);
      formData.append("id", this.id);
      formData.append("name", this.name);
      formData.append("price", this.price);
      formData.append("barcode", this.barcode);
      formData.append("category_id", this.category_id);
      formData.append("description", this.description);
      formData.append("_method", "POST"); // ADD THIS LINE

      axios
        .post("../api/item/store4", formData)
        .then(function(response) {
          console.log(response.data);
          self.name = "";
          self.description = "";

          self.edit = false;
          self.fetchItem();
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    deleteItem: function(id) {
      let self = this;
      axios
        .delete("../api/item/" + id)
        .then(function(response) {
          console.log(response.data);
          self.fetchItem();
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    urlToBlob: function(url){
 return new Promise((resolve,reject)=>{
    var xhr = new XMLHttpRequest();
    xhr.open( "GET", url, true );
    xhr.responseType = "blob";
    xhr.onload = function( e ) {
        resolve(this.response)
    };
    xhr.onerror = function( error ){
        reject(error)
    }
    xhr.send();
 })
},

 onDecode(result) {
            this.result = result;
            var scan = document.querySelector(".scan");
           // var itemContent = document.querySelector(".itemContent");

            console.log("Fetching items...");
            console.log(result);
            this.barcode = result;
            console.log(this.barcode);


          scan.style.display = "none";
        //  itemContent.style.display = "block";
          
    },

     startScan() {
         var scan = document.querySelector(".scan");
         //var itemContent = document.querySelector(".itemContent");

         scan.style.display = "block";
         //itemContent.style.display = "none";
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
