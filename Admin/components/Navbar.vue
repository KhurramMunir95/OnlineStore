<template>
  <div>
    <!-- Start Nav  -->
    <nav class="navbar navbar-expand-lg bg-light navbar-light w-100">
      <!-- Toggler Button -->
      <button
        type="button"
        class="navbar-toggler"
        data-target="#navbarContent"
        data-toggle="collapse"
        aria-controls="navbarContent"
        aria-label="Toggler"
        aria-expanded="false"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="navbar-brand" style="color:indigo;">
        YOUR
        <span class="font-weight-bold" style="color:indigo;">SHOP</span>
      </div>

      <!-- Start Nav links -->
      <div class="collapse navbar-collapse" id="navbarContent">
        <ul class="navbar-nav mx-auto">
          <li class="nav-item">
            <nuxt-link to="/" class="nav-link">Home</nuxt-link>
          </li>

          <li class="nav-item">
            <nuxt-link to="/shop/products" class="nav-link">Shop</nuxt-link>
          </li>

          <template v-if="$auth.loggedIn">
            <li class="nav-item" v-if="$auth.user.id==1">
              <nuxt-link to="/admin" class="nav-link">Admin</nuxt-link>
            </li>
            <!-- <li class="nav-item font-weight-bold" id="nav-right">
              <nuxt-link to class="nav-link">{{$auth.user.name}}</nuxt-link>
            </li>-->
            <li class="nav-item" id="nav-logout">
              <nuxt-link to class="nav-link" @click.native="logout">Logout</nuxt-link>
            </li>
          </template>

          <template v-else>
            <li class="nav-item" id="nav-right">
              <nuxt-link to="/auth/Login" class="nav-link">Login</nuxt-link>
            </li>
            <li class="nav-item">
              <nuxt-link to="/auth/Register" class="nav-link">Register</nuxt-link>
            </li>
          </template>
        </ul>
      </div>
      <!-- End Nav links -->

      <!-- Shopping Cart  -->
      <nuxt-link to="/cart">
        <i class="fa fa-shopping-cart scart" aria-hidden="true"></i>

        <label>{{this.cart.length}}</label>
      </nuxt-link>
    </nav>
    <!-- End Nav -->
  </div>
</template>

<script>
import storeData from "../store/storeData";
export default {
  data() {
    return {
      cart: storeData.data.cart,
      getcart: storeData.methods.getcart,
    };
  },
  methods: {
    async logout() {
      this.cart.forEach((item) => {
        this.cart.splice(item);
      });
      this.$localforage.removeItem('guestcart')
      await this.$auth.logout();
      
    },
    created(){
      console.log('created   ')
      this.cart = storeData.data.cart
    },
  },
};
</script>

<style scoped>
.icon {
  font-size: 20px;
}

h1.navbar-brand {
  color: hotpink;
}

nav {
  box-shadow: 5px 5px 5px silver;
  width: 100%;
}

div.navbar-brand {
  cursor: pointer;
}

label {
  font-size: 18px;
  font-weight: 600;
  cursor: pointer;
}
</style>