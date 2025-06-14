<template>
  <v-card>
    <v-divider />
    <v-navigation-drawer
      image="https://cdn.vuetifyjs.com/images/backgrounds/bg-2.jpg"
      theme="dark"
      permanent
    >
      <v-list nav density="compact">
        <v-list-item
          v-for="(item, index) in navigationItems"
          :key="index"
          :title="item.text"
          :prepend-icon="item.icon"
          @click="navigateTo(item.route)"
        />
      </v-list>
    </v-navigation-drawer>
  </v-card>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()

const navigationItems = ref([
  { text: 'Invoice List', icon: 'mdi-format-list-bulleted', route: '/list' },
  { text: 'Add Invoice', icon: 'mdi-file-plus-outline', route: '/addInvoice' },
  { text: 'Send OTP', icon: 'mdi-message-text', route: '/send-otp' },
])

const navigateTo = (route) => {
  router.push(route)
}
</script>
