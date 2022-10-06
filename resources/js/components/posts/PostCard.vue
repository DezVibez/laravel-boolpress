<template>
  <div class="card">
    <div class="card-body">
      <div class="card-header my-3 d-flex justify-content-between">
        <h5 class="card-title">{{ post.title }}</h5>
        <button>Vedi</button>
      </div>
      <h6 class="card-subtitle">Pubblicato il: {{ publishedAt }}</h6>
      <p class="card-text">

        {{ post.content }}
      </p>

      <div class="card-body">
        <a href="#" class="card-link">Card link</a>
        <a href="#" class="card-link">Another link</a>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "PostsCard",
  props: {
    post: Object,
  },
  computed: {
    publishedAt(){

        const postDate = new Date(this.post.created_at);
        let day = postDate.getDate();
        let month = postDate.getMonth() + 1;
        let year = postDate.getFullYear();

        if(day < 10) day = "0" + day;
        if(month < 10) month = "0" + month;

        return `${day}/${month}/${year}`;
    }
  }
};
</script>