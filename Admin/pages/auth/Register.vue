<template>
  <div class="container mt-3">
    <div class="row">
      <div class="col-lg-2"></div>
      <div class="col-lg-8">
        <h1 class="text-secondary mb-3">Register</h1>
        <form action @submit.prevent="userRegister" class="bg-style text-light p-5" id="authform">
          <div class="form-group row justify-content-center">
            <label for="username" class="col-sm-2 col-form-label col-form-label-lg">Username</label>
            <div class="col-sm-5">
              <input
                type="text"
                class="form-control form-control-md"
                id="username"
                placeholder="username"
                v-model="register.username"
              />
            </div>
          </div>

          <div class="form-group row justify-content-center">
            <label for="email" class="col-sm-2 col-form-label col-form-label-lg">Email</label>
            <div class="col-sm-5">
              <input
                type="text"
                class="form-control form-control-md"
                id="email"
                placeholder="email"
                v-model="register.email"
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
                v-model="register.password"
              />
            </div>
          </div>
           <nuxt-link to='/auth/login' class="text-success">Already a member? Login</nuxt-link>
          <br/>
          <button type="submit" class="btn btn-primary mb-2 mt-2">Register</button>
          <br />
          <span class="text-success font-weight-bolder" style="font-size:20px;">{{message}}</span>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
const axios = require("axios");
export default {
  data() {
    return {
      register: {
        username: "",
        email: "",
        password: "",
      },
      message: "",
    };
  },
  methods: {
    userRegister() {
      try {
        if (
          this.register.email !== "" &&
          this.register.username !== "" &&
          this.password !== ""
        ) {
          this.message = "";
          axios
            .post("http://127.0.0.1:8000/api/register/" + this.register.email, {
              name: this.register.username,
              email: this.register.email,
              password: this.register.password,
            })
            .then((response) => {
              if (response.data == true) {
                this.message = "email already exists!";
              } else {
                this.message = "Successfully Registered";
              }
            });
          // this.$router.push("/");
        }
      } catch (err) {
        console.log(err);
      }
    },
  },
};
</script>