<template>
  <main>
    <div
      class="card text-center card-upload"
      @dragover="dragover"
      @dragleave="dragleave"
      @drop="drop"
      @click="selectFile"
    >
      <div class="card-body">
        <input
          type="file"
          name="file"
          id="fileInput"
          class="hidden-input"
          @change="onChange"
          ref="file"
          accept=".ttf"
        />
        <p>
          <template v-if="loading">
            <div class="spinner-border spinner-border-sm" role="status">
              <span class="visually-hidden">Loading...</span>
            </div>
          </template>
          <template v-else>
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="28"
              height="28"
              fill="currentColor"
              class="bi bi-cloud-upload"
              viewBox="0 0 16 16"
            >
              <path
                fill-rule="evenodd"
                d="M4.406 1.342A5.53 5.53 0 0 1 8 0c2.69 0 4.923 2 5.166 4.579C14.758 4.804 16 6.137 16 7.773 16 9.569 14.502 11 12.687 11H10a.5.5 0 0 1 0-1h2.688C13.979 10 15 8.988 15 7.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 2.825 10.328 1 8 1a4.53 4.53 0 0 0-2.941 1.1c-.757.652-1.153 1.438-1.153 2.055v.448l-.445.049C2.064 4.805 1 5.952 1 7.318 1 8.785 2.23 10 3.781 10H6a.5.5 0 0 1 0 1H3.781C1.708 11 0 9.366 0 7.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383z"
              />
              <path
                fill-rule="evenodd"
                d="M7.646 4.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V14.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3z"
              />
            </svg>
          </template>
        </p>
        <h5 class="card-title">
          <div v-if="isDragging">Release to drop files here.</div>
          <div v-else>Click to upload or drag and drop</div>
        </h5>
        <p class="card-text text-danger" v-if="error">
          <i>{{ error }}</i>
        </p>
        <p class="card-text" v-else>Only TTF File Allowed</p>
      </div>
    </div>
  </main>
</template>

<script>
export default {
  name: "FontAdd",
  data() {
    return {
      error: null,
      loading: false,
      isDragging: false,
      files: [],
    };
  },
  created() {},
  methods: {
    selectFile() {
      let fileInputElement = this.$refs.file;
      fileInputElement.click();
    },
    onChange() {
      this.files = [...this.$refs.file.files];
      this.uploadFiles();
    },
    dragover(e) {
      e.preventDefault();
      this.isDragging = true;
    },
    dragleave() {
      this.isDragging = false;
    },
    drop(e) {
      e.preventDefault();
      this.$refs.file.files = e.dataTransfer.files;
      this.onChange();
      this.isDragging = false;
    },
    uploadFiles() {
      this.loading = true;
      const files = this.files;
      const formData = new FormData();
      files.forEach((file) => {
        formData.append("selectedFiles", file);
      });

      this.axios({
        method: "POST",
        url: "font/doUpload",
        data: formData,
        headers: {
          "Content-Type": "multipart/form-data",
        },
      }).then((response) => {
        this.$toast.clear();
        this.error = "";
        if (response.data.status) {
          this.$toast.success(response.data.message, {
            position: "top-right",
            max: false,
          });
          this.$router.push("/");
        } else {
          this.error = response.data.message;
          this.$toast.error(response.data.message, {
            position: "top-right",
            max: false,
          });
        }
        this.loading = false;
      });
    },
  },
};
</script>
