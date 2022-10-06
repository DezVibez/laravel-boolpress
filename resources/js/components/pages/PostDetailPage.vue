<template>
  <div id="post-detail-page">Dettaglio post</div>
</template>

<script>
    
export default {
  name: "PostDetailPage",
  data(){
    return {
        post: null,
    };
  },
  methods:{
    fetchPosts() {
      axios
        .get("http://localhost:8000/api/posts/1")
        .then(res => {
          this.post = res.data;
        })
        .catch(err => {
          console.error(err);
        })
        .then(() => {
          console.log("Chiamata Terminata");
        });
    },
  },
  mounted() {
    this.fetchPosts();
  },
};
</script>

