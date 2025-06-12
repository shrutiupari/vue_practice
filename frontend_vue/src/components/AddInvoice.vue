<template>
  <v-container>
    <h2>Add New Invoice</h2>
    <v-form @submit.prevent="submitForm">
      <v-text-field v-model="form.patientId" label="Patient ID" required />
      <v-text-field v-model="form.amount" label="Amount" required />
      <v-btn color="primary" type="submit">Submit</v-btn>
    </v-form>
    <v-alert type="success" v-if="success">Invoice added!</v-alert>
  </v-container>
</template>

<script>
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
    },
  },
}
</script>
