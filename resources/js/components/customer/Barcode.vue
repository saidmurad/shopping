<template>
    <div>
        <p class="error">{{ error }}</p>

        <p class="decode-result">
            Last result: <b>{{ result }}</b>
        </p>
        
      
  <input v-model="barcodeValue" /><br>
  <VueBarcode v-bind:value="barcodeValue">
    Show this if the rendering fails.
  </VueBarcode>


        
        <StreamBarcodeReader
          @decode="onDecode"></StreamBarcodeReader>
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
      
            console.log("Fetching items...");

            axios
            .get("api/itembarcode")
            .then(response => {
          console.log(response.data);
          this.item = response.data;
             })
            .catch(error => {
              console.log(error);
            });
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
