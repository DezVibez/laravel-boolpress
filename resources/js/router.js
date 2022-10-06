import Vue from 'vue'
import VueRouter from 'vue-router'


//importo i componenti

import HomePage from './components/pages/HomePage'
import AboutPage from './components/pages/AboutPage'
import ContactsPage from './components/pages/ContactsPage'
import NotFoundPage from './components/pages/NotFoundPage'


//usa vue router
Vue.use(VueRouter)

//rotte con vue router

const routes = new VueRouter({
    mode: 'history',
    linkExactActiveClass: 'active',
    routes: [
        { path: '/', component: HomePage, name: 'home' },
        { path: '/about', component: AboutPage },
        { path: '/contacts', component: ContactsPage },
        { path: '*', component: NotFoundPage }
    ],
});

export default routes;