<template>
  <div class="container">
    <!-- <h1 class="text-secondary">Products {{this.$route.params}}</h1> -->

    <!-- Start Row -->
    <div class="row mt-4">
      <!-- ==== First Col ==== -->
      <div class="col-lg-3" v-for="(item, id) in product" :key="id">
        <!-- Product Image -->
        <div class="card border-0">
          <nuxt-link to @click.native="details(item)">
            <img
              src="http://via.placeholder.com/150x150"
              class="card-img-top mb-2"
              style="max-width: 100%; height: auto;"
            />

            <div class="card-body">
              <h6 class="card-title text-dark">{{item.name}}</h6>
              <h6 class="text-secondary">Rs.{{item.price}}</h6>
            </div>
            <!-- End Product body -->
          </nuxt-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import storeData from '../../store/storeData';
export default {
    data(){
        return{
            product: storeData.data.product
        }
    },
    methods:{
      getproduct:storeData.methods.getProduct,
      details:function(item){
        this.$router.push({path:'/productdetails/'+item.id })
      }
    },
    created(){
      this.getproduct()
    }
};
</script>

<style scoped>
nuxt-link{
  color: grey;
}
a:hover{
  text-decoration: none;
  
}

div.card:hover{
  box-shadow: 5px 5px 5px grey;
}
</style>