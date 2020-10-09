<template>
  <div class="container">
      <h1 v-if="$auth.loggedIn" class="mt-4 font-weight-light" style="color:indigo;">Welcome&nbsp;<span style="color:indigo;" class="font-weight-bold">{{$auth.user.name}}</span></h1>   
      <h1 v-else class="mt-4 font-weight-light" style="color:indigo;">YOUR&nbsp;<span style="color:indigo;" class="font-weight-bold">SHOP</span></h1>
  </div>
</template>

<script>
import { storeMixin } from '../Mixins/storeMixin'
export default {
  mixins:[storeMixin]
}
</script>

<style>
.container {
  margin: 0 auto;
  /* min-height: 100vh; */
  /* display: flex; */
  justify-content: center;
  align-items: center;
  text-align: center;
 
}

.title {
  font-family:
    'Quicksand',
    'Source Sans Pro',
    -apple-system,
    BlinkMacSystemFont,
    'Segoe UI',
    Roboto,
    'Helvetica Neue',
    Arial,
    sans-serif;
  display: block;
  font-weight: 300;
  font-size: 100px;
  color: #35495e;
  letter-spacing: 1px;
}

.subtitle {
  font-weight: 300;
  font-size: 42px;
  color: #526488;
  word-spacing: 5px;
  padding-bottom: 15px;
}

.links {
  padding-top: 15px;
}
</style>
