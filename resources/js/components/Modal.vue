<template>
  <div class="container">
    <button @click="show = true" class="bg-blue-500 hover:bg-blue-700 p-2 rounded-md">add toto..</button>
    <div class="pl-96">
    <x :showModal="show" />

    </div>
  </div>
</template>

<script>
import x from "../components/ExampleComponent.vue";
export default {
  data() {
    return {
      show: false,
    };
  },
  components: {
    x,
  },
};
</script>