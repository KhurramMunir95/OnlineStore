<template>
  <!-- Start Container -->
  <div class="container mt-3">
    <!-- {{cart}} -->
    <!-- {{cart.length}} -->
    <!-- IF -->
    <div v-if="$auth.loggedIn && cart.length > 0">
      <span class="display-3 mb-3">Shopping Cart</span>
      <button class="btn btn-outline-danger m-4" @click="reset">
        <i class="fa fa-times-circle" aria-hidden="true"></i>&nbsp;Reset Cart
      </button>

      <!-- Start Row -->
      <div class="row mt-5" v-for="(item, id) in cart" :key="id">
        <!-- <template v-if="$auth.loggedIn && item.user_id == $auth.user.id"> -->
        <template v-if="$auth.loggedIn">
          <!-- First Col -->
          <div class="col-lg-4">
            <img
              src="http://via.placeholder.com/600/EC816A"
              alt="product"
              style="max-width: 100%; height: auto;"
            />
          </div>

          <!-- Second Col -->
          <div class="col-lg-3">
            <div class="mt-3 p-2">
              <h1>{{item.id}}</h1>
              <h3>
                Rs.
                <span class="font-weight-bold text-default" :key="id">{{item.price}}</span>
              </h3>
              <h4>
                Quantity:
                <div class="mt-4">
                  <button
                    class="btn btn-outline-success"
                    @click="decrease(item, id)"
                    :disabled="item.quantity == 1"
                  >
                    <i class="fa fa-minus" aria-hidden="true"></i>
                  </button>
                  <label>{{item.quantity}}</label>
                  <button
                    class="btn btn-outline-success"
                    @click="increase(item, id)"
                    :disabled="active"
                  >
                    <i class="fa fa-plus" aria-hidden="true"></i>
                  </button>
                  <br />
                  <span class="error">{{message}}</span>
                </div>
                <!-- <span class="font-weight-bold text-default">{{item.quantity}}</span> -->
              </h4>
              <br />
              <h4>
                Color:
                <span class="font-weight-bold text-default">{{item.color}}</span>
              </h4>
              <h4>
                Size:
                <span
                  class="font-weight-bold text-default"
                  style="text-transform:uppercase;"
                >{{item.size}}</span>
              </h4>
            </div>
          </div>

          <!-- Third Col -->
          <div class="col-sm-2">
            <span
              class="close d-flex flex-wrap"
              @click="remove(item, id)"
              title="remove item"
            >&times;</span>
          </div>
        </template>
      </div>
      <!-- End Row -->

      <!-- Bill -->
      <div class="bill bg-light p-3 mt-4">
        <h4 style="border-bottom:1px solid grey">Total Items ({{cart.length}})</h4>
        <h5 class="font-weight-bold mt-1">Total&emsp;Rs.{{Total}}</h5>
      </div>
    </div>

    <!-- Else -->
    <div v-else class="mt-5">
      <i class="fa fa-cart-plus" aria-hidden="true" style="font-size:300px"></i>
      <h2>No items in your cart</h2>
    </div>
    <!-- <button @click="get">Get</button> -->
  </div>
  <!-- End Container -->
</template>

<script>
import storeData from "../store/storeData";
export default {
  data() {
    return {
      cart: storeData.data.cart,
      product: storeData.data.product,
      selectedSize: storeData.data.selectedSize,
      selectedColor: storeData.data.selectedColor,
      updateproduct: storeData.methods.updateproduct,
      updatecart: storeData.methods.updatecart,
      deletefromCart: storeData.methods.deletefromCart,
      active: false,
      message: "",
      productId: this.$route.params.productdetails,
    };
  },
  methods: {
    getproduct: storeData.methods.getProduct,
    getcart: storeData.methods.getcart,
    remove: function (item, id) {
      // item.quantity+=item.quantity
      this.product.forEach((product) => {
        if (product.id == item.product_id) {
          product.sale += product.quantity;
          product.sale = 0;
          this.updateproduct(item);
        }
      });
      this.cart.splice(id, 1);
    },
    reset: function () {
      this.product.forEach((item, index) => {
        //     if(item.quantity > 0){
        //       item.quantity+=item.sale
        //       item.sale = 0
        //       this.updateproduct(item)

        //     }

        this.cart.pop(item);
      });
    },
    increase: function (item) {
      // item quantity in Cart
      item.quantity++;

      this.product.forEach((product) => {
        if (product.id == item.product_id) {
          product.sale++;
          product.quantity--;
          // item quantity in Product
          // product.sale = item.quantity;

          if (product.quantity == 1) {
            this.active = true;

            this.message = "Maximum quantity reached";
          }
          this.updateproduct(product);
        }
        this.$localforage.setItem(
          "p" + item.product_id + "sale" + this.$auth.user.id,
          item.quantity
        );
      });
      this.$localforage.setItem(this.$auth.user.id, this.cart);

      this.updatecart(this.$auth.user, item.product_id, item.quantity);
    },

    decrease: function (item) {
      // item quantity in Cart
      item.quantity--;
      this.active = false;
      this.message = "";
      this.product.forEach((product) => {
        if (product.id == item.product_id) {
          // item quantity in Product
          product.sale = item.quantity;
          if (product.sale > 0) {
            product.quantity++;
          }
          this.updateproduct(product);
        }
        this.$localforage.setItem(
          "p" + item.product_id + "sale" + this.$auth.user.id,
          item.quantity
        );
      });
      this.$localforage.setItem(this.$auth.user.id, this.cart);
      this.updatecart(this.$auth.user, item.product_id, item.quantity);
    },
    myCart() {
      console.log(this.cart.length);
      this.$localforage.getItem(this.$auth.user.id).then((response) => {
        if (response !== null) {
          response.forEach((item) => {
            if (this.cart.length < 1) {
              for (var i = 0; i < response.length; i++) {
                if (item.user_id == this.$auth.user.id) {
                  this.cart.push(response[i]);
                } else if (this.cart.length > 0) {
                  this.cart.forEach((cart) => {
                    if (cart.user_id !== item.user_id) {
                      this.cart.push(response[i]);
                      console.log("No");
                    }
                  });
                }
              }
            }
          });
        } else {
          this.getcart(this.$auth.user.id);
        }

        console.log(this.cart, this.cart.length);
      });
    },
  },
  computed: {
    Total: function () {
      if (this.$auth.loggedIn) {
        var sum = 0;
        this.cart.forEach((cart) => {
          // if (cart.user_id == this.$auth.user.id) {
          sum += cart.price * cart.quantity;
          // }
        });
        return sum;
      }
    },
    cartdetails: function () {
      return this.cart.filter((item) => item.user_id == this.$auth.user.id);
    },
  },
  created() {
    this.getproduct();
    // try {
    //   this.guestcart()
    //   if (this.$auth.loggedIn) {
    //     this.myCart();
        
    //   }
    // } catch (error) {
    //   console.log("error: ", error);
    // }
  },
};
</script>

<style>
</style>