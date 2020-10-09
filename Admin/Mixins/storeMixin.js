import storeData from '../store/storeData'
const axios = require('axios');
export const storeMixin = {
    methods:{
      getcart: storeData.methods.getcart,
      myCart() {
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
        });
      },
      guestCart: function () {
        var cart = storeData.data.cart
        this.$localforage.getItem('guestcart').then(response => {
          if (response !== null && this.$auth.loggedIn) {
            return axios.get('http://127.0.0.1:8000/api/selectcart/' + this.$auth.user.id).then(result => {
              if (result.data.length == 0) {
                response.forEach((item) => {
                  axios.post("http://127.0.0.1:8000/api/addtocart", {
                    user_id: this.$auth.user.id,
                    product_id: item.product_id,
                    color: item.color,
                    size: item.size,
                    quantity: item.quantity,
                    price: item.price,
                  });
                  cart.forEach((cart)=>{
                    cart.user_id = this.$auth.user.id
                  })
                })
              }
              
              else {
                this.$localforage.removeItem('guestcart')
                response.forEach((item) => {
                  this.$localforage.removeItem("p" + item.product_id + "sale")
                })
              }
            })
          }
          else if(!this.$auth.loggedIn && cart.length < 1 && response!==null){
            response.forEach((item) => {
            cart.push(item)
            })
          } 
        })
  
      }
  
    },
    beforeMount(){
          if(this.$auth.loggedIn)
            {
              this.myCart();
            }
            this.guestCart();
    }
}