<template>
  <!-- Start Row -->
  <div class="row mt-2" v-if="$auth.loggedIn && $auth.user.id == 1">
    <!-- Start First Col -->
    <div class="col-lg-3">
      <div class="collapse show" id="collapseExample">
        <ul class="nav flex-column p-3 text-center" style="display:block;">
          <li class="nav-item">
            <nuxt-link to="/products" class="nav-link text-secondary">
              <i class="fa fa-archive" aria-hidden="true"></i>&emsp;Products
            </nuxt-link>
          </li>

          <li class="nav-item">
            <nuxt-link to="/categories" class="nav-link text-secondary">
              <i class="fa fa-cubes" aria-hidden="true"></i>&emsp;Categories
            </nuxt-link>
          </li>

          <li class="nav-item">
            <nuxt-link to="/addproduct" class="nav-link text-secondary">
              <i class="fa fa-plus icon mr-2" aria-hidden="true"></i>Add Product
            </nuxt-link>
          </li>
          <li class="nav-item">
            <nuxt-link to="/addcategory" class="nav-link text-secondary">
              <i class="fa fa-plus icon mr-2" aria-hidden="true"></i>Add Category
            </nuxt-link>
          </li>
        </ul>
      </div>
    </div>
    <!-- End First Col -->

    <!-- Start Second Col -->
    <div class="col-lg-1 bg-light" id="centercol"></div>
    <!-- End Second Col -->

    <!-- Start Third Col -->
    <div class="col-lg-8 bg-light p-4">
      <!-- <font-awesome-icon
        class="bars"
        icon="bars"
        data-toggle="collapse"
        data-target="#collapseExample"
        aria-expanded="false"
        aria-controls="collapseExample"
        style="cursor:pointer; font-size:25px; color: grey;"
      />-->
      <div v-if="form === 'addproduct'">
        <h3 class="mb-4 text-secondary font-weight-light">
          <i class="fa fa-plus-square" aria-hidden="true"></i>&nbsp;Add
          <span class="font-weight-bold">Product</span>
        </h3>

        <!-- ====================== PRODUCT ====================== -->
        <!-- Start Product Form -->
        <form method="POST" v-on:submit.prevent="createproduct">
          <span class="error">{{message}}</span>
          <!-- Name -->
          <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label col-form-label-lg">Name</label>
            <div class="col-sm-5">
              <input
                type="text"
                class="form-control form-control-md"
                id="name"
                placeholder="name"
                v-model="item.name"
              />
            </div>
          </div>

          <!-- Category -->
          <div class="form-group row">
            <label for="category" class="col-sm-2 col-form-label col-form-label-lg">Category</label>

            <div class="col-sm-5">
              <!-- <input
                type="text"
                class="form-control form-control-md"
                id="category"
                placeholder="category"
                v-model="item.category_id"
              />-->
              <select class="form-control custom-select" id="category" v-model="item.category_id">
                <option selected disabled>Select Category</option>
                <optgroup v-for="(parent, id) in filtercategory" :label="parent.name" :key="id">
                  <template v-for="(type, id) in categories">
                    <option v-if="type.parent_id == parent.id" :key="id" :value="type.id">&emsp;{{type.name}}</option>
                  </template>
                </optgroup>
              </select>
            </div>
          </div>

          <!-- Price -->
          <div class="form-group row">
            <label for="price" class="col-sm-2 col-form-label col-form-label-lg">Price</label>
            <div class="col-sm-5">
              <input
                type="text"
                class="form-control form-control-md"
                id="price"
                placeholder="price"
                v-model="item.price"
              />
            </div>
          </div>

          <!-- Quantity -->
          <div class="form-group row">
            <label for="quantity" class="col-sm-2 col-form-label col-form-label-lg">Quantity</label>
            <div class="col-sm-5">
              <input
                type="text"
                class="form-control form-control-md"
                id="quantity"
                placeholder="quantity"
                v-model="item.quantity"
              />
            </div>
          </div>

          <!-- Color -->
          <div class="form-group row">
            <label for="category" class="col-sm-2 col-form-label col-form-label-lg">Color</label>
            <div class="col-sm-5">
              <select
                multiple
                class="form-control custom-select"
                id="category"
                v-model="item.color"
              >
                <option selected>Select Color</option>
                <option value="blue">Blue</option>
                <option value="black">Black</option>
                <option value="brown">Brown</option>
                <option value="green">Green</option>
                <option value="white">White</option>
                <option value="orange">Orange</option>
                <option value="red">Red</option>
                <option value="purple">Purple</option>
              </select>
            </div>
          </div>
          <!-- Size -->
          <div class="form-group row">
            <label for="category" class="col-sm-2 col-form-label col-form-label-lg">Size</label>
            <div class="col-sm-5">
              <select
                multiple
                class="form-control custom-select"
                id="category"
                v-model="item.size"
              >
                <option selected>Select Size</option>
                <option value="s">S</option>
                <option value="m">M</option>
                <option value="l">L</option>
                <option value="xl">XL</option>
                <option value="xs">XS</option>
              </select>
              <!-- <div class="form-check">
                <input class="form-check-input" type="checkbox" value id="small"/>
                <label class="form-check-label" for="small">S</label>
              </div>

              <div class="form-check">
                <input class="form-check-input" type="checkbox" value id="medium"/>
                <label class="form-check-label" for="medium">M</label>
              </div>

              <div class="form-check">
                <input class="form-check-input" type="checkbox" value id="large"/>
                <label class="form-check-label" for="large">L</label>
              </div>
                
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value id="xlarge"/>
                <label class="form-check-label" for="xlarge">XL</label>
              </div>-->
            </div>
          </div>

          <!-- Submit button -->
          <button type="submit" class="button">Add</button>
        </form>
      </div>
      <!-- End Product Form -->

      <!-- <h3 class="text-center mb-4 text-secondary">
        <font-awesome-icon icon="plus" />&nbsp;Add Category
      </h3>-->

      <!-- Start Category -->
      <div v-if="form === 'addcategory'">
        <h3 class="mb-4 text-secondary font-weight-light">
          <i class="fa fa-plus-square" aria-hidden="true"></i>&nbsp;Add
          <span class="font-weight-bold">Category</span>
        </h3>

        <!-- ====================== CATEGORY ====================== -->
        <!-- Start Category Form -->
        <form method="POST" v-on:submit.prevent="createCategory">
          <span class="error">{{message}}</span>
          <!-- Name -->
          <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label col-form-label-lg">Name</label>
            <div class="col-sm-5">
              <input
                type="text"
                class="form-control form-control-md"
                id="name"
                placeholder="Name"
                v-model="category.name"
              />
            </div>
          </div>

          <!-- ParentId -->
          <div class="form-group row">
            <label for="parentid" class="col-sm-2 col-form-label col-form-label-lg">Category</label>
            <div class="col-sm-5">
              <select class="form-control custom-select" id="parentid" v-model="category.parent_id">
                <option selected>Select Category</option>
                <option v-for="(type, id) in categories" :key="id" :value="type.id">{{type.name}}</option>
              </select>
            </div>
          </div>

          <!-- Submit button -->
          <button type="submit" class="button">Add</button>
        </form>
        <!-- End Category Form -->
      </div>
      <!-- End Category -->

      <!-- Start Admin -->
      <div v-if="form === 'admin'">
        <h1 class="text-secondary ml-3 font-weight-light">
          Admin
          <span class="font-weight-bold">Hub</span>
        </h1>
      </div>
      <!-- End Admin -->

      <!-- Start products table -->
      <div class="table-responsive">
        <table class="table" v-if="form === 'products'">
          <thead>
            <tr>
              <th scope="col">Id</th>
              <th scope="col">Name</th>
              <th scope="col">Price</th>
              <th scope="col">Colors</th>
              <th scope="col">Sizes</th>
              <th scope="col">Stock</th>
              <th scope="col">Sale</th>
              <th scope="col" colspan="2">Actions</th>
            </tr>
          </thead>
          <tbody v-if="product.length > 0">
            <tr v-for="(item, id) in product" :key="id">
              <td>{{item.id}}</td>
              <td>
                <input type="text" v-model="item.name" />
              </td>
              <td>
                <input type="text" v-model="item.price" />
              </td>
              <td>
                <div>
                  <!-- {{this.item.size}} -->
                  <select
                    multiple
                    class="form-control custom-select"
                    id="category"
                    v-model="item.color"
                  >
                    <option value="blue">Blue</option>
                    <option value="black">Black</option>
                    <option value="brown">Brown</option>
                    <option value="green">Green</option>
                    <option value="white">White</option>
                    <option value="orange">Orange</option>
                    <option value="red">Red</option>
                    <option value="purple">Purple</option>
                  </select>
                </div>
              </td>
              <td>
                <div>
                  <!-- {{this.item.size}} -->
                  <select
                    multiple
                    class="form-control custom-select"
                    id="category"
                    v-model="item.size"
                  >
                    <option value="s">S</option>
                    <option value="m">M</option>
                    <option value="l">L</option>
                    <option value="xl">XL</option>
                    <option value="xs">XS</option>
                  </select>
                </div>
              </td>
              <td>
                <input type="text" v-model="item.quantity" />
              </td>
              <td>
                <input type="text" v-model="item.sale" />
              </td>
              <td>
                <button class="button" id="action" @click="updateproduct(item)">Update</button>
                <button class="button danger" id="action" @click="deleteproduct(item, id)">Delete</button>
              </td>
            </tr>
          </tbody>
        </table>

        <!-- Categories Table -->
        <table class="table" v-if="form === 'categories'">
          <thead>
            <tr>
              <th scope="col">Id</th>
              <th scope="col">Name</th>
              <th scope="col">parent_id</th>
              <th scope="col" colspan="2">Actions</th>
            </tr>
          </thead>
          <tbody v-if="categories.length > 0">
            <tr v-for="(category, id) in categories" :key="id">
              <td>{{category.id}}</td>
              <td>
                <input type="text" v-model="category.name" />
              </td>
              <td>
                <input type="text" value="category.name" v-model="category.parent_id" />
              </td>
              <td>
                <button class="button" id="action" @click="updateCategory(category)">Update</button>
                <button
                  class="button danger"
                  id="action"
                  @click="deleteCategory(category, id)"
                >Delete</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- End products table -->

      <!-- Start categories table -->
      <!-- <div class="table-responsive">
        
      </div>-->
      <!-- End categories table -->
    </div>
    <!-- End Third Col -->

    <!-- Start Last Col -->
    <!-- <div class="col-lg-1 bg-light"></div> -->
    <!-- End Last Col -->
  </div>
  <!-- End Row -->
</template>

<script>
const axios = require("axios");

import storeData from "../store/storeData";
export default {
  data() {
    return {
      form: this.$route.params.form,
      product: storeData.data.product,
      categories: [],
      item: {
        id: "",
        name: "",
        price: "",
        quantity: "",
        color: [],
        size: [],
        sale: 0,
        category_id: "",
      },
      category: {
        name: "",
        parent_id: "",
      },
      message: "",
    };
  },
  // async asyncData(){
  //   let response = await axios.get('http://127.0.0.1:8000/api/selectproduct');
  //   const data = response.data;
  //   const content = data.map(info=>info);
  //   // return {content};
  //   console.log('response:',content)
  // },
  methods: {
    /* ==== Start products ==== */

    // Select Products
    // Call Products API
    getproduct: storeData.methods.getProduct,
    updateproduct: storeData.methods.updateproduct,

    // Insert Products
    createproduct: function () {
      if (
        this.item.name.length !== 0 &&
        this.item.price.length !== 0 &&
        this.item.quantity.length !== 0 &&
        this.item.category_id.length !== 0 &&
        this.item.color !== "" &&
        this.item.size !== ""
      ) {
        try {
          axios.post("http://127.0.0.1:8000/api/createproduct", {
            name: this.item.name,
            price: this.item.price,
            quantity: this.item.quantity,
            color: this.item.color,
            size: this.item.size,
            sale: this.item.sale,
            category_id: this.item.category_id,
          });
          (this.item.name = ""),
            (this.item.price = ""),
            (this.item.quantity = "");
          this.message = "";
        } catch (error) {
          console.log("Error: ", error);
        }
      } else {
        this.message = "Please fill all the fields";
      }
    },

    // Update Products
    
    // updateproduct: function (item) {
    //   if (
    //     axios.post("http://127.0.0.1:8000/api/updateproduct/" + item.id, {
    //       name: item.name,
    //       color: item.color,
    //       price: item.price,
    //       size: item.size,
    //       quantity: item.quantity,
    //     })
    //   ) {
    //     alert("Recorded Updated Successfully");
    //   }
    // },

    // Delete Products
    deleteproduct: function (item, id) {
      console.log(item.id);
      // var choice = confirm("Are you sure you want to delete?");
      // if (choice === true) {
        axios.delete("http://127.0.0.1:8000/api/deleteproduct/" + item.id);
        this.product.splice(id, 1);
        console.log(id);
      // }
    },
    /* ==== End products ==== */

    /* ==== Start categories ==== */

    // Select Categories
    // Call Categories API
    getcategory: function () {
      return axios
        .get("http://127.0.0.1:8000/api/selectcategory")
        .then((response) => {
          this.categories = response.data;
        });
    },

    // Insert Category
    createCategory: function () {
      if (this.category.name !== "") {
        this.message = "";
        try {
          axios.post("http://127.0.0.1:8000/api/createcategory", {
            name: this.category.name,
            parent_id: this.category.parent_id,
          });

          this.categories.push({
            name: this.category.name,
            parent_id: this.category.parent_id,
          });

          this.category.name = "";
          this.category.parent_id = "";
        } catch (error) {
          console.log("Error: ", error);
        }
      } else {
        this.message = "Please fill all the fields";
      }
    },
    // Update Category
    updateCategory: function (category) {
      if (
        axios.post("http://127.0.0.1:8000/api/updatecategory/" + category.id, {
          name: category.name,
          parent_id: category.parent_id,
        })
      ) {
        alert("Record Updated Successfully");
      }
    },
    // Delete Category
    deleteCategory(category, id) {
      var choice = confirm("Are you sure you want to delete?");
      if (choice === true) {
        axios.delete("http://127.0.0.1:8000/api/deletecategory/" + category.id);
        this.category.splice(id, 1);
      }
    },

    /* ==== End categories ==== */
  },
  computed: {
    filtercategory: function () {
      return this.categories.filter((category) => !category.parent_id);
    },
  },
  created() {
    this.getproduct();
    this.getcategory();
  }
};
</script>

<style>
</style>