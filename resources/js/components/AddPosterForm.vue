<template>
  <div class="container">
    <form @submit.prevent="submitNewPoster">
      <div class="form-group">
        <label for="poster_name">Poster Name</label>
        <input v-model="newPoster.name" type="text" class="form-control" id="poster_name" aria-describedby="nameHelp" required>
        <small id="nameHelp" class="form-text text-muted">Provide a name for the poster.</small>
      </div>
      <div class="form-group">
        <label for="poster_description">Description</label>
        <input v-model="newPoster.description" type="text" class="form-control" id="poster_description">
      </div>
      <div class="form-group">
        <label for="poster_width">Width (in.)</label>
        <input v-model="newPoster.width" type="number" min="0" max="999.999" step="0.001" class="form-control" id="poster_width" required>
      </div>
      <div class="form-group">
        <label for="poster_height">Height (in.)</label>
        <input v-model="newPoster.height" type="number" min="0" max="999.999" step="0.001" class="form-control" id="poster_height" required>
      </div>
      <div class="form-group">
        <label for="poster_orientation">Orientation</label>
        <select v-model="newPoster.orientation" class="form-control" id="poster_orientation" required>
          <option value="landscape">Landscape</option>
          <option value="portrait">Portrait</option>
        </select>
      </div>
      <div class="form-group">
        <label for="poster_image">Image</label>
        <input
          type="file"
          class="form-control-file"
          id="poster_image"
          accept="image/png, image/jpeg"
          ref="posterImage"
          v-on:change="handleFileUpload()"
          required
        >
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        newPoster: {
          orientation: 'portrait',
        },

        posterImage: '',

        errors: {}
      }
    },

    methods: {
      /**
       * Handle file uploads
       */
      handleFileUpload(){
        this.posterImage = this.$refs.posterImage.files[0];
      },

      /**
       * Submit the new poster
       */
      submitNewPoster() {
        this.errors = {};
        const formData = new FormData();

        Object.keys(this.newPoster).forEach(key => {
          console.log(key, this.newPoster[key])
          formData.append(key, this.newPoster[key]);
        });

        formData.append('posterImage', this.posterImage);

        axios
          .post('/posters', formData,
            {
              headers: {
                  'Content-Type': 'multipart/form-data'
              }
            }
          ).then(response => {
            window.location = response.data.redirect;
          }).catch(error => {
            if (error.response.status === 422) {
              this.errors = error.response.data.errors || {};
            }
          });
      }
    }
  }
</script>
