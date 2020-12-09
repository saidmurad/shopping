<template>
    <div class="container">
        <div class="container-fill">
            <div class="row pt-5">
                <div class="col-5 pr-5">
                    <h4 class="text-center text-info">Customers</h4>
                    <div>
                        <div class=" d-flex align-items-center">
                            <div style="width:20%">ID</div>
                            <div style="width:60%">NAME</div>
                            <div style="width:20%">DETAIL</div>
                        </div>
                        <hr />
                        <div v-for="user in users" :key="user.id">
                            <div class="d-flex align-items-center">
                                <div style="width:20%">
                                    <span> {{ user.id }}</span>
                                </div>
                                <div style="width:60%">
                                    <span>
                                        {{ user.firstName }}
                                        {{ user.lastName }}</span
                                    >
                                </div>
                                <div style="width:20%">
                                    <button
                                        class="btn btn-primary"
                                        @click="showUser(user.id)"
                                    >
                                        <span> Detail</span>
                                    </button>
                                </div>
                            </div>
                            <hr />
                        </div>
                    </div>
                </div>

                <div class="col-5">
                    <div class="container shadow pl-5 bg-light py-2">
                        <div class="profile-container">
                            <h4 class=" text-info text-center">
                                Customers Detail
                            </h4>
                            <br />
                            <img
                                v-bind:src="'storage/users/' + image"
                                class="profile-picture img-circle elevation-2"
                                alt="image"
                            />
                            <p class="user-name">
                                <span class="profile-title"
                                    >{{ firstName }} {{ lastName }}</span
                                >
                            </p>
                            <p class="user-phoneNumber">
                                Phone Number:
                                <span class="profile-title">{{
                                    phoneNumber
                                }}</span>
                            </p>
                            <p class="user-email">
                                Email:
                                <span class="profile-title">{{ email }}</span>
                            </p>
                            <p class="user-sex">
                                Sex:
                                <span class="profile-title">{{ sex }}</span>
                            </p>
                            <p class="user-sex">
                                Rate:
                                <span class="profile-title">{{ rate }}</span>
                            </p>
                        </div>

                        <form action="#" @submit.prevent="giveRate()">
                            <div class="form-group">
                                <label> Rate</label>
                                <input
                                    v-model="addedRate"
                                    type="number"
                                    name="name"
                                    class="form-control"
                                />
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    Give Rate
                                </button>
                            </div>
                        </form>
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
            users: [],
            id: "",
            firstName: "",
            lastName: "",
            email: "",
            phoneNumber: "",
            sex: "",
            image: "",
            rate: 0,
            file: "",
            addedRate: ""
        };
    },

    mounted: function() {
        console.log("items Component Loaded...");
        this.fetchCustomerList();
    },
    methods: {
        fetchCustomerList: function() {
            console.log("Fetching items...");
            self = this;
            axios
                .get("api/customers")
                .then(response => {
                    console.log(response.data);
                    this.users = response.data;
                })
                .catch(error => {
                    console.log(error);
                });

            axios
                .get("api/customer")
                .then(response => {
                    self.id = response.data.id;
                    self.firstName = response.data.firstName;
                    self.lastName = response.data.lastName;
                    self.phoneNumber = response.data.phoneNumber;
                    self.email = response.data.email;
                    self.sex = response.data.sex;
                    self.image = response.data.image;
                    self.rate = response.data.rate;
                    console.log(response.data.image);
                })
                .catch(error => {
                    console.log(error);
                });
        },
        showUser: function(id) {
            let self = this;
            axios.get("api/user/" + id).then(function(response) {
                self.id = response.data.id;
                self.firstName = response.data.firstName;
                self.lastName = response.data.lastName;
                self.phoneNumber = response.data.phoneNumber;
                self.email = response.data.email;
                self.sex = response.data.sex;
                self.image = response.data.image;
                self.rate = response.data.rate;

                let fileUrl = "storage/users/" + self.image;
                self.urlToBlob(fileUrl).then(function(blob) {
                    self.file = new File([blob], self.image);
                });
            });
        },
        giveRate: function(id) {
            console.log(this.id);

            let self = this;

            let formData = new FormData();
            var file = document.querySelector("#report");
            formData.append("file", this.file);
            formData.append("id", this.id);
            formData.append("firstName", this.firstName);
            formData.append("lastName", this.lastName);
            formData.append("sex", this.sex);
            formData.append("phoneNumber", this.phoneNumber);
            formData.append("rate", Number(this.rate) + Number(this.addedRate));
            // formData.append("rate", this.addedRate);
            formData.append("_method", "POST"); // ADD THIS LINE

            axios
                .post("api/user/giveRate", formData, {
                    params: {
                        id: this.id
                    }
                })
                .then(function(response) {
                    console.log(response.data);
                    self.showUser(self.id);
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        urlToBlob: function(url) {
            return new Promise((resolve, reject) => {
                var xhr = new XMLHttpRequest();
                xhr.open("GET", url, true);
                xhr.responseType = "blob";
                xhr.onload = function(e) {
                    resolve(this.response);
                };
                xhr.onerror = function(error) {
                    reject(error);
                };
                xhr.send();
            });
        }
    }
};
</script>

<style scoped>
.profile-title {
    font-weight: bold;
}
.profile-container {
    max-width: 250px;
    padding: 10px;
}
.profile-picture {
    width: 100%;
    height: 150px;
    text-align: center;
}
.user-name {
    text-align: center;
    text-transform: capitalize;
}
.user-phoneNumber {
    text-align: center;
}
.user-email {
    text-align: center;
}
.user-sex {
    text-align: center;
}
</style>
