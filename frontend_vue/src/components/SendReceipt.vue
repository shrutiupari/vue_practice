<template>
  <v-container>
    <v-card>
      <v-card-title>Send Receipt</v-card-title>
      <v-card-text>
        <v-form @submit.prevent="handleSendReceipt" ref="receiptForm">
          <v-text-field v-model="email" label="Email" type="email" required> </v-text-field>
          <v-text-field v-model.number="amount" label="Amount" type="number" required>
            <v-btn type="submit" color="primary" class="mt-2">Send Receipt</v-btn>
          </v-text-field>
        </v-form>
        <v-alert v-if="success" type="success" class="mt-4" dense>
          Receipt sent successfully
        </v-alert>
        <v-alert v-if="error" type="error" class="mt-4" dense> Failed to send receipt </v-alert>
      </v-card-text>
    </v-card>

    <v-card>
      <v-card-title>Receipt History</v-card-title>
      <v-data-table :headers="headers" :items="receipts" class="elevation-1">
        <template #item.amount="{ item }"> $ {{ item.amount.toFixed(2) }} </template>
        <template #item.date="{ item }">
          {{ new Date(item.date).toLocalString() }}
        </template>
        <template #item.actions="{ item }">
          <div class="d-flex ga-2 justify-end">
            <v-icon
              color="medium-emphasis"
              icon="mdi-pencil"
              size="small"
              @click="edit(item.id)"
            ></v-icon>

            <v-icon
              color="medium-emphasis"
              icon="mdi-delete"
              size="small"
              @click="remove(item.id)"
            ></v-icon>
          </div>
        </template>
      </v-data-table>
    </v-card>
  </v-container>
</template>

<script setup>
import { onMounted, ref } from 'vue'
import axios from 'axios'

const email = ref('')
const amount = ref(null)
const success = ref(false)
const error = ref('')
const form = ref(null)

const headers = [
  { text: 'Email', value: 'email' },
  { text: 'Amount', value: 'amount' },
  { text: 'Date sent', value: 'date' },
  { text: 'Actions', value: 'actions' },
]

const handleSendReceipt = async () => {
  success.value = false
  error.value = ''

  try {
    await axios.post(`/api/send-receipt`, {
      email: email.value,
      amount: amount.value,
    })
    success.value = true
    form.value?.reset()
  } catch (err) {
    console.log(err)
    error.value = err.response?.data?.message
  }
}

const fetchReceipts = async () => {
  try {
    const response = await axios.get(`/api/receipts`)
    receipts.value = response.data
  } catch (error) {
    console.log('Failed to fetch receipts', error)
  }
}

onMounted(() => {
  fetchReceipts()
})
</script>

<style></style>
