<template>
  <div class="container-fill">
    <div class="row">
      <div class="col-5 pt-5">
         <div class="shadow p-2 bg-light ">
    <h4 class="text-center text-info"> Add Category</h4>
    
    <form
      action="#"
      @submit.prevent="edit ? updateCategory(id) : createcategory()"
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
        <label>image</label>
        <input type="file" class="form-control" v-on:change="onFileChange" />
      </div>
      <div class="form-group">
        <button v-show="!edit" type="submit" class="btn btn-primary">New Category</button>
        <button v-show="edit" type="submit" class="btn btn-primary">Update item</button>
      </div>
    </form>
    </div>
     </div>
    <!-- 
    <h1>Categories</h1>
    <ul class="list-group">
      <li class="list-group-item" v-for="category in list">
        <strong>{{category.name}}</strong>
        {{category.description}} {{category.image}}
        <button
          @click="showCategory(category.id)"
          class="btn btn-primary btn-xs"
        >Edit</button>
        <button @click="deleteCategory(category.id)" class="btn btn-danger btn-xs">Delete</button>
      </li>
    </ul>-->
      <div class="col-7">
     <div>
       <h4 class="text-center text-info"> Categories</h4>
            <div class=" d-flex align-items-center">
                <div style="width:60%">CATEGORY</div>
                <div style="width:20%">EDIT</div>
                <div style="width:20%">DELETE</div>
                
            </div>
            <hr>
            <div v-for="category in list" :key="category.name">
            <div class="d-flex align-items-center"  >
                <div  style="width:60%"> <img
            v-bind:src="'../storage/categories/' + category.image"
            class="float-left item-image"
            alt="category.image"
          /> <span class="item-description ml-3">{{category.description}}</span>
          </div>
                <div  style="width:20%"><button class="btn btn-primary" @click="showCategory(category.id)" ><i class="fas fa-edit cyan-text"></i><span> Edit</span></button></div>
                <div  style="width:20%"><button class="btn btn-danger" @click="deleteCategory(category.id)" ><i class="fas fa-trash-alt"> <span> Delete</span> </i></button></div>
               
                
            </div>
            <hr>
        </div>
        </div>
    </div>
    </div>
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
      image: "",
      file: "",
      list: []
    };
  },

  mounted: function() {
    console.log("items Component Loaded...");
    this.fetchCategory();
  },

  methods: {
    onFileChange(e) {
      console.log(e.target.files[0]);
      this.file = e.target.files[0];
    },

    fetchCategory: function() {
      console.log("Fetching items...");
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
      let self = this;
      let formData = new FormData();
      var file = document.querySelector("#report");
      formData.append("file", this.file);
      formData.append("name", this.name);
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
        .post("api/category/store2", formData)
        .then(function() {
          self.name = "";
          self.description = "";
          self.file = "";
          self.fetchCategory();
        })
        .catch(function(error) {
          console.log(error);
        });
    },

    showCategory: function(id) {
      let self = this;
      axios.get("api/category/" + id).then(function(response) {
        self.id = response.data.id;
        self.name = response.data.name;
        self.description = response.data.description;
        self.image = response.data.image;

         let fileUrl ="storage/categories/" + self.image;
         self.urlToBlob(fileUrl).then(function(blob){
         self.file = new File([blob], self.image);})
      });
      self.edit = true;
    },

    updateCategory: function(id) {
      console.log("Updating category " + id + "...");
      this.deleteCategory(id);
      let self = this;

     

      let formData = new FormData();
      var file = document.querySelector("#report");
      formData.append("file", this.file);
      formData.append("id", this.id);
      formData.append("name", this.name);
      formData.append("description", this.description);
      formData.append("_method", "POST"); // ADD THIS LINE

      axios
        .post("api/category/store4", formData)
        .then(function() {
          self.name = "";
          self.description = "";

          self.edit = false;
          self.fetchCategory();
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    deleteCategory: function(id) {
      let self = this;
      axios
        .delete("api/category/" + id)
        .then(function(response) {
          self.fetchCategory();
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
 
  

</style>
