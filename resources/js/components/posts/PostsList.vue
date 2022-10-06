<template>
    <section id="posts-list">
        <h2>
            Posts
        </h2>

        <AppLoader v-if="isLoading"/>
        <div v-else>
            <div v-if="posts.length">
                <PostCard v-for="post in posts" 
                :key="post.id"
                :post = "post" />
            </div>

            <h5 v-else> Nessun Post </h5>
        </div>
    </section>
</template>

<script>

    import PostCard from  "./PostCard";
    import AppLoader from  "../AppLoader";
    export default {
        name: "PostsList",
        components: { 
            PostCard,
            AppLoader
         },
        data(){
            return{ 
                posts: [],
                isLoading: false
            }; 
        },
        methods: {
            fetchPosts(){
                this.isLoading = true;
                axios
                .get('http://localhost:8000/api/posts')
                .then((res) => {
                    this.posts = res.data;
                })
                .catch((err) => {
                    console.error(err)
                })
                .then(() => {
                    this.isLoading = false;
                });
            },
        },
        mounted(){
            this.fetchPosts();
        }
    };


</script>