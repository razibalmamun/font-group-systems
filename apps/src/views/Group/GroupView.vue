<template>
  <main>
    <div class="d-flex bd-highlight mb-3">
      <div class="p-2 bd-highlight">
        <h1>Our Font Groups</h1>
        <p>List of avaibale font groups</p>
      </div>
      <div class="ms-auto p-2 bd-highlight align-self-center">
        <router-link
          :to="{ name: 'group-create' }"
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
          Create Font Group
        </router-link>
      </div>
    </div>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">NAME</th>
          <th scope="col">FONTS</th>
          <th scope="col">COUNT</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(font, key) in font_groups" :key="key">
          <th scope="row">{{ font.id }}</th>
          <td>{{ font.title }}</td>
          <td>{{ font.fonts }}</td>
          <td>{{ font.total_fonts }}</td>
          <td>
            <button
              type="button"
              v-on:click="deleteRow(font.id, key)"
              class="btn btn-danger btn-sm mr-1"
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

            <RouterLink
              :to="'/groups/' + font.id"
              class="btn btn-success btn-sm"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="16"
                height="16"
                fill="currentColor"
                class="bi bi-pencil-square"
                viewBox="0 0 16 16"
              >
                <path
                  d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"
                />
                <path
                  fill-rule="evenodd"
                  d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"
                />
              </svg>
            </RouterLink>
          </td>
        </tr>
      </tbody>
    </table>
  </main>
</template>

<script>
export default {
  name: "FontGroupList",
  data() {
    return {
      font_groups: [],
    };
  },
  created() {
    this.getFonts();
  },
  methods: {
    getFonts() {
      this.axios.get("fontGroup/index").then((response) => {
        if (response.data.status) {
          this.font_groups = response.data.font_groups;
        }
      });
    },
    async deleteRow(id, key) {
      try {
        let response = await this.axios.get("fontGroup/delete/" + id);
        if (response.data.status) {
          this.font_groups.splice(key, 1);
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
