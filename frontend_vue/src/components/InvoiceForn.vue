<script setup>
import { ref } from 'vue'
import invoiceService from '../services/invoiceService'
import { useRoute, useRouter } from 'vue-router'

// const route = useRoute()
const router = useRouter()

// const isDefaultPath = computed(() => route.path === '/');

const navigateTo = (route) => {
  router.push(route)
}

const invoice = ref({ patient_email: '', description: '', amount: 0, patientId: '' })
const submit = async () => {
  await invoiceService.createInvoice(invoice.value)
  navigateTo('/list')
  // alert('Invoice created')
}
</script>

<template>
  <v-container>
    <v-form @submit.prevent="submit">
      <v-text-field v-model="invoice.patientId" label="Patient ID" required />
      <v-text-field label="Patient Email" v-model="invoice.patient_email" />
      <v-text-field label="Description" v-model="invoice.description" />
      <v-text-field label="Amount" v-model="invoice.amount" type="number" />
      <v-btn type="submit">Submit</v-btn>
    </v-form>
  </v-container>
</template>
