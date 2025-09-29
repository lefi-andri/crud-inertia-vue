<script lang="ts" setup>
import SiteLayout from "@/layouts/SiteLayout.vue";
import { Head } from "@inertiajs/vue3";

const objectOfAttrs = "contact";
const message = "You loaded this page on " + new Date();
console.log(message);

const showAlert = () => {
  alert(message);
};

const status = "I make it ambigous";

const students = [
  {
    name: "Peter Parker",
    gender: "male",
  },
  {
    name: "Steve Rogers",
    gender: "male",
  },
  {
    name: "Natasha Romanov",
    gender: "female",
  },
  {
    name: "Tony Stark",
    gender: "male",
  },
];

const greeting = "Hello World!";

const products = [
  {
    id: "cc919e21-ae5b-5e1f-d023-c40ee669520c",
    name: "COBOL 101 vintage",
    description: "Learn COBOL with this vintage programming book",
    price: 399,
  },
  {
    id: "bcd755a6-9a19-94e1-0a5d-426c0303454f",
    name: "Sharp C2719 curved TV",
    description:
      "Watch TV like never before with the brand new curved " + "screen technology",
    price: 1995,
  },
  {
    id: "727026b7-7f2f-c5a0-ace9-cc227e686b8e",
    name: "Remmington X mechanical keyboard",
    description:
      "Excellent for gaming and typing, this Remmington X " +
      "keyboard features tactile, clicky switches for speed and accuracy",
    price: 595,
  },
];

const imgsrc =
  "https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80";
</script>

<template>
  <Head title="Contact" />
  <SiteLayout>
    <!-- Mencetak message di console -->
    <span v-bind:title="message">
      Hover your mouse over me for a few seconds to see my dynamically bound title!
    </span>
    <!-- Mencetak object -->
    {{ objectOfAttrs }}
    <!-- Mencetak object text -->
    <p v-text="objectOfAttrs"></p>
    <!-- Mencetak object html -->
    <div v-html="objectOfAttrs"></div>
    <!-- Membuat input -->
    <input v-model="objectOfAttrs" class="border" />
    <!-- Membuat button -->
    <button type="button" v-on:click="showAlert">Click Me!</button>

    <h1 v-if="status !== true && status !== false">The status is ambiguous</h1>
    <h1 v-else-if="status">The status is true</h1>
    <h1 v-else>The status is false</h1>

    <!-- Looping -->
    <ul>
      <li v-for="student in students">{{ student.name }}</li>
    </ul>

    <h1>{{ greeting }}</h1>

    <table class="table table-hover product-table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Description</th>
          <th>Price</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="product in products" track-by="id">
          <td>{{ product.name }}</td>
          <td>{{ product.description }}</td>
          <td>{{ product.price }}:-</td>
        </tr>
      </tbody>
    </table>

    <img v-bind:src="imgsrc" width="300" height="250" />
  </SiteLayout>
</template>

<style scoped>
h1 {
  color: red;
  font-weight: bold;
}
</style>
