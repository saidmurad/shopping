<template>
  <div>
    <div class="col-md-8">
      <div class="input-group">
        <input type="text" v-model="search" class="form-control" />
        <div class="input-group-prepend">
          <button @click.prevent="searchCategory()" class="btn btn-primary">
            <i class="fa fa-search"></i>
          </button>
        </div>
      </div>
    </div>
    <br />
    
    <div v-if="showSearch==true" class="container">
      <div class="row">
      <div class="col-12 col-sm-6 col-md-4 col-lg-3  grid-onepart" v-for="cari in caris" :key="cari.id">
        <div class="item-box">
        <router-link :to="'/itemsInSelectedCategory/' + cari.id">
          <img
            v-bind:src="'storage/categories/' + cari.image"
            class="item-image"
            alt="item.image"
          />
           </router-link>
          <h5 class="item-name title text-primary" v-html="cari.name"></h5>
          <p class=" description text-muted">{{ cari.description }}</p>
          </div>

      </div>
    </div>
    </div>

    <!-- <div v-if="showSearch==false" class="image-wrapper">
      <div class="gallery__item gallery__item--1" v-for="category in list" :key="category.id">
        <router-link :to="'/itemsInSelectedCategory/' + category.id">
          <img
            v-bind:src="'storage/categories/' + category.image"
            class="gallery__img"
            alt="Image 1"
          />
          <h3 class="title" v-html="category.name"></h3>
          <p class="text-muted">{{category.description}}</p>
        </router-link>
      </div>
    </div> -->

    <div v-if="showSearch==false" class="container">
      <div class="row" >
      <div class="col-12 col-sm-6 col-md-4 col-lg-3  grid-onepart"  v-for="category in list"
        :key="category.id">
        <!-- id is user id and item.id is category id , don't be confused -->
        <div class="item-box">
        <router-link :to="'/itemsInSelectedCategory/' + category.id">
          <img
            v-bind:src="'storage/categories/' + category.image"
            class="item-image"
            alt="item.image"
          />
           </router-link>
          <h5 class="item-name title text-primary" v-html="category.name"></h5>
          <p class=" description text-muted">{{ category.description }}</p>
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
      list: [],
      search: "",
      showSearch: false,
      caris: []
      
    };
  },
  mounted() {
    console.log("Component mounted.");
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
    searchCategory: function() {
      console.log("Fetching search categorys...");
      axios
        .get("/api/searchCategory", {
          params: {
            q: this.search
          }
        })
        //.then(res => res.json())
        .then(response => {
          console.log(response.data);
          this.caris = response.data;
          this.search = "";
          this.showSearch = true;
        })
        .catch(error => {
          console.log(error);
        });
    }
  }
};
</script>

<style scoped>
.image-wrapper{
  padding-top: 10px;
}
.grid-onepart{
  padding: 10px;
}
.item-box{
    /* box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); */
  /* border: 3px solid #c59d5f; */
   border: 1px solid rgba(150, 150, 150, 0.2);
  border-radius:0.5rem;
 
  
  }
  .item-box:hover{
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
 
  
  }
  .title{
    text-transform: capitalize;
  }
  .text-muted {
    color: #617d98;
  }
  .item-image{
    width: 100%; 
    height: 170px;        
  }
  .item-name{
    padding: 3px;         
    margin-bottom:0 ;
  }
</style>
