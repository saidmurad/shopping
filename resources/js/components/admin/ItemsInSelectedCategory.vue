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
    <div class="image-wrapper">
      <div class="gallery__item gallery__item--1" v-for="item in list" :key="item.id">
        <router-link :to="'/item/' + item.id">
          <img v-bind:src="'../storage/items/' + item.image" class="gallery__img" alt="Image 1" />
          <h3 class="title" v-html="item.name"></h3>
          <p class="text-muted">{{item.description}}</p>
          <h4>
            <span class="small-text text-muted float-left">{{item.price}}birr</span>

            <!-- <span
              @click="addToCart( item.id, item.name, item.price )"
              class="btn btn-primary"
            >Add To Cart</span>

            <input type="number" v-model="quantity" style="width:60px" />-->
          </h4>
        </router-link>
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


