<template>
  <v-container>
    <v-card>
      <v-card-title>Add New Invoice</v-card-title>
      <v-card-text>
        <v-form @submit.prevent="submitForm">
          <v-text-field v-model="patientId" label="Patient ID" required />
          <v-text-field v-model="amount" label="Amount" required />
          <v-btn color="primary" type="submit">Submit</v-btn>
        </v-form>
        <!-- <v-alert type="success" v-if="success">Invoice added!</v-alert> -->
        <v-alert v-if="success" type="success" class="mt-4" dense>
          Invoice added successfully!!
        </v-alert>
        <v-alert v-if="error" type="error" class="mt-4" dense> Failed to create invoice </v-alert>
      </v-card-text>
    </v-card>
    <!-- <h2>Add New Invoice</h2>
    <v-form @submit.prevent="submitForm">
      <v-text-field v-model="form.patientId" label="Patient ID" required />
      <v-text-field v-model="form.amount" label="Amount" required />
      <v-btn color="primary" type="submit">Submit</v-btn>
    </v-form>
    <v-alert type="success" v-if="success">Invoice added!</v-alert>
    <v-alert v-if="success" type="success" class="mt-4" dense>
      Invoice added successfully!!
    </v-alert>
    <v-alert v-if="error" type="error" class="mt-4" dense> Failed to create invoice </v-alert> -->
  </v-container>
</template>

<!-- <script>
import api from '../services/api'

export default {
  data() {
    return {
      form: {
        patientId: '',
        amount: '',
      },
      success: false,
    }
  },
  methods: {
    async submitForm() {
      await api.post('/invoices', {
        patientId: parseInt(this.form.patientId),
        amount: parseFloat(this.form.amount),
      })
      this.success = true
      this.form.patientId = ''
      this.form.amount = ''
      if (this.success === true) {
        this.$router.push('/list')
      }
    },
  },
}
</script> -->
<script setup>
import api from '@/services/api'
import { ref } from 'vue'

const success = ref(false)
const form = ref(null)
const patientId = ref('')
const amount = ref(null)

const submitForm = async () => {
  const res = await api.post(`/invoices`, {
    patientId: parseInt(patientId.value),
    amount: parseFloat(amount.value),
  })

  if (res.status === 200) {
    success.value = true
  }
}
</script>
