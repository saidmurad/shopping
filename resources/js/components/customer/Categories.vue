<template>
  <div>
    <!-- <div class="image-wrapper">
      <div
        class="item-box category gallery__item gallery__item--1"
        v-for="item in list"
        :key="item.id"
      > -->
        <!-- id is user id and item.id is category id , don't be confused -->
        <!-- <router-link :to="'/items/' + item.id + '?id=' + id">
          <img
            v-bind:src="'storage/categories/' + item.image"
            class="gallery__img"
            alt="item.image"
          />
           </router-link>
          <h4 class="item-name title" v-html="item.name"></h4>
          <p class=" description text-muted">{{ item.description }}</p>
       
      </div>
    </div> -->

    <div class="container"
    >
      
      <div
        class="row"
       
      >
      <div class="col-12 col-sm-6 col-md-4 col-lg-3  grid-onepart"  v-for="item in list"
        :key="item.id">
        <!-- id is user id and item.id is category id , don't be confused -->
        <div class="item-box">
        <router-link :to="'/items/' + item.id + '?id=' + id">
          <img
            v-bind:src="'storage/categories/' + item.image"
            class="item-image"
            alt="item.image"
          />
           </router-link>
          <h5 class="item-name title text-primary" v-html="item.name"></h5>
          <p class=" description text-muted">{{ item.description }}</p>
          </div>
          </div>
       
      </div>
   
    </div>
  </div>
</template>

<script>
export default {
  data: function () {
    return {
      list: [],
      id: this.$route.query.id,
    };
  },
  mounted() {
    console.log("Component mounted.");
    this.fetchcategoryList();
  },
  methods: {
    fetchcategoryList: function () {
      console.log("Fetching categorys...");
      axios
        .get("api/category")
        .then((response) => {
          console.log(response.data);
          this.list = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
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
