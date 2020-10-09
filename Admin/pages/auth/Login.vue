<template>
  <div class="container mt-3">
    <div class="row">
      <div class="col-lg-2"></div>
      <div class="col-lg-8">
        <h1 class="text-secondary mb-3">Login</h1>
        <form action @submit.prevent="userLogin" class="bg-light text-dark p-5" id="authform">
          <div class="form-group row justify-content-center">
            <label for="username" class="col-sm-2 col-form-label col-form-label-lg">Username</label>
            <div class="col-sm-5">
              <input
                type="email"
                class="form-control form-control-md"
                id="username"
                placeholder="username"
                v-model="login.username"
              />
            </div>
          </div>

          <div class="form-group row justify-content-center">
            <label for="password" class="col-sm-2 col-form-label col-form-label-lg">Password</label>
            <div class="col-sm-5">
              <input
                type="password"
                class="form-control form-control-md"
                id="password"
                placeholder="password"
                v-model="login.password"
              />
            </div>
          </div>
          <nuxt-link to="/auth/register" class="text-primary">( New User )</nuxt-link>
          <br />
          <button type="submit" class="btn btn-outline-success mt-1">Login</button>

          <br />
          <span class="error">{{message}}</span>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import storeData from "../../store/storeData";
const axios = require("axios");
export default {
  data() {
    return {
      login: {
        username: "",
        password: "",
      },
      message: "",
    };
  },
  mounted() {},
  methods: {
    getcart: storeData.methods.getcart,
    async userLogin() {
      //  this.$auth.loginWith('laravel.passport')

      try {
        if (this.login.username !== "" && this.login.password !== "") {
          this.message = "";
          await this.$auth.loginWith("password_grant", {
            data: {
              grant_type: "password",
              client_id: "2",
              client_secret: "D1cXSlryQpJsyeHcbYDxlyQLARX0BbHqtaY5XwQs",
              scope: "",
              username: this.login.username,
              password: this.login.password,
            },
          });
          // if (!this.getcart(this.$auth.user.id)) {
          //   this.mycart();
          // } else {
          //   this.getcart(this.$auth.user.id);
          // }
          // if (this.$auth.loggedIn) {
          //   this.guestcart();
          // }
        } else {
          this.message = "Please enter username and password";
        }
      } catch (error) {
        console.log("Error: ", error);
        this.message = "Incorrect username or password";
      }
    },
  },
};
</script>