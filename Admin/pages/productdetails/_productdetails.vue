<template>
  <!-- Start Container -->
  <div class="container">
    <!-- Start Row -->
    <div class="row" v-for="(product, id) in productDetails" :key="id" style="display:flex">
      <div class="col-lg-6">
        <!-- Product Image -->
        <img
          src="http://via.placeholder.com/100x100"
          class="card-img-top mb-2"
          style="max-width: 100%; height: auto;"
        />
      </div>
      <!-- Start First Col -->
      <div class="col-lg-5">
        <div class="content ml-5">
          <!-- Product Title -->
          <span class="display-2 text-secondary">{{product.name}}</span>
          <h2 class="mt-3">Rs.{{product.price}}</h2>

          <!-- Product Quantity -->
          <!-- <label>
            Quantity
            <span class="font-weight-bold">({{product.quantity}}</span> available)
          </label>-->
          <br />
          <!-- Prodcut Color -->
          <label>
            Color:
            <!-- <span class="font-weight-bold" v-if="cart.includes(product)">{{cart[id].color}}</span> -->
            <span class="font-weight-bold">{{selectedColor}}</span>
            <span v-if="!selectedColor" class="font-weight-bold">Please choose color</span>
          </label>
          <br />
          <i
            @click="setColor(color,)"
            icon="circle"
            class="fa fa-circle m-1 circle"
            v-for="(color, id) in product.color"
            :key="id"
            :style="{color:color}"
            aria-hidden="true"
          ></i>
          <br />

          <!-- Product Size -->
          <label v-if="product.size" class="mt-2">
            Size:
            <span v-if="!selectedSize" class="font-weight-bold">Please select size</span>

            <span v-else class="font-weight-bold">{{selectedSize}}</span>
          </label>
          <br />
          <!-- <button class="btn btn-outline-warning" @click="check(product, id)">Check</button> -->
          <div class="btn-group" role="group" aria-label="size">
            <!-- <template v-for="(sizes) in product.size">   -->
            <button
              @click="setSize(size, product.id)"
              style="text-transform:uppercase;"
              type="button"
              class="btn btn-outline-primary btn-lg m-1"
              v-for="(size,id) in product.size"
              :key="id"
            >{{size}}</button>
            <!-- </template> -->
          </div>
          <br />
          <span class="error">{{message}}</span>
          <br />
          <input
            type="email"
            v-model="email"
            v-if="guestmail"
            class="form-control mt-2"
            placeholder="like: example@yourshop.com"
          />
          <button
            @click="addtoCart(product, id)"
            v-if="active"
            class="btn btn-outline-success btn-lg btn-block mt-5"
          >Add To Cart</button>

          <!-- <template v-for="(cart, id) in cart"> -->

          <div class="mt-4" v-else>
            <button class="btn btn-outline-success" @click="removefromCart(product, id)">
              <i class="fa fa-minus" aria-hidden="true"></i>
            </button>
            <!-- <label>{{product.sale}}</label> -->
            <label>{{sale}}</label>
            <button
              class="btn btn-outline-success"
              @click="addtoCart(product, id)"
              :disabled="product.quantity < 1"
            >
              <i class="fa fa-plus" aria-hidden="true"></i>
            </button>
          </div>
          <!-- </template> -->
        </div>
      </div>

      <!-- End First Col -->
    </div>
    <!-- End Row -->
  </div>
  <!-- End Container -->
</template>

<script>
const axios = require("axios");
import storeData from "../../store/storeData";
export default {
  data() {
    return {
      cart: storeData.data.cart,
      product: storeData.data.product,
      productId: this.$route.params.productdetails,
      selectedSize: "",
      selectedColor: "",
      message: "",
      selected: storeData.data.selected,
      active: true,
      sale: storeData.data.sale,
      email: "",
      guestmail: false,
    };
  },
  methods: {
    addtolocalcart: function (product) {
      if (this.$auth.loggedIn) {
        this.$localforage.setItem(this.$auth.user.id, this.cart);
        this.$localforage.setItem(
          "p" + product.id + "sale" + this.$auth.user.id,
          this.sale
        );
      } else if(!this.$auth.loggedIn){
        this.$localforage.setItem("p" + product.id + "sale", this.sale);
        this.$localforage.setItem("guestcart", this.cart);
      }
        this.$localforage.setItem(product.id + "size", this.selectedSize);
        this.$localforage.setItem(product.id + "color", this.selectedColor);
    },

    deletelocalcart: function (product) {
      this.cart.forEach((item, id) => {
        if (item.product_id == product.id) {
          this.cart.splice(id, 1);
        }
      });
    },
    updatelocalcart: function (product) {
      this.cart.forEach((item) => {
        if (this.$auth.loggedIn) {
          if (
            item.product_id == product.id &&
            item.user_id == this.$auth.user.id
          ) {
            item.quantity = this.sale;
          }
        } else if (!this.$auth.loggedIn) {
          // this.$localforage.getItem(this.email).then((response) => {
          // response.forEach(localcart=>{
          if (item.product_id == product.id) {
            item.quantity = this.sale;
          }
          // })
          // });
        }
      });
    },
    activate: function () {
      if (this.cart.length < 1) {
        this.active = false;
      } else {
        this.active = true;
      }
    },
    myCart: storeData.methods.myCart,

    // ========= PRODUCT =========
    getproduct: storeData.methods.getProduct,
    updateproduct: storeData.methods.updateproduct,

    // ========= CART =========
    getcart: storeData.methods.getcart,
    updatecart: storeData.methods.updatecart,
    deletefromCart: storeData.methods.deletefromCart,

    //   Show Selected Color
    setColor(color) {
      this.selectedColor = color;
    },

    //   Show Selected Size
    setSize(size, id) {
      this.selectedSize = size;
    },
    addtoCart(product, id) {
      //  var sale = 0
      if (
        product.quantity > 0 &&
        this.selectedSize !== null &&
        this.selectedColor !== null &&
        this.sale < 1 &&
        this.$auth.loggedIn
      ) {
        this.message = "";
        this.guestmail = false;
        var sale = 0;
        sale++;
        this.sale = sale;
        this.active = false;
        product.sale++;
        product.quantity--;
        this.cart.push({
          user_id: this.$auth.user.id,
          product_id: product.id,
          color: this.selectedColor,
          size: this.selectedSize,
          quantity: this.sale,
          price: product.price,
        });
        if (this.$auth.loggedIn) {
          axios.post("http://127.0.0.1:8000/api/addtocart", {
            user_id: this.$auth.user.id,
            product_id: product.id,
            color: this.selectedColor,
            size: this.selectedSize,
            quantity: this.sale,
            price: product.price,
          });
        }
        this.updateproduct(product);
        console.log(this.sale);
        console.log(this.cart);
      }

      // If the item will be added to the cart
      else if (this.sale > 0) {
        this.sale++;
        this.active = false;
        product.sale++;
        product.quantity--;
        this.cart.forEach((cart) => {
          if (this.$auth.loggedIn && cart.product_id == product.id) {
            cart.quantity = this.sale;
            this.updatecart(this.$auth.user, product.id, product.sale);
          }
        });

        this.updateproduct(product);
      } else if (
        !this.$auth.loggedIn &&
        this.selectedSize !== null &&
        this.selectedColor !== null &&
        this.sale < 1
      ) {
        var sale = 0;
        sale++;
        this.sale = sale;
        product.sale++;
        product.quantity--;
        this.active = false;

        this.cart.push({
          user_id: 0,
          product_id: product.id,
          color: this.selectedColor,
          size: this.selectedSize,
          quantity: this.sale,
          price: product.price,
        });
        this.updateproduct(product);
        this.message = "";
      } else {
        this.message = "Please choose color and size";
      }
      this.addtolocalcart(product);
      this.updatelocalcart(product);
    },
    removefromCart(product, id) {
      this.sale--;
      product.sale--;
      product.quantity++;
      this.addtolocalcart(product);

      this.updatelocalcart(product);
      if (this.sale < 1 && this.$auth.loggedIn) {
        // delete product from indexeddb
        this.deletelocalcart(product);

        console.log("deleted: ", product);
        this.active = true;
        console.log("cart: ", this.cart);
        this.deletefromCart(this.$auth.user, product);
        try {
          this.updatecart(this.$auth.user, product.id, product.sale);
        } catch (error) {
          console.log("Error: ", error);
        }
        this.updatecart(this.$auth.user, product.id, product.sale);
      } 
      else if (this.sale < 1 && !this.$auth.loggedIn) {
        /*delete product from indexeddb*/
        this.deletelocalcart(product);
        this.active = true;
      }

      this.updateproduct(product);
      
    },
  },
  computed: {
    productDetails() {
      return this.product.filter((products) => products.id == this.productId);
    },
    choice() {
      return this.selected.filter((item) => item.id == this.productId);
    },
  },
  created() {
    this.getproduct();
    try {
      if (this.$auth.loggedIn)
      {
          this.myCart();
          this.$localforage
          .getItem("p" + this.productId + "sale" + this.$auth.user.id)
          .then((value) => {
            this.sale = value;
            if (this.sale > 0) {
              this.active = false;
            }
            }) 
      }
      else{
        // Sale
        this.$localforage
          .getItem("p" + this.productId + "sale")
          .then((value) => {
            this.sale = value;
            if (this.sale > 0) {
              this.active = false;
            }
          });
      } 
        
          // Size
          this.$localforage.getItem(this.productId + "size").then((value) => {
          this.selectedSize = value;
        });
        // Color
        this.$localforage.getItem(this.productId + "color").then((value) => {
          this.selectedColor = value;
        });
    } catch (error) {
      console.log("Error", error);
    }
  },
};
</script>

<style scoped>
.container {
  margin-top: 50px;
  margin-bottom: 100px;
}
</style>