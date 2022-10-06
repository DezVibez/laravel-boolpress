<template>
  <div id="post-detail-page">Dettaglio post

    <PostCard :post="post" />


  </div>
</template>

<script>
    import PostCard from '../posts/PostCard.vue'
export default {
  name: "PostDetailPage",
  components: { PostCard },
  data(){
    return {
        post: null,
    };
  },
  methods:{
    fetchPosts() {
      axios
        .get("http://localhost:8000/api/posts/" + this.$route.params.id )
        .then(res => {
          this.post = res.data;
          console.log(res.data);
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

