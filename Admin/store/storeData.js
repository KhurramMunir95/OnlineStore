const axios = require('axios');
const storeData = {

  data: {
    product: [],
    cart: [],
    selectedSize: '',
    selectedColor: '',
    sale: 0
  },
  methods: {

    // Fetcing data from cart on the basis of indexeddb
    myCart() {

      var cart = storeData.data.cart
      this.$localforage.getItem(this.$auth.user.id).then((response) => {
        if (response !== null) {

          response.forEach((item) => {
            if (cart.length < 1) {
              for (var i = 0; i < response.length; i++) {
                if (item.user_id == this.$auth.user.id) {
                  cart.push(response[i]);
                } else if (cart.length > 0) {
                  cart.forEach((cart) => {
                    if (cart.user_id !== item.user_id) {
                      cart.push(response[i]);
                      console.log("No");
                    }
                  });
                }
              }
            }
          });
        }
        // else{
        //   this.getcart(this.$auth.user.id)
        // }

        // console.log(this.cart, this.cart.length)
      });

    },

    // ============== LOGIN ==============
    loggedIn() {
      if (this.$auth.loggedIn) {
        this.$router.push('/')
      }
    },

    // ============== PRODUCTS ==============

    // SELECT PRODUCTS
    getProduct: function () {
      return axios.get("http://127.0.0.1:8000/api/selectproduct")
        .then((response) => {
          this.product = response.data;
        });

    },
    // UPDATE PRODUCTS
    updateproduct: function (item) {

      axios.post("http://127.0.0.1:8000/api/updateproduct/" + item.id, {
        name: item.name,
        color: item.color,
        price: item.price,
        size: item.size,
        quantity: item.quantity,
        sale: item.sale
      })


    },

    // ============== CART ==============

    // SELECT CART
    getcart: function (id) {
      var cart = storeData.data.cart
      return axios.get('http://127.0.0.1:8000/api/selectcart/' + id)
        .then((response) => {
          response.data.forEach((item) => {
            if (cart.length < 1) {
              for (var i = 0; i < response.data.length; i++) {
                cart.push(response.data[i])
                console.log(response.data[i])
              }
              // cart.push(item)
            }

            cart.forEach((cart) => {
              if (cart.length > 0 && cart.id !== item.id) {

                cart.push(item)
                console.log('No')
                console.log(item)
              }
            })

          })
        })
    },

    // UPDATE CART
    updatecart: function (user, id, sale) {
      try {
        axios.post("http://127.0.0.1:8000/api/updatecart/" + user.id + '/' + id, {
          quantity: sale
        });
      }
      catch (error) {
        console.log('error: ', error)
      }

    },

    // DELETE FROM CART
    deletefromCart: function (user, product) {
      axios.delete("http://127.0.0.1:8000/api/deletefromcart/" + user.id + '/' + product.id);
    },

  }
}

export default storeData;