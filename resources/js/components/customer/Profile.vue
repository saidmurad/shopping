<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="profile-container">
          <img
            v-bind:src="'storage/users/' + image"
            class="profile-picture img-circle elevation-2" 
            alt="image"
          />
          <p class="user-name"><span>{{firstName}} {{lastName}}</span></p>
          <p class="user-phoneNumber">Phone Number: <span>{{phoneNumber}}</span></p>
           <p class="user-email">Email: <span>{{email}}</span></p>
            <p class="user-sex">Sex: <span>{{sex}}</span></p>
            <div class="d-flex justify-content-center">
            <router-link  class="edit btn btn-primary mt-4" :to="'/editProfile' +  '?id=' + id">Edit Profile</router-link>
            </div>
          </div>  
          </div>
    </div>
</template>

<script>
export default {
    data: function() {
        return {
            id: this.$route.query.id,
            firstName: "",
            lastName: "",
            sex: "",
            phoneNumber: "",
            email:"",
            image:"",
           
        };
    },
    mounted() {
        
        console.log("Component mounted.");
        this.fetchCustomerData();
    },
    methods: {
        fetchCustomerData: function() {
            console.log("Fetching customer data...");
            self = this;
            axios
                .get("api/user/" + self.id)
                .then(response => {
                    console.log(response.data);
                    self.firstName = response.data.firstName;
                    self.lastName = response.data.lastName;
                    self.sex = response.data.sex;
                    self.phoneNumber = response.data.phoneNumber;
                     self.email = response.data.email;
                     self.image = response.data.image;
                    console.log(self.firstName);
                })
                .catch(error => {
                    console.log(error);
                });
        },
          }
};
</script>
<style  scoped>
span{
    font-weight: bold;
}
.profile-container{
    max-width: 200px;
}
 .profile-picture{
     width: 100%;
     height: 50%;
}
.user-name{
    text-align: center;
    text-transform: capitalize;
}
.user-phoneNumber{
    text-align: center;
}
.user-email{
    text-align: center;
}
.user-sex{
    text-align: center;
}
.edit{
    text-align: center;
}
</style>
