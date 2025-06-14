<template>
  <v-app-bar app color="primary" dark>
    <v-toolbar class="text-white" image="https://cdn.vuetifyjs.com/images/backgrounds/vbanner.jpg">
      <template v-if="!isDefaultPath" v-slot:prepend>
        <v-btn icon="mdi-arrow-left" @click="navigateTo('/')"></v-btn>
      </template>
      <v-toolbar-title>Invoice Module</v-toolbar-title>
    </v-toolbar>
  </v-app-bar>
</template>

<script setup>
import { computed } from 'vue'
import { useRoute, useRouter } from 'vue-router'

const route = useRoute()
const router = useRouter()

const isDefaultPath = computed(() => route.path === '/')

const navigateTo = (route) => {
  router.push(route)
}
</script>
