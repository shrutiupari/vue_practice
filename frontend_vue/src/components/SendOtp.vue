<template>
  <v-container>
    <v-card class="pa-4" outlined>
      <v-card-title> Send OTP</v-card-title>
      <v-card-text>
        <v-form @submit.prevent="handleSendOtp" ref="form">
          <v-text-field
            v-model="phoneNumber"
            label="Phone Number"
            type="tel"
            required
          ></v-text-field>

          <v-btn type="submit" color="primary" class="mt-2">Send OTP</v-btn>
        </v-form>

        <v-alert v-if="success" type="success" class="mt-4" dense> OTP sent successfully! </v-alert>

        <v-alert v-if="error" type="error" class="mt-4" dense>
          Failed to send OTP: {{ error }}
        </v-alert>
      </v-card-text>
    </v-card>
  </v-container>
</template>

<script setup>
import axios from 'axios'
import { ref } from 'vue'

const phoneNumber = ref(null)
const success = ref(false)
const error = ref('')
const form = ref(null)

const handleSendOtp = async () => {
  success.value = false
  error.value = ''

  try {
    await axios.post(`/api/send-opt`, {
      phoneNumber: phoneNumber,
    })
    success.value = true
    form.value?.reset()
  } catch (err) {
    error.value = err.response.data?.message || 'Unknown error'
  }
}
</script>

<style></style>
