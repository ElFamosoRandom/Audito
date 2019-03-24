import Vue from 'vue'
import Router from 'vue-router'

import LoginPage from './pages/login/LoginPage'
import Register from './pages/register/Register'
import HomePage from './pages/home/HomePage'
import UserPage from './pages/user/UserPage'
import Programmation from './pages/program/Programmation'
import Nav from './pages/nav/Nav'
import Base from './pages/basepage/Base'
import Detail from './pages/detailevent/DetailPage'
import Add from './pages/addevent/AddEvent'
import Reservation from './pages/reservation/Reservation'
import DeleteEvent from './pages/deleteevent/DeleteEvent'
import Tarif from './pages/tarif/Tarif'

Vue.use(Router)

export default new Router({
    routes: [
        {
            path: '/login',
            name: 'login',
            component: LoginPage
        },
        {
            path: '/register',
            name: 'register',
            component:Register
        },
        /*{
            path: '/user/:id',
            name: 'user',
            component: UserPage
        },*/
        {
            path: '/',
            name: 'home',
            component: HomePage
        },
        {
            path: '/programmation',
            name: 'programmation',
            component: Programmation,
            
        },
        {
            path: '/detail/:id',
            name: 'detail',
            component: Detail
        },
        {
            path: '/addevent',
            name: 'add',
            component: Add
        },
        {
            path: '/deleteevent',
            name: 'delete',
            component: DeleteEvent
        },
        {
            path: '/reservation/:id',
            name: 'reservation',
            component: Reservation
        },
        {
            path: '/tarif',
            name: 'tarif',
            component: Tarif
        }
    ]
})
