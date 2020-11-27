<template>
    <div class="container">
        <div class="row">
      <div class="col-5">
          <div class="row justify-content-center">
            <div class="profile-container">
          <img
            v-bind:src="'storage/users/' + image"
            class="profile-picture img-circle elevation-2" 
            alt="image"
          />
          <p class="user-name p-0"><span>{{firstName}} {{lastName}}</span></p>
          <p class="user-phoneNumber p-0">Phone Number: <span>{{phoneNumber}}</span></p>
           <p class="user-email">Email: <span>{{email}}</span></p>
            <p class="user-sex">Sex: <span>{{sex}}</span></p>
          </div>  
          </div>
       </div>
         <div class="col-7">
            <form
                action="#"
                @submit.prevent="updateProfile()"
                enctype="multipart/form-data"
            >
                <div class="form-group">
                
                    <input
                        type="file"
                        class="form-control"
                        v-on:change="onFileChange"
                        accept=".jpg, .jpeg, .png"
                    />
                </div>
                <div class="form-group">
                    <input
                        v-model="firstName"
                        type="text"
                        name="firstName"
                        placeholder="First Name"
                        class="form-control"
                    />
                </div>
                <div class="form-group">
                    <input
                        v-model="lastName"
                        type="text"
                        name="lastName"
                        placeholder="Last Name"
                        class="form-control"
                    />
                </div>
                <div class="form-group">
                    <input
                        v-model="sex"
                        type="text"
                        name="sex"
                        placeholder="Sex"
                        class="form-control"
                    />
                </div>
                <div class="form-group">
                    <input
                        v-model="phoneNumber"
                        type="text"
                        name="phoneNumber"
                        placeholder="Phone Number"
                        class="form-control"
                    />
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        Update item
                    </button>
                </div>
            </form>
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
            email:"",
            phoneNumber: "",
            image:"",
            file: ""
        };
    },
    mounted() {
        self = this;
        console.log("Component mounted.");
        this.fetchCustomerData();
        console.log(this.id);
        let fileUrl ="storage/users/" + this.image;
        this.urlToBlob(fileUrl).then(function(blob){
          console.log(blob)
          self.file = new File([blob], self.image);
          console.log(self.file);
          console.log(fileUrl)
  // you will get blob object of that file here
        })
        
    },
    methods: {
        onFileChange(e) {
            console.log(e.target.files[0]);
            this.file = e.target.files[0];
        },
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
                    self.email = response.data.email;
                    self.phoneNumber = response.data.phoneNumber;
                     self.image = response.data.image;
                    console.log(self.firstName);

                     
                     let fileUrl ="storage/users/" + self.image;
                     console.log(fileUrl);

                     self.urlToBlob(fileUrl).then(function(blob){
                      console.log(blob)
                      self.file = new File([blob], self.image);})
                })
                .catch(error => {
                    console.log(error);
                });
        },
        updateProfile: function() {
            console.log(this.file);
            console.log(this.firstName);

            let self = this;

            let formData = new FormData();
            var file = document.querySelector("#report");
            formData.append("file", this.file);
            formData.append("id", this.id);
            formData.append("firstName", this.firstName);
            formData.append("lastName", this.lastName);
            formData.append("sex", this.sex);
            formData.append("phoneNumber", this.phoneNumber);
            formData.append("_method", "POST"); // ADD THIS LINE

            axios
                .post("api/user/store", formData, {
                    params: {
                        id: this.id
                    }
                })
                .then(function(response) {
                    self.fetchCustomerData();
                    console.log(response.data);
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
span{
    font-weight: bold;
}
.profile-container{
    max-width: 300px;
    padding: 40px;
}
 .profile-picture{
     width: 100%;
     height: 40%;
     text-align: center;
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
