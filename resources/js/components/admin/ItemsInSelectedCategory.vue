<template>
  <div>
    <div>
      <h1>{{category.name}}</h1>
      <router-link
        :to="'/editItemInCategory/' + category.id"
        class="btn btn-primary"
      >Edit item InCategory</router-link>
      <router-link to="/adminViewCategory" class="btn btn-primary">Go Back</router-link>
    </div>
    <br />
    <!-- <div class="image-wrapper">
      <div class="gallery__item gallery__item--1" v-for="item in list" :key="item.id">
        <router-link :to="'/item/' + item.id">
          <img v-bind:src="'../storage/items/' + item.image" class="gallery__img" alt="Image 1" />
          <h3 class="title" v-html="item.name"></h3>
          <p class="text-muted">{{item.description}}</p>
          <h4>
            <span class="small-text text-muted float-left">{{item.price}}birr</span>

          </h4>
        </router-link>
      </div>
    </div> -->

    <div class="container">
     <div
        class="row" >
      <div class="col-12 col-sm-6 col-md-4 col-lg-3  grid-onepart"  v-for="item in list"
        :key="item.id">
        <!-- id is user id and item.id is category id , don't be confused -->
        <div class="item-box">
        <router-link :to="'/item/' + item.id ">
          <img
            v-bind:src="'../storage/items/' + item.image"
            class="item-image"
            alt="item.image"
          />
           </router-link>
          <span class="item-name text-primary " v-html="item.name"></span>
          <span class="item-price float-right text-dark">{{item.price}}Birr</span>
          <p class="item-description text-muted">{{ item.description }}</p>
          
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
      id: this.$route.params.id,
      category: {},
      list: []
    };
  },
  mounted() {
    console.log("Component mounted.");
    this.fetchItemList();
    this.fetchCategoryList();
  },
  methods: {
    fetchItemList: function() {
      console.log("Fetching items...");

      axios
        .get("../api/items", {
          params: {
            id: this.id
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
    fetchCategoryList: function() {
      console.log("Fetching categories...");

      axios
        .get("../api/category1", {
          params: {
            id: this.id
          }
        })
        .then(response => {
          console.log(response.data);
          this.category = response.data;
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
   border: 1px solid rgba(0, 0, 0, 0.2);
  border-radius:0.5rem;
  }
  .item-box:hover{
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  }
  
  .item-image{
    width: 100%; 
    height: 170px;        
  }
  .item-name{
    padding: 3px;         
    margin-bottom:0 ;
    text-transform: capitalize;
  }
  .item-description{
    color: #617d98;
   
   
  }
  .item-price{
    font-weight: 700;
    
  }
  .add-tocart{
     text-align: center;
  }
</style>


