<template>
  <div class="fixed top-0 w-full" :class="{'shadow-lg backdrop-filter backdrop-blur bg-opacity-80': scrolled}">
    <div class="flex items-center justify-between py-4 space-x-10 responsive-container">

      <!-- Logo -->
      <Link :href="route('index')" class="font-serif text-4xl font-semibold uppercase text-primary ">Anty</Link>

      <!-- Navigation Links -->
      <div class="items-center justify-between hidden space-x-10 text-xs font-bold sm:flex sm:text-sm sm:space-x-14 lg:space-x-20">
        <div id="left" class="flex items-center justify-between space-x-4 sm:space-x-6 lg:space-x-10">
          <Link 
            v-for="(link, index) in links"
            :key="index"
            :href="route(link.routeName)"
            :class="{'active': $page.url === `/${link.routeName}`, 'hidden md:inline-block': ['services', 'help'].includes(link.text.toLowerCase())}"
            >
            {{ link.text }}
          </Link>
        </div>
        <div id="right" class="flex items-center justify-between space-x-4 sm:space-x-6 lg:space-x-10" v-if="!$page.props.auth.user">
          <Link :href="route('login')" :class="{'active': $page.url === '/login'}">
            Log In
          </Link>
          <Link :href="route('register')" :class="{'active': $page.url === '/register'}">
            Sign Up
          </Link>
        </div>
        <div id="right" class="flex items-center justify-between space-x-4 text-sm sm:space-x-6 lg:space-x-10" v-else>
          <span class="px-1 pt-1 font-medium leading-5 transition duration-150 ease-in-out">Welcome, {{$page.props.auth.user.email}}</span>
          <Link :href="route('logout')" method="post" as="button">
            Logout
          </Link>
        </div>
      </div>

      <!-- Shopping Cart -->
      <span class="flex items-center justify-center p-2.5 text-xs text-white transform rounded-full fas fa-shopping-cart bg-primary"></span>

    </div>
  </div>
</template>

<script>
import { reactive, ref, onMounted } from 'vue'
import { Link } from '@inertiajs/inertia-vue3';
export default {
  name: 'Header',
  components: { Link },
  setup() {
    const scrolled = ref(false)
    const links = reactive([
      {text: 'Fix My Device', routeName: 'fix-my-device'},
      {text: 'Services', routeName: 'services'},
      {text: 'Track Device', routeName: 'track-device'},
      {text: 'Help', routeName: 'help'},
    ])

    onMounted(() => {
      window.addEventListener('scroll', handleScroll) 
    })
    

    const handleScroll = () => {
      if (window.scrollY > 50) {
        scrolled.value = true 
      } else {
        scrolled.value = false
      }
    }

    return {
      links,
      scrolled
    }
  }
}
</script>