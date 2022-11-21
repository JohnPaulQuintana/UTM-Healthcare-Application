import './bootstrap';
import { createApp } from 'vue/dist/vue.esm-bundler.js';
import NavbarComponent from './navbar/Navbar.vue'
import router from './router/index';

/* import the fontawesome core */
import { library } from '@fortawesome/fontawesome-svg-core'

/* import font awesome icon component */
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

/* import specific icons */
import {faAt,faCircleInfo,faFingerprint, faListCheck, faLock, faUser, faUserSecret, faPowerOff, faCircleXmark, faCheckCircle, faSpinner, faUsers, faBell} from '@fortawesome/free-solid-svg-icons'

/* add icons to the library */
library.add(faUserSecret,faAt,faLock,faUser,faFingerprint,faListCheck,faCircleInfo, faLock,faPowerOff,faCircleXmark, faCheckCircle,faSpinner,faUsers,faBell,faStar)


// vuex components
import token from './store/index.js'
import { faStar } from '@fortawesome/free-solid-svg-icons';
// import { faCircleCheck } from '@fortawesome/free-regular-svg-icons';
const app = createApp({
    components: {
        NavbarComponent
    }
})

app
.component('font-awesome-icon', FontAwesomeIcon)
// .use($)
.use(token)
.use(router)
.mount('#app')
// app.use(router)