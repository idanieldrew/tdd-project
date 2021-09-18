<template>
  <div v-if="showModal" class="z-50 fixed bg-white w-1/3 h-3/6 text-center">
    <div class="text-right">
      <button class="rounded-full bg-gray-200" @click="cancel">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          height="24px"
          viewBox="0 0 24 24"
          width="24px"
          fill="#000000"
        >
          <path d="M0 0h24v24H0V0z" fill="none" />
          <path
            d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z"
          />
        </svg>
      </button>
    </div>
    <div class="p-2 w-1/2 text-center mx-auto">
      <p class="p-3 bg-yellow-400 animate-pulse text-black rounded-lg">
        CREATE TOTURIAL
      </p>
    </div>
    <form @submit.prevent="create">
      <div class="p-2">
        <input
          type="text"
          placeholder="title"
          v-model="form.title"
          class="w-full border-2 border-gray-200 rounded-md p-2"
        />
      </div>

      <div class="p-2">
        <input
          type="text"
          placeholder="body"
          v-model="form.body"
          class="w-full border-2 border-gray-200 rounded-md p-2"
        />
      </div>

      <div>
        <button type="submit" class="py-2 px-4 bg-indigo-500 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-opacity-75">Add</button>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: {
        title: "",
        body: "",
      },
    };
  },
  props: {
    showModal: {
      required: true,
      Boolean,
      default: false,
    },
  },
  mounted() {
    console.log("mounted");
  },
  methods: {
    cancel() {
      this.showModal = false;
    },
    async create() {
      try {
        let response = await axios.post("store/totourial", this.form);
      } catch (error) {
        alert(error)
      }
    },
  },
};
</script>
