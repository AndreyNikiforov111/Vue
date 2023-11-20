
import PasswordIndex from "../passwords/Index.vue"
import PasswordCreate from "../passwords/Create.vue"
import PasswordEdit from "../passwords/Edit.vue"

import FolderCreate from "../folders/Create.vue"

import UsersIndex from "../users/Index.vue"
import UsersCreate from "../users/Create.vue"
import UsersEdit from "../users/Edit.vue"

import AccessEdit from "../access/Edit.vue"

import AccessUserEdit from "../accessUser/Edit.vue"

import Login from "../auth/Login.vue"
import Register from "../auth/Register.vue"


const routes = [
    {
        path: '/',
        component: PasswordIndex

    },
    {
        path: '/passwords',
        name: 'password',
        component: PasswordIndex
    },
    {
        path: '/passwords/create',
        component: PasswordCreate
    },
    {
        path: '/passwords/:id',
        component: PasswordEdit
    },
    {
        path: '/folders/create',
        component: FolderCreate
    },
    {
        path: '/users',
        component: UsersIndex
    },
    {
        path: '/users/create',
        component: UsersCreate
    },
    {
        path: '/users/:id',
        component: UsersEdit
    },
    {
        path: '/users/:id/access',
        component: AccessEdit
    },
    {
        path: '/passwords/:id/access',
        component: AccessUserEdit
    }


    ,
    {
        path: '/login',
        component: Login
    },
    {
        path: '/register',
        component: Register
    }

]

export default routes
