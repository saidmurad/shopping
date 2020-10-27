<template>
  <div>
    <h1>Add Item</h1>
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

    <h1>items</h1>
    <ul class="list-group">
      <li class="list-group-item" v-for="item in list" v-bind:key="item.id">
        <strong>{{item.name}}</strong>
        {{item.description}} {{item.image}}
        <button
          @click="showItem(item.id)"
          class="btn btn-primary btn-xs"
        >Edit</button>
        <button @click="deleteItem(item.id)" class="btn btn-danger btn-xs">Delete</button>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  data: function() {
    return {
      edit: false,
      id: "",
      name: "",
      description: "",
      price: "",
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
      });
      self.edit = true;
    },

    updateItem: function(id) {
      console.log("Updating item " + id + "...");
      this.deleteItem(id);
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
        .then(function() {
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
          self.fetchItem();
        })
        .catch(function(error) {
          console.log(error);
        });
    }
  }
};
</script>
