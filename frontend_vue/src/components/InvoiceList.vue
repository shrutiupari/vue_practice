<template>
  <v-container>
    <v-data-table :headers="headers" :items="invoices" class="elevation-1">
      <template #item.createdAt="{ item }">
        {{ new Date(item.createdAt).toLocaleDateString() }}
      </template>
    </v-data-table>
  </v-container>
</template>

<script>
import axios from 'axios'
export default {
  name: 'InvoiceList',
  data() {
    return {
      invoices: [],
      headers: [
        { text: 'ID', value: 'id' },
        { text: 'Invoice Number', value: 'invoiceNumber' },
        { text: 'Amount', value: 'amount' },
        { text: 'Created At', value: 'createdAt' },
      ],
    }
  },
  async mounted() {
    try {
      const response = await axios.get('http://127.0.0.1:8000/api/invoices')
      this.invoices = response.data['hydra:member'] || response.data
    } catch (error) {
      console.error('Error loading invoices:', error)
    }
  },
}
</script>
