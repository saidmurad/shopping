<template>
  <div>
    <h1>Add category</h1>
    <form action="#" @submit.prevent="edit ? updatecategory(category.id) : createcategory()">
      <div class="form-group">
        <label>Name</label>
        <input v-model="category.name" type="text" name="name" class="form-control" />
      </div>
      <div class="form-group">
        <label>description</label>
        <input v-model="category.description" type="text" name="description" class="form-control" />
      </div>
      <div class="form-group">
        <label>image</label>
        <input v-model="category.image" type="text" name="image" class="form-control" />
      </div>
      <div class="form-group">
        <button v-show="!edit" type="submit" class="btn btn-primary">New category</button>
        <button v-show="edit" type="submit" class="btn btn-primary">Update category</button>
      </div>
    </form>
    <h1>categorys</h1>
    <ul class="list-group">
      <li class="list-group-item" v-for="category in list" v-bind:key="category">
        <strong>{{category.name}}</strong>
        {{category.description}} {{category.image}}
        <button
          @click="showcategory(category.id)"
          class="btn btn-default btn-xs"
        >Edit</button>
        <button @click="deletecategory(category.id)" class="btn btn-danger btn-xs">Delete</button>
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
      category: {
        id: "",
        name: "",
        description: "",
        image: ""
      }
    };
  },
  mounted: function() {
    console.log("categorys Component Loaded...");
    this.fetchcategoryList();
  },
  methods: {
    fetchcategoryList: function() {
      console.log("Fetching categorys...");
      axios
        .get("api/category")
        .then(response => {
          console.log(response.data);
          this.list = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
    createcategory: function() {
      console.log("Creating category...");
      let self = this;
      let params = Object.assign({}, self.category);
      axios
        .post("api/category/store", params)
        .then(function() {
          self.category.name = "";
          self.category.description = "";
          self.category.image = "";
          self.edit = false;
          self.fetchcategoryList();
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    showcategory: function(id) {
      let self = this;
      axios.get("api/category/" + id).then(function(response) {
        self.category.id = response.data.id;
        self.category.name = response.data.name;
        self.category.description = response.data.description;
        self.category.image = response.data.image;
      });
      self.edit = true;
    },
    updatecategory: function(id) {
      console.log("Updating category " + id + "...");
      let self = this;
      let params = Object.assign({}, self.category);
      axios
        .patch("api/category/" + id, params)
        .then(function() {
          self.category.name = "";
          self.category.description = "";
          self.category.image = "";
          self.edit = false;
          self.fetchcategoryList();
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    deletecategory: function(id) {
      axios
        .delete("api/category/" + id)
        .then(function(response) {
          self.fetchcategoryList();
        })
        .catch(function(error) {
          console.log(error);
        });
    }
  }
};
</script>
