<template>
<form @submit.prevent="submitForm" class="pt-6 pb-8 mb-4" enctype="multipart/form-data">
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
        Name
      </label>
      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" v-model="name" id="name" type="text" placeholder="Name">
    </div>
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
        Description
      </label>
      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" v-model="description" id="description" type="text" placeholder="Description">
    </div>
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="price">
        Price
      </label>
      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" v-model="price" id="price" type="number" placeholder="Price">
    </div>
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="quantity">
        Quantity
      </label>
      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" v-model="quantity" id="quantity" type="number" placeholder="Quantity">
    </div>
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
        Categories
      </label>
      <select multiple v-model="selectedCategories" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
        <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}</option>
  </select>
    </div>
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
        Image
      </label>
      <input type="file" id="image" @change="onFileChange" accept="image/*">
  </div>
    <div class="flex items-center justify-center">
      <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
        Create
      </button>
    </div>
  </form>
</template>

<script>

import axios from 'axios';
export default {
  data() {
    return {
        name: '',
        description: '',
        price: '',
        quantity: '',
        categories: [],
        selectedCategories: [],
        image: null,
    };
  },
  mounted() {
    // Fetch categories when component is mounted
    this.fetchCategories();
  },
  methods: {
    onFileChange(event) {
      this.image = event.target.files[0];
      console.log(event.target.files[0]);
    },
    fetchCategories() {
      // Make an HTTP request to fetch categories from backend
      axios.get('categories')
        .then(response => {
          this.categories = response.data;
        })
        .catch(error => {
          console.error('Error fetching categories:', error);
        });
    },
    submitForm() {
      const productData = {
        name: this.name,
        description: this.description,
        price: this.price,
        quantity: this.quantity,
        category_id: this.category_id,
        image: this.image,
      };
      productData.categories = this.selectedCategories;
      axios.post('submit-form', productData, {
        headers: {
          'Content-Type': 'multipart/form-data',
        },
      })
      .then(response => {
          console.log('Product added successfully:', response.data);

          this.name = '';
          this.description = '';
          this.price = '';
          this.quantity = '';
          this.selectedCategories = [];
          this.image = null;
          // Optionally, you can redirect the user or show a success message
        })
        .catch(error => {
          console.error('Error adding product:', error);
        });
    }
  }
};
</script>