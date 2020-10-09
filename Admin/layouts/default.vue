<template>
  <div>
    <Navbar/>
    <Nuxt />
  </div>
</template>

<script>

// importing mixin
import { storeMixin } from '../Mixins/storeMixin'

export default {
  // calling mixin
  mixins:[storeMixin]
}
</script>
<style>
body{
  background-color: #F0E9E4;
  overflow: auto;
  overflow-x: hidden;
  
}

.bg-style{
  background-color: #150427;
}

html {
  font-family:
    'Source Sans Pro',
    -apple-system,
    BlinkMacSystemFont,
    'Segoe UI',
    Roboto,
    'Helvetica Neue',
    Arial,
    sans-serif;
  font-size: 16px;
  word-spacing: 1px;
  -ms-text-size-adjust: 100%;
  -webkit-text-size-adjust: 100%;
  -moz-osx-font-smoothing: grayscale;
  -webkit-font-smoothing: antialiased;
  box-sizing: border-box;
}

*,
*::before,
*::after {
  box-sizing: border-box;
  margin: 0;
}

.button--green {
  display: inline-block;
  border-radius: 4px;
  border: 1px solid #3b8070;
  color: #3b8070;
  text-decoration: none;
  padding: 10px 30px;
}

.button--green:hover {
  color: #fff;
  background-color: #3b8070;
}

.button--grey {
  display: inline-block;
  border-radius: 4px;
  border: 1px solid #35495e;
  color: #35495e;
  text-decoration: none;
  padding: 10px 30px;
  margin-left: 15px;
}

.button--grey:hover {
  color: #fff;
  background-color: #35495e;
}

ul.nav {
  display: block;
  height: 700px;
  border: 2px solid transparent;
  background-color: whitesmoke;
  /* border-top-color: silver;
  border-right-color: silver; */
  box-shadow: 5px 5px 5px silver;
  /* max-width: 300px; */
}

div.col-lg-8{
  height: 700px;
}

.button{
  width: 20%;
  background:linear-gradient(#060b55, rgb(36, 2, 59));
  border-color: transparent;
  color:white;
  opacity:0.9;
  box-shadow: 5px 5px 5px  grey;
  padding: 10px;
  border-radius: 5px;
  height: 44px;
}

.button:hover{
  opacity: 0.8;
  color:white;
  text-decoration: none;
}

button:focus{
  outline-color: transparent;
}

.bars{
  display: none;
}

div.table-responsive{
  height: 500px;
  overflow:auto;
  /* top: 0%; */
  /* position: absolute; */
}

#action{
  width: 80px;
  margin: 4px;

}

.danger{
  background:linear-gradient(red, maroon);
  border: none;
}

td > input{
  border: none;
  /* text-align: center; */
  width: 110px;
  background-color: transparent;
}

td > input:focus{
  outline: none;
}

td > div{
  width: 100px;;
}

.error{
  color: red;
  font-size: 20px;
}

.circle{
  font-size:25px;
  cursor: pointer;
}

.scart{
  font-size: 25px;
  cursor: pointer;
  color: grey;
}

.scart:hover{
  color: limegreen;
}

.close{
  cursor: pointer;
}

#authform{
  box-shadow: 5px 10px 5px 5px grey;
  border-radius: 10px;
}
li{
  margin-right: 0;
}

li#nav-right{
  margin-left: 180%;
}

li#nav-logout{
   margin-left: 190%;
}

@media (max-width: 1000px) {

  div.container{
    margin-bottom: 100px;
  }
  ul.nav{
    /* display: flex; */
    height: 200px;
    display: block;
  }
  /* div#centercol{
    display: none;
  } */

  body{
    overflow: auto;
    overflow-x: hidden ;
  }

  .bars{
    display: block;
    margin-bottom: 5px;
  }

  div.col-lg-8{
    height: 100%;
  }

  table{
    margin-left:0;
  }

  /* Action Buttons */
  #action{
  width: 80px;
  margin: 4px;
}

li#nav-right{
  margin-left: 0;
}

li#nav-logout{
   margin-left: 0;
}

}
</style>
