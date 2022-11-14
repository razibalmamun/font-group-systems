<template>
  <main>
    <h3>{{ title }}</h3>
    <p>You have to select at least two fonts</p>
    <form class="row g-3" v-on:submit.prevent="formSubmitHandler">
      <div class="col-md-12">
        <label for="inputEmail4" class="form-label">Group Title</label>
        <input
          required
          v-model="form.title"
          type="text"
          class="form-control"
          placeholder="Group Title"
          id="inputEmail4"
        />
      </div>

      <div class="col-12">
        <div v-for="(row, index) in form.rows" :key="index" class="card">
          <div class="card-body p-0">
            <div class="d-flex bd-highlight">
              <div class="p-2 flex-fill bd-highlight">
                <input
                  required
                  v-model="row.font_name"
                  type="text"
                  class="form-control form-select-sm"
                  placeholder="Font name"
                />
              </div>
              <div class="p-2 flex-fill bd-highlight">
                <select
                  required
                  v-model="row.font_id"
                  class="form-select form-select-sm"
                  aria-label=".form-select-sm example"
                >
                  <option selected>Select a Font</option>
                  <option
                    v-for="(font, key) in fonts"
                    :key="key"
                    :value="font.id"
                  >
                    {{ font.font_original_file_name }}
                  </option>
                </select>
              </div>
              <div class="p-2 flex-fill bd-highlight">
                <input
                  required
                  v-model="row.font_size"
                  type="number"
                  class="form-control form-select-sm"
                  placeholder="Specific size"
                />
              </div>
              <div class="p-2 flex-fill bd-highlight">
                <input
                  required
                  v-model="row.font_price"
                  type="number"
                  class="form-control form-select-sm"
                  placeholder="Price change"
                />
              </div>
              <div class="p-2 flex-fill bd-highlight">
                <button
                  type="button"
                  v-on:click="removeRow(index)"
                  class="btn btn-outline-danger btn-sm"
                >
                  x
                </button>
              </div>
            </div>
            <!--d-flex-->
          </div>
        </div>
      </div>

      <div class="col-12">
        <div class="d-flex justify-content-between">
          <div class="">
            <button
              type="button"
              v-on:click="addRow"
              class="btn btn-outline-success btn-sm"
            >
              +Add Row
            </button>
          </div>

          <div class="">
            <button type="submit" class="btn btn-success btn-sm">Save</button>
          </div>
        </div>
        <!--d-flex-->
      </div>
    </form>
  </main>
</template>

<script>
export default {
  name: "FrontGroupAddEdit",
  props: {
    operation: String,
  },
  data() {
    return {
      error: null,
      loading: false,
      title: "Create Font Group",
      fonts: [],
      form: {
        title: "",
        rows: [
          {
            font_name: "",
            font_id: "",
            font_size: "",
            font_price: "",
          },
        ],
      },
    };
  },
  created() {},
  mounted() {
    this.initData();
    if (this.operation == "create") {
    }
    if (this.operation == "edit") {
      this.title = "Edit Font Group";
      this.initEdit();
    }
  },
  methods: {
    async initData() {
      let response = await this.axios.get("font/index");
      this.fonts = response.data.fonts;
    },
    async initEdit() {
      let response = await this.axios.get(
        "/fontGroup/edit/" + this.$route.params.id
      );
      this.form = { ...this.form, ...response.data.row };
    },
    async formSubmitHandler() {
      if (this.operation == "create") {
        this.create();
      }
      if (this.operation == "edit") {
        this.update();
      }
    },
    async create() {
      try {
        let response = await this.axios.post("fontGroup/save", this.form);
        if (response.data.status) {
          this.$toast.clear();
          this.$toast.success(response.data.message, {
            position: "top-right",
          });
          this.$router.push("/groups");
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
    async update() {
      try {
        let response = await this.axios.post(
          "fontGroup/update/" + this.$route.params.id,
          this.form
        );
        if (response.data.status) {
          this.$router.push("/groups");
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
    addRow() {
      this.form.rows.push({
        font_name: "",
        font_id: "",
        font_size: "",
        font_price: "",
      });
    },
    removeRow(index) {
      this.form.rows.splice(index, 1);
    },
  },
};
</script>
