<template>
  <div>
    <h1>Add item</h1>
    <form action="#" @submit.prevent="edit ? updateitem(item.id) : createitem()">
      <div class="form-group">
        <label>Name</label>
        <input v-model="item.name" type="text" name="name" class="form-control" />
      </div>
      <div class="form-group">
        <label>description</label>
        <input v-model="item.description" type="text" name="description" class="form-control" />
      </div>
      <div class="form-group">
        <label>image</label>
        <input v-model="item.image" type="text" name="image" class="form-control" />
      </div>
      <div class="form-group">
        <label>price</label>
        <input v-model="item.price" type="text" name="price" class="form-control" />
      </div>
      <div class="form-group">
        <button v-show="!edit" type="submit" class="btn btn-primary">New item</button>
        <button v-show="edit" type="submit" class="btn btn-primary">Update item</button>
      </div>
    </form>
    <h1>items</h1>
    <ul class="list-group">
      <li class="list-group-item" v-for="item in list">
        <strong>{{item.name}}</strong>
        {{item.description}} {{item.image}}
        <button
          @click="showitem(item.id)"
          class="btn btn-default btn-xs"
        >Edit</button>
        <button @click="deleteitem(item.id)" class="btn btn-danger btn-xs">Delete</button>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  data: function() {
    return {
      edit: false,
      list: [],
      item: {
        id: "",
        name: "",
        description: "",
        image: "",
        price: ""
      }
    };
  },
  mounted: function() {
    console.log("items Component Loaded...");
    this.fetchitemList();
  },
  methods: {
    fetchitemList: function() {
      console.log("Fetching items...");
      axios
        .get("api/item")
        .then(response => {
          console.log(response.data);
          this.list = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
    createitem: function() {
      console.log("Creating item...");
      let self = this;
      let params = Object.assign({}, self.item);
      axios
        .post("api/item/store", params)
        .then(function() {
          self.item.name = "";
          self.item.description = "";
          self.item.image = "";
          self.item.price = "";
          self.edit = false;
          self.fetchitemList();
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    showitem: function(id) {
      let self = this;
      axios.get("api/item/" + id).then(function(response) {
        self.item.id = response.data.id;
        self.item.name = response.data.name;
        self.item.description = response.data.description;
        self.item.image = response.data.image;
        self.item.price = response.data.price;
      });
      self.edit = true;
    },
    updateitem: function(id) {
      console.log("Updating item " + id + "...");
      let self = this;
      let params = Object.assign({}, self.item);
      axios
        .patch("api/item/" + id, params)
        .then(function() {
          self.item.name = "";
          self.item.description = "";
          self.item.image = "";
          self.item.price = "";
          self.edit = false;
          self.fetchitemList();
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    deleteitem: function(id) {
      axios
        .delete("api/item/" + id)
        .then(function(response) {
          self.fetchitemList();
        })
        .catch(function(error) {
          console.log(error);
        });
    }
  }
};
</script>
