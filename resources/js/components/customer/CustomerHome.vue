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
    <div v-if="showSearch==true" class="image-wrapper">
      <div class="gallery__item gallery__item--1" v-for="cari in caris" :key="cari.id">
        <router-link :to="'/category/' + cari.id">
          <img v-bind:src="'storage/categories/' + cari.image" class="gallery__img" alt="Image 1" />
          <h3 class="title" v-html="cari.name"></h3>
          <p class="text-muted">{{cari.description}}</p>
        </router-link>
      </div>
    </div>

    <div v-if="showSearch==false" class="image-wrapper">
      <div class="gallery__item gallery__item--1" v-for="photo in list" :key="photo.id">
        <router-link :to="'/category/' + photo.id">
          <img v-bind:src="'storage/categories/' + photo.image" class="gallery__img" alt="Image 1" />
          <h3 class="title" v-html="photo.name"></h3>
          <p class="text-muted">{{photo.description}}</p>
        </router-link>
      </div>
    </div>

    <div class="row mt-2">
      <div class="col-md-12">
        <nav>
          <ul class="pagination">
            <li v-bind:class="{disabled:!pagination.first_link}" class="page-item">
              <router-link
                to="#"
                @click="fetchcategoryList(pagination.first_link)"
                class="page-link"
              >&laquo;</router-link>
            </li>
            <li v-bind:class="{disabled:!pagination.prev_link}" class="page-item">
              <a href="#" @click="fetchcategoryList(pagination.prev_link)" class="page-link">&lt;</a>
            </li>
            <li
              v-for="n in pagination.last_page"
              v-bind:key="n"
              v-bind:class="{active: pagination.current_page == n}"
              class="page-item"
            >
              <a
                href="#"
                @click="fetchcategoryList(pagination.path_page + n)"
                class="page-link"
              >{{n}}</a>
            </li>
            <li v-bind:class="{disabled:!pagination.next_link}" class="page-item">
              <a href="#" @click="fetchcategoryList(pagination.next_link)" class="page-link">&gt;</a>
            </li>
            <li v-bind:class="{disabled:!pagination.last_link}" class="page-item">
              <a href="#" @click="fetchcategoryList(pagination.last_link)" class="page-link">&raquo;</a>
            </li>
          </ul>
        </nav>
      </div>
      <div class="col-md-12">
        Page: {{pagination.from_page}} - {{pagination.to_page}}
        Total: {{pagination.total_page}}
      </div>
    </div>
    <p>{{storeValue}}</p>
  </div>
</template>

<script>
export default {
  data: function() {
    return {
      list: [],
      search: "",
      showSearch: false,
      caris: [],
      pagination: {}
    };
  },
  computed: {
    storeValue() {
      return this.$store.state.counter;
    }
  },
  mounted() {
    console.log("Component mounted.");
    this.fetchcategoryList();
  },
  methods: {
    fetchcategoryList: function(pagi) {
      pagi = pagi || "api/homeCategory";
      console.log("Fetching categorys...");
      axios
        .get(pagi)
        .then(response => {
          console.log(response.data);
          this.list = response.data;
          this.pagination = {
            current_page: response.meta.current_page,
            last_page: response.meta.last_page,
            from_page: response.meta.from,
            to_page: response.meta.to,
            total_page: response.meta.total,
            path_page: response.meta.path + "?page=",
            first_link: response.links.first,
            last_link: response.links.last,
            prev_link: response.links.prev,
            next_link: response.links.next
          };
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
