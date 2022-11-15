<template>
  <main>
    <div class="d-flex bd-highlight mb-3">
      <div class="p-2 bd-highlight">
        <h1>Our Fonts</h1>
        <p>Browse a list of Zepto fonts to build your font group</p>
      </div>
      <div class="ms-auto p-2 bd-highlight align-self-center">
        <router-link
          :to="{ name: 'font-create' }"
          class="btn btn-success btn-sm"
          tag="button"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="16"
            height="16"
            fill="currentColor"
            class="bi bi-plus-square"
            viewBox="0 0 16 16"
          >
            <path
              d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"
            />
            <path
              d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"
            />
          </svg>
          Create Font
        </router-link>
      </div>
    </div>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">FRONT NAME</th>
          <th scope="col">PREVIEW</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(font, key) in fonts" :key="key">
          <th scope="row">{{ font.id }}</th>
          <td>{{ font.font_original_file_name }}</td>
          <td>
            <img
              alt="Example Style"
              class="logo"
              :src="base_url + 'font/fontstyle/' + font.font_file_name"
              width="125"
            />
          </td>
          <td>
            <button
              v-on:click="deleteRow(font.id, key)"
              type="button"
              class="btn btn-danger btn-sm"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="16"
                height="16"
                fill="currentColor"
                class="bi bi-trash"
                viewBox="0 0 16 16"
              >
                <path
                  d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"
                />
                <path
                  fill-rule="evenodd"
                  d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"
                />
              </svg>
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </main>
</template>

<script>
export default {
  name: "FontList",
  data() {
    return {
      fonts: [],
      base_url: "",
    };
  },
  created() {
    this.getFonts();
    this.base_url = import.meta.env.VITE_BASEURL;
  },
  methods: {
    getFonts() {
      this.axios.get("font/index").then((response) => {
        if (response.data.status) {
          this.fonts = response.data.fonts;
        }
      });
    },
    async deleteRow(id, key) {
      try {
        let response = await this.axios.get("font/delete/" + id);
        if (response.data.status) {
          this.fonts.splice(key, 1);
          this.$toast.clear();
          this.$toast.success(response.data.message, {
            position: "top-right",
          });
        } else {
          this.$toast.clear();
          this.$toast.error(response.data.message, {
            position: "top-right",
          });
        }
      } catch (error) {
        this.$toast.clear();
        this.$toast.error("Operation Failed", {
          position: "top-right",
        });
      }
    },
  },
};
</script>
