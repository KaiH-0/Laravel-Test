<template>
    <h1>Create Product</h1>
  <form @submit.prevent="submitForm">
    <div>
        <label for="name">Name:</label>
        <input type="text" v-model="name" name="name" id="name" value="" required>
    </div>

    <div>
        <label for="description">Description:</label>
        <textarea name="description" v-model="description" id="description"></textarea>
    </div>

    <div>
        <label for="price">Price:</label>
        <input type="number" v-model="price" name="price" id="price" value="" step="0.01" required>
    </div>

    <div>
        <label for="quantity">Quantity:</label>
        <input type="number" v-model="quantity" name="quantity" id="quantity" value="1" required>
    </div>
    <div>
        <label for="selectedCategories">Category:</label>
        <select multiple v-model="selectedCategories">
                <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}</option>
            </select>
    </div>
    <button type="submit">Create</button>
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
        selectedCategories: []
    };
  },
  mounted() {
    // Fetch categories when component is mounted
    this.fetchCategories();
  },
  methods: {
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
      };
      productData.categories = this.selectedCategories;
      axios.post('submit-form', productData)
      .then(response => {
          console.log('Product added successfully:', response.data);

          this.name = '';
          this.description = '';
          this.price = '';
          this.quantity = '';
          this.selectedCategories = [];
          // Optionally, you can redirect the user or show a success message
        })
        .catch(error => {
          console.error('Error adding product:', error);
        });
    }
  }
};
</script>