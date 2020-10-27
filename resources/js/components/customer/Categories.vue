<template>
  <div>
    <div class="image-wrapper">
      <div
        class="gallery__item gallery__item--1"
        v-for="item in list"
        :key="item.id"
      >
        <!-- id is user id and item.id is category id , don't be confused -->
        <router-link :to="'/items/' + item.id + '?id=' + id">
          <img
            v-bind:src="'storage/categories/' + item.image"
            class="gallery__img"
            alt="item.image"
          />
          <h3 class="title" v-html="item.name"></h3>
          <p class="text-muted">{{ item.description }}</p>
        </router-link>
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
