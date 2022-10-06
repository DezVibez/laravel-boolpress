import Vue from 'vue'
import VueRouter from 'vue-router'


//importo i componenti

import HomePage from './components/pages/HomePage'
import AboutPage from './components/pages/AboutPage'
import ContactsPage from './components/pages/ContactsPage'
import NotFoundPage from './components/pages/NotFoundPage'
import PostDetailPage from './components/pages/PostDetailPage'


//usa vue router
Vue.use(VueRouter)

//rotte con vue router

const routes = new VueRouter({
    mode: 'history',
    linkExactActiveClass: 'active',
    routes: [
        { path: '/', component: HomePage, name: 'home' },
        { path: '/about', component: AboutPage, name: 'about' },
        { path: '/contacts', component: ContactsPage, name: 'contacts' },
        { path: '/posts/:id', component: PostDetailPage, name: 'post-detail'},
        { path: '*', component: NotFoundPage, name: 'not-found'}
    ],
});

export default routes;