<template>
    <div>
        <p class="error">{{ error }}</p>

        <p class="decode-result">
            Last result: <b>{{ result }}</b>
        </p>
        
      
  <!-- <input v-model="barcodeValue" /><br>
  <VueBarcode v-bind:value="barcodeValue">
    Show this if the rendering fails.
  </VueBarcode> -->
 
   

       
        <StreamBarcodeReader class="scan" style="display:block;"
          @decode="onDecode"></StreamBarcodeReader>
           <button @click="startScan" class="btn btn-primary btn-xs">Scan</button>
          <div class="itemContent" >
              <img
            v-bind:src="'storage/items/' + item.image"
            class="gallery__img"
            alt="item.image"
          />
             <p v-bind:value="item.name"></p>
             <p>{{item.description}}</p>
             <p>{{item.price}}</p>
          </div>
    </div>
</template>

<script>
// import { QrcodeStream } from "../../../../src";
import { StreamBarcodeReader  } from "vue-barcode-reader";
import  VueBarcode  from "vue-barcode";


export default {
    components: { StreamBarcodeReader , VueBarcode },

    data() {
        return {
            result: "",
            error: "",
            barcodeValue: 'test',
            item:{},
        };
    },

//     mounted() {
//          axios
//             .get("api/itemByBarcode"
//             )
//             .then(response => {
//           console.log(response.data);
//           this.item = response.data;
//              })
//             .catch(error => {
//               console.log(error);
//             });
   
//   },

    methods: {
        onDecode(result) {
            this.result = result;
            var scan = document.querySelector(".scan");
            var itemContent = document.querySelector(".itemContent");

            console.log("Fetching items...");
            console.log(result);

            axios
            .get("api/itembarcode",
             {
          params: {
            barcode: this.result
          }
        })
            .then(response => {
          console.log(response.data);
          this.item = response.data;
          scan.style.display = "none";
          itemContent.style.display = "block";
         


             })
            .catch(error => {
              console.log(error);
            });
    },

     startScan() {
         var scan = document.querySelector(".scan");
         var itemContent = document.querySelector(".itemContent");

         scan.style.display = "block";
         itemContent.style.display = "none";
     },
     

        // async onInit(promise) {
        //     try {
        //         await promise;
        //     } catch (error) {
        //         if (error.name === "NotAllowedError") {
        //             this.error =
        //                 "ERROR: you need to grant camera access permisson";
        //         } else if (error.name === "NotFoundError") {
        //             this.error = "ERROR: no camera on this device";
        //         } else if (error.name === "NotSupportedError") {
        //             this.error =
        //                 "ERROR: secure context required (HTTPS, localhost)";
        //         } else if (error.name === "NotReadableError") {
        //             this.error = "ERROR: is the camera already in use?";
        //         } else if (error.name === "OverconstrainedError") {
        //             this.error = "ERROR: installed cameras are not suitable";
        //         } else if (error.name === "StreamApiNotSupportedError") {
        //             this.error =
        //                 "ERROR: Stream API is not supported in this browser";
        //         }
        //     }
        // }
    }
};
</script>

<style scoped>
.error {
    font-weight: bold;
    color: red;
}
</style>
