<template>
<div>
    <h1 class="text-xl py-4">Laravel</h1>
    <a :href="route('logout')"> logout </a>
    <ul>
      <li v-for="product in products" :key="product.id">
        {{ product.name }} - ${{ product.price }}

        <img :src="product.image">
      </li>
    </ul>
</div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      products: [],
    };
  },
  mounted() {
    this.fetchProducts();
  },
  methods: {
    fetchProducts() {
      axios.get('products')
        .then(response => {
          this.products = response.data;
        })
        .catch(error => {
          console.error('Error fetching products:', error);
        });
    }
  }
};
</script>